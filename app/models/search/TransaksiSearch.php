<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Transaksi;

/**
 * TransaksiSearch represents the model behind the search form about `app\models\Transaksi`.
 */
class TransaksiSearch extends Transaksi
{
    public $page;

    public function rules()
    {
        return [
            [['id', 'service_id', 'customer_id', 'kendaraan_id'], 'integer'],
            [['no_telp', 'no_plat'], 'string'],
            [['nota', 'total_pembayaran'], 'safe'],
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
        $query = Transaksi::find()->asArray();
        $query->joinWith(['customer', 'service', 'transaksiSparepart', 'kendaraan']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        $query->andFilterWhere([
//            'id' => $this->id,
//            'service_id' => $this->service_id,
//            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'nota', $this->nota])
            ->andFilterWhere(['like', 'service.kode_service', $this->service_id])
            ->andFilterWhere(['like', 'customer.nama', $this->customer_id])
            ->andFilterWhere(['like', 'customer.no_telp', $this->no_telp])
            ->andFilterWhere(['like', 'kendaraan.no_plat', $this->no_plat])
            ->andFilterWhere(['like', 'total_pembayaran', $this->total_pembayaran]);

        return $dataProvider;
    }
}
