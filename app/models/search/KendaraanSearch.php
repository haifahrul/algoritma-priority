<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Kendaraan;

/**
 * KendaraanSearch represents the model behind the search form about `app\models\Kendaraan`.
 */
class KendaraanSearch extends Kendaraan
{

    public $page;

    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['customer_id'], 'string'],
            [['merek', 'tipe', 'tahun', 'jenis', 'no_plat'], 'safe'],
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
        $query = Kendaraan::find()->asArray();
        $query->joinWith('customer');

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]]
        ]);

        $this->load($params);
        if (isset($this->page)) {
            $dataProvider->pagination->pageSize = $this->page;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'customer.nama', $this->customer_id])
            ->andFilterWhere(['like', 'merek', $this->merek])
            ->andFilterWhere(['like', 'tipe', $this->tipe])
            ->andFilterWhere(['like', 'tahun', $this->tahun])
            ->andFilterWhere(['like', 'jenis', $this->jenis])
            ->andFilterWhere(['like', 'no_plat', $this->no_plat]);

        return $dataProvider;
    }
}
