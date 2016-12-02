<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sparepart;

/**
 * SparepartSearch represents the model behind the search form about `app\models\Sparepart`.
 */
class SparepartSearch extends Sparepart
{

    public $page;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama', 'harga', 'stok'], 'safe'],
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
        $query = Sparepart::find()->asArray();
        //$query = Sparepart::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,

        ]);

        $this->load($params);
        if(isset($this->page)){
            $dataProvider->pagination->pageSize=$this->page; 
        }
        //$query->joinWith('idCostumer');
  

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama])
            ->andFilterWhere(['like', 'harga', $this->harga])
            ->andFilterWhere(['like', 'stok', $this->stok]);

        return $dataProvider;
    }
}
