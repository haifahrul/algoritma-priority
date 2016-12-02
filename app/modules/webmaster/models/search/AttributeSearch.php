<?php

namespace app\modules\webmaster\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Attribute;

/**
 * AttributeSearch represents the model behind the search form about `app\models\Attribute`.
 */
class AttributeSearch extends Attribute
{

    public $page;
    public function rules()
    {
        return [
            [['id', 'parent', 'code', 'position', 'status'], 'integer'],
            [['name', 'content', 'type'], 'safe'],
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
        $query = Attribute::find()->asArray();
        //$query = Attribute::find();

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
            'parent' => $this->parent,
            'code' => $this->code,
            'position' => $this->position,
            'status' => $this->status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'type', $this->type]);

        return $dataProvider;
    }
}
