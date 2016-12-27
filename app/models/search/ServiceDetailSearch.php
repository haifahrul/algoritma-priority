<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ServiceDetail;

/**
 * ServiceSearch represents the model behind the search form about `app\models\Service`.
 */
class ServiceDetailSearch extends ServiceDetail
{
    public $page;

    public function rules()
    {
        return [
            [['nama'], 'string'],
            [['qty'], 'integer'],
            ['page', 'safe']
        ];
    }

    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    public function search($params, $id)
    {
        $query = ServiceDetail::find()->asArray();
        $query->where(['service_id' => $id]);
        $query->orderBy(['nama' => SORT_ASC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        $query->andFilterWhere([
//            'service_id' => $this->service_id,
            'qty' => $this->qty
        ]);

        $query->andFilterWhere(['like', 'nama', $this->nama]);

        return $dataProvider;
    }

}
