<?php

namespace artsoft\parallax\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use artsoft\parallax\models\Parallax;

/**
 * ParallaxSearch represents the model behind the search form about `artsoft\parallax\models\Parallax`.
 */
class ParallaxSearch extends Parallax
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'slug', 'bg_color', 'bg_image', 'parallax_class', 'background_ratio', 'content_image', 'content', 'url', 'btn_icon', 'btn_name', 'btn_class', 'status'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Parallax::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => Yii::$app->request->cookies->getValue('_grid_page_size', 20),
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'parallax_class', $this->bg_image])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'slug', $this->slug])
//            ->andFilterWhere(['like', 'bg_color', $this->bg_color])
//            ->andFilterWhere(['like', 'bg_image', $this->bg_image])
//            ->andFilterWhere(['like', 'content_image', $this->parallax_class])
//            ->andFilterWhere(['like', 'background_ratio', $this->background_ratio])               
//            ->andFilterWhere(['like', 'content', $this->content])
//            ->andFilterWhere(['like', 'url', $this->url])
//            ->andFilterWhere(['like', 'btn_icon', $this->btn_icon])
//            ->andFilterWhere(['like', 'btn_name', $this->btn_name])
//            ->andFilterWhere(['like', 'btn_class', $this->btn_class])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
