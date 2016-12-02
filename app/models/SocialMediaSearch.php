<?php
namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SocialMedia;

/**
 * SocialMediaSearch represents the model behind the search form about `app\models\SocialMedia`.
 */
class SocialMediaSearch extends SocialMedia
{
    public $page;

    public function rules()
    {
        return [
            [['social_media', 'id', 'username'], 'safe'],
            [['user_id', 'created_at', 'updated_at'], 'integer'],
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
        $query = SocialMedia::find()->asArray();
        //$query = SocialMedia::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            //'pagination' => array(
            //    'pageSize' => 13
            //),
        ]);
        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }
        //$query->joinWith('idCostumer');
        /*
        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            //matikan celah scurity
            return $dataProvider;
        }
        */
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);
        $query->andFilterWhere(['like', 'social_media', $this->social_media])
            ->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'username', $this->username]);
        return $dataProvider;
    }
}
