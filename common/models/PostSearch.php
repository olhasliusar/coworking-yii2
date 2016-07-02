<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Post;
use yii\data\Sort;

/**
 * PostSearch represents the model behind the search form about `common\models\Post`.
 */
class PostSearch extends Post
{
    public $userName;  //attribute name in GridView::widget view of post/index
    public $image;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'user_id', 'image_id', 'begin', 'end', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by'], 'integer'],
            [['title', 'text', 'userName', 'image'], 'safe'], //'userName', 'image' - added public variables
            [['cost'], 'number'],
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
        $query = Post::find();
        $query->joinWith('user');
        $query->joinWith('image');

        // add conditions that should always apply here

        $sort =  new Sort([
            'attributes' => [
                'userName' => [
                    'asc' => ['user.fullname' => SORT_ASC],
                    'desc' => ['user.fullname' => SORT_DESC],
                    'label' => 'User Fullname',
                ],
                'status' => [
                    'asc' => ['status' => SORT_ASC],
                    'desc' => ['status' => SORT_DESC],
                    'label' => 'Status',
                ],
                'image' => [
                    'asc' => ['image.path' => SORT_ASC],
                    'desc' => ['image.path' => SORT_DESC],
                    'label' => 'Image',
                ],
                'title' => [
                    'asc' => ['title' => SORT_ASC],
                    'desc' => ['title' => SORT_DESC],
                    'label' => 'Title',
                ],
                'text' => [
                    'asc' => ['text' => SORT_ASC],
                    'desc' => ['text' => SORT_DESC],
                    'label' => 'Text',
                ],

            ],
        ]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 6,
            ],
            'sort' => $sort,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'post.id' => $this->id,
            'user_id' => $this->user_id,
            'image_id' => $this->image_id,
            'begin' => $this->begin,
            'end' => $this->end,
            'cost' => $this->cost,
            'post.status' => $this->status,
            'post.updated_by' => $this->updated_by,
            'post.updated_at' => $this->updated_at,
            'post.created_at' => $this->created_at,
            'post.created_by' => $this->created_by,
        ]);

        $query->andFilterWhere(['like', 'post.title', $this->title])
            ->andFilterWhere(['like', 'post.text', $this->text])
            ->andFilterWhere(['like', 'user.fullname', $this->userName]) //userName - added public variable
            ->andFilterWhere(['like', 'image.path', $this->image]); //image - added public variable

        return $dataProvider;
    }
}
