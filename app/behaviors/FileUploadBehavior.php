<?php
/**
 * Created by PhpStorm.
 * User: AlFatih
 * Date: 26/06/2016
 * Time: 13:39
 */

namespace yiidreamteam\upload;
use Yii;
use yii\base\Exception;
use yii\base\InvalidCallException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;
use yii\helpers\VarDumper;
use yii\web\UploadedFile;
/**
 * Class FileUploadBehavior
 *
 * @property ActiveRecord $owner
 */
class FileUploadBehavior extends \yii\base\Behavior
{
    const EVENT_AFTER_FILE_SAVE = 'afterFileSave';
    /** @var string Name of attribute which holds the attachment. */
    public $attribute = 'upload';
    /** @var string Path template to use in storing files.5 */
    public $filePath = '@webroot/uploads/[[pk]].[[extension]]';
    /** @var string Where to store images. */
    public $fileUrl = '/uploads/[[pk]].[[extension]]';
    /**
     * @var string Attribute used to link owner model with it's parent
     * @deprecated Use attribute_xxx placeholder instead
     */
    public $parentRelationAttribute;
    /** @var \yii\web\UploadedFile */
    protected $file;
    /**
     * @inheritdoc
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeSave',
            ActiveRecord::EVENT_AFTER_INSERT => 'afterSave',
            ActiveRecord::EVENT_AFTER_UPDATE => 'afterSave',
            ActiveRecord::EVENT_BEFORE_DELETE => 'beforeDelete',
        ];
    }
    /**
     * Before validate event.
     */
    public function beforeValidate()
    {
        if ($this->owner->{$this->attribute} instanceof UploadedFile) {
            $this->file = $this->owner->{$this->attribute};
            return;
        }
        $this->file = UploadedFile::getInstance($this->owner, $this->attribute);

        if (empty($this->file)) {
            $this->file = UploadedFile::getInstanceByName($this->attribute);
        }
        if ($this->file instanceof UploadedFile) {
            $this->owner->{$this->attribute} = $this->file;
        }
    }
    /**
     * Before save event.
     *
     * @throws \yii\base\InvalidConfigException
     */
    public function beforeSave()
    {
        if ($this->file instanceof UploadedFile) {
            if (!$this->owner->isNewRecord) {
                /** @var ActiveRecord $oldModel */
                $oldModel = $this->owner->findOne($this->owner->primaryKey);
                $behavior = static::getInstance($oldModel, $this->attribute);
                $behavior->cleanFiles();
            }
            $this->owner->{$this->attribute} = $this->file->baseName . '.' . $this->file->extension;
        } else { // Fix html forms bug, when we have empty file field
            if (!$this->owner->isNewRecord && empty($this->owner->{$this->attribute}))
                $this->owner->{$this->attribute} = ArrayHelper::getValue($this->owner->oldAttributes, $this->attribute, null);
        }
    }
    /**
     * Removes files associated with attribute
     */
    public function cleanFiles()
    {
        $path = $this->resolvePath($this->filePath);
        @unlink($path);
    }
    /**
     * Replaces all placeholders in path variable with corresponding values
     *
     * @param string $path
     * @return string
     */
    public function resolvePath($path)
    {
        $path = Yii::getAlias($path);
        $pi = pathinfo($this->owner->{$this->attribute});
        $fileName = ArrayHelper::getValue($pi, 'filename');
        $extension = strtolower(ArrayHelper::getValue($pi, 'extension'));
        return preg_replace_callback('|\[\[([\w\_/]+)\]\]|', function ($matches) use ($fileName, $extension) {
            $name = $matches[1];
            switch ($name) {
                case 'extension':
                    return $extension;
                case 'filename':
                    return $fileName;
                case 'basename':
                    return  $fileName . '.' . $extension;
                case 'app_root':
                    return Yii::getAlias('@app');
                case 'web_root':
                    return Yii::getAlias('@webroot');
                case 'base_url':
                    return Yii::getAlias('@web');
                case 'model':
                    $r = new \ReflectionClass($this->owner->className());
                    return lcfirst($r->getShortName());
                case 'attribute':
                    return lcfirst($this->attribute);
                case 'id':
                case 'pk':
                    $pk = implode('_', $this->owner->getPrimaryKey(true));
                    return lcfirst($pk);
                case 'id_path':
                    return static::makeIdPath($this->owner->getPrimaryKey());
                case 'parent_id':
                    return $this->owner->{$this->parentRelationAttribute};
            }
            if (preg_match('|^attribute_(\w+)$|', $name, $am)) {
                $attribute = $am[1];
                return $this->owner->{$attribute};
            }
            if (preg_match('|^md5_attribute_(\w+)$|', $name, $am)) {
                $attribute = $am[1];
                return md5($this->owner->{$attribute});
            }
            return '[[' . $name . ']]';
        }, $path);
    }
    /**
     * @param integer $id
     * @return string
     */
    protected static function makeIdPath($id)
    {
        $id = is_array($id) ? implode('', $id) : $id;
        $length = 10;
        $id = str_pad($id, $length, '0', STR_PAD_RIGHT);
        $result = [];
        for ($i = 0; $i < $length; $i++)
            $result[] = substr($id, $i, 1);
        return implode('/', $result);
    }
    /**
     * After save event.
     */
    public function afterSave()
    {
        if ($this->file instanceof UploadedFile) {
            $path = $this->getUploadedFilePath($this->attribute);
            FileHelper::createDirectory(pathinfo($path, PATHINFO_DIRNAME), 0775, true);
            if (!$this->file->saveAs($path)) {
                throw new Exception('File saving error.');
            }
            $this->owner->trigger(static::EVENT_AFTER_FILE_SAVE);
        }
    }
    /**
     * Returns file path for attribute.
     *
     * @param string $attribute
     * @return string
     */
    public function getUploadedFilePath($attribute)
    {
        $behavior = static::getInstance($this->owner, $attribute);
        if (!$this->owner->{$attribute})
            return '';
        return $behavior->resolvePath($behavior->filePath);
    }
    /**
     * Returns behavior instance for specified class and attribute
     *
     * @param ActiveRecord $model
     * @param string $attribute
     * @return static
     */
    public static function getInstance(ActiveRecord $model, $attribute)
    {
        foreach ($model->behaviors as $behavior) {
            if ($behavior instanceof self && $behavior->attribute == $attribute)
                return $behavior;
        }
        throw new InvalidCallException('Missing behavior for attribute ' . VarDumper::dumpAsString($attribute));
    }
    /**
     * Before delete event.
     */
    public function beforeDelete()
    {
        $this->cleanFiles();
    }
    /**
     * Returns file url for the attribute.
     *
     * @param string $attribute
     * @return string|null
     */
    public function getUploadedFileUrl($attribute)
    {
        if (!$this->owner->{$attribute})
            return null;
        $behavior = static::getInstance($this->owner, $attribute);
        return $behavior->resolvePath($behavior->fileUrl);
    }
}

/*
how to setting or add in your model
public function rules()
{
    return [
        ['fileUpload', 'file'],
    ];
}

public function behaviors()
{
    return [
        [
            'class' => '\yiidreamteam\upload\FileUploadBehavior',
            'attribute' => 'fileUpload',
            'filePath' => '@webroot/uploads/[[pk]].[[extension]]',
            'fileUrl' => '/uploads/[[pk]].[[extension]]',
       ],
    ];
}

-- note

    [[model]] - model class name
    [[pk]] - value of the primary key
    [[id]] - the same as [[pk]]
    [[attribute_name]] - attribute value, for example [[attribute_ownerId]]
    [[id_path]] - id subdirectories structure (if model primary key is 12345, placeholder value will be 1/2/3/4/5/0/0/0/0/0
    [[basename]] - original filename with extension
    [[filename]] - original filename without extension
    [[extension]] - original extension


-- in your _form.php
$form = \yii\bootstrap\ActiveForm::begin([
    'enableClientValidation' => false,
    'options' => [
        'enctype' => 'multipart/form-data', // setting enctype
     ],
]);

-- if you get pathUrl upload
echo $model->getUploadedFileUrl('fileUpload'); // fileupload is name  attribute

*/