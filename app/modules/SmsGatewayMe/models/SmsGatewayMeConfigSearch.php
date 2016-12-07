<?php

namespace app\modules\SmsGatewayMe\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\SmsGatewayMe\models\SmsGatewayMeConfig;

/**
 * SmsGatewayMeConfigSearch represents the model behind the search form about `app\modules\SmsGatewayMe\models\SmsGatewayMeConfig`.
 */
class SmsGatewayMeConfigSearch extends SmsGatewayMeConfig
{

    public $page;
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['code', 'key', 'value'], 'safe'],
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
        $query = SmsGatewayMeConfig::find()->asArray();
        //$query = SmsGatewayMeConfig::find();

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

        $query->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'key', $this->key])
            ->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
