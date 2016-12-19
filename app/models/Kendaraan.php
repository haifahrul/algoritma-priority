<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%kendaraan}}".
 *
 * @property integer $id
 * @property integer $customer_id
 * @property string $merek
 * @property string $tipe
 * @property string $tahun
 * @property string $jenis
 * @property string $no_plat
 *
 * @property Customer $customer
 * @property Service[] $services
 */
class Kendaraan extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%kendaraan}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['customer_id', 'merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'required'],
            [['customer_id'], 'integer'],
            [['merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'string', 'max' => 50],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'required', 'on' => 'createFromCustomer'],
            ['no_plat', 'unique', 'targetClass' => '\app\models\Kendaraan', 'message' => Yii::t('app', 'Kendaraan ini sudah pernah di daftarkan!')],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['createFromCustomer'] = ['merek', 'tipe', 'tahun', 'jenis', 'no_plat'];
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'customer_id' => Yii::t('app', 'Customer'),
            'merek' => Yii::t('app', 'Merek'),
            'tipe' => Yii::t('app', 'Tipe'),
            'tahun' => Yii::t('app', 'Tahun'),
            'jenis' => Yii::t('app', 'Jenis'),
            'no_plat' => Yii::t('app', 'No Plat'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['kendaraan_id' => 'id']);
    }

    /**
     * @inheritdoc
     * @return \app\models\query\KendaraanQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\KendaraanQuery(get_called_class());
    }

    public static function getListKendaraan($id)
    {
        $query = Yii::$app->db->createCommand('SELECT * FROM {{%kendaraan}} WHERE customer_id=:customer_id')
            ->bindValue(':customer_id', $id)
            ->queryAll();

        foreach ($query as $result) {
            $data[] = [
                'id' => $result['id'],
                'name' => $result['no_plat'],
            ];
        };
        return $data;
    }
}
