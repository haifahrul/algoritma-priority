<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\JasaService;

/**
 * JasaServiceSearch represents the model behind the search form about `app\models\JasaService`.
 */
class JasaServiceSearch extends JasaService
{

    public $page;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['nama', 'biaya'], 'safe'],
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
        $query = JasaService::find()->asArray();
        //$query = JasaService::find();

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
            ->andFilterWhere(['like', 'biaya', $this->biaya]);

        return $dataProvider;
    }
}
