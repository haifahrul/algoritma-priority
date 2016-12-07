<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%attribute}}".
 *
 * @property integer $id
 * @property integer $parent
 * @property string $name
 * @property string $content
 * @property integer $code
 * @property string $type
 * @property integer $position
 * @property integer $status
 */
class Attribute extends \yii\db\ActiveRecord {
    const NOT_ACTIVE = 0;
    const ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'attribute';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'code', 'type', 'position'], 'required'],
            [['parent', 'code', 'position'], 'integer'],
            [['name', 'type'], 'string', 'max' => 128],
//            [['content'], 'default', 'value' => NULL],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('app', 'ID'),
            'parent' => Yii::t('app', 'Parent'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
            'type' => Yii::t('app', 'Type'),
            'position' => Yii::t('app', 'Position'),
        ];
    }

    public function getParents() {
        return $this->hasMany(Attribute::className(), ['parent' => 'id']);
    }

    static function dropDownAttribute() {
        $options = $options_sub = [];
        $parents = Attribute::find()->where('parent=0')->orderBy('parent asc')->all();
        foreach ($parents as $id => $p) {
            $options[$p->id] = $p->name;
            $children = $p->parents;
            $child_options = [];
            foreach ($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options_sub[$p->name] = $child_options;
        }
        return $options+=$options_sub;
    }

    public static function one_row_attribute($type) {
        $options = array();
        $parents = Attribute::find()->where("type='$type' and parent!=0")->orderBy('code asc')->all();
        return ArrayHelper::map($parents, 'code', 'name');
    }

    public static function oneAttribute($type, $code) {
        $model= self::find()->where("type='$type' and code=$code")->one();
        return $model->name;
    }

    public static function attribute_view($type, $code) {
        empty($code) ? $code = 0 : $code;
        $query = Attribute::find()
            ->select('code, name')
            ->where("type='$type' AND code=$code AND parent!=0")
            ->all();
        $data = ArrayHelper::map($query, 'code', 'name');
        return ArrayHelper::getValue($data, $code);
    }

    public function two_row_attribute($condition) {
        $options = $options_sub = [];
        $parents = Attribute::find()->where($condition)->orderBy('parent asc')->all();
        foreach ($parents as $id => $p) {
            $options[$p->id] = $p->name;
            $children = $p->parents;
            $child_options = [];
            foreach ($children as $child) {
                $child_options[$child->id] = $child->name;
            }
            $options_sub[$p->name] = $child_options;
        }
        return $options_sub;
    }

    public static function getStatus($status = NULL) {
        $statusLOV = [
            self::ACTIVE => Yii::t('app', 'Active'),
            self::NOT_ACTIVE => Yii::t('app', 'Not Active')
        ];
        return is_null($status) ? $statusLOV : $statusLOV[$status];
    }

}
