<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form about `app\models\Service`.
 */
class ServiceSearch extends Service
{
    public $page;
    public $no_plat;
    public $nama;
    public $kode_customer;

    CONST belum = 1;
    CONST tidak_dihapus = 0;

    public function rules()
    {
        return [
//            [['id', 'customer_id', 'kendaraan_id'], 'integer'],
            [['status'], 'integer'],
            [['no_plat', 'nama', 'kode_service', 'kode_customer'], 'string'],
            [['keluhan', 'created_at'], 'safe'],
            ['page', 'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Service::find()->asArray();
        $query->joinWith(['customer', 'kendaraan']);
        $query->where(['deleted' => self::tidak_dihapus]);
        $query->orderBy(['id' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        $query->andFilterWhere([
//            'id' => $this->id,
//            'customer_id' => $this->customer_id,
//            'kendaraan_id' => $this->kendaraan_id,
//            'created_at' => $this->created_at,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'keluhan', $this->keluhan])
            ->andFilterWhere(['like', 'customer.kode_customer', $this->kode_customer])
            ->andFilterWhere(['like', 'kode_service', $this->kode_service])
            ->andFilterWhere(['like', 'kendaraan.no_plat', $this->no_plat])
            ->andFilterWhere(['like', 'customer.nama', $this->nama]);

        return $dataProvider;
    }

    public function searchQueue($params)
    {
        $query = Service::find()->asArray();
        $query->where(['deleted' => self::tidak_dihapus]);
        $query->andWhere(['status' => self::belum]);

        $query->orderBy(['id' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        $query->joinWith(['customer', 'kendaraan']);

        $query->andFilterWhere([
//            'id' => $this->id,
//            'customer_id' => $this->customer_id,
//            'kendaraan_id' => $this->kendaraan_id,
//            'created_at' => $this->created_at,
            'status' => $this->status
        ]);

        $query->andFilterWhere(['like', 'keluhan', $this->keluhan])
            ->andFilterWhere(['like', 'kode_service', $this->kode_service])
            ->andFilterWhere(['like', 'kendaraan.no_plat', $this->no_plat])
            ->andFilterWhere(['like', 'customer.nama', $this->nama]);

        return $dataProvider;
    }
}
