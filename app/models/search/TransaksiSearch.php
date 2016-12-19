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
            [['id', 'service_id', 'sparepart_id'], 'integer'],
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
        $query->joinWith(['sparepart', 'service']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if(isset($this->page)){
            $dataProvider->pagination->pageSize=$this->page; 
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'service_id' => $this->service_id,
            'sparepart_id' => $this->sparepart_id,
        ]);

        $query->andFilterWhere(['like', 'nota', $this->nota])
            ->andFilterWhere(['like', 'service.kode_service', $this->service_id])
            ->andFilterWhere(['like', 'sparepart.nama', $this->sparepart_id])
            ->andFilterWhere(['like', 'total_pembayaran', $this->total_pembayaran]);

        return $dataProvider;
    }
}
