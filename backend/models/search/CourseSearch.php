<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Course;

/**
 * CourseSearch represents the model behind the search form about `common\models\Course`.
 */
class CourseSearch extends Course
{
    public $teacherName;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            [['id','section_id', 'teacher_id','start_at','end_at'], 'integer'],
            [['id','section_id'], 'integer'],
            [['start_at', 'end_at'], 'default', 'value' => null],
            [['title', 'description', 'zoom_link','sub_title','requirement','target_student','targeted_skills',''], 'safe'],
            [['teacherName'], 'safe'],
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
       if(Yii::$app->user->can('manager')){
           $query = Course::find();
       }elseif(Yii::$app->user->can('teacher')){
           $query = Course::findOwnCourses();
       }
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        if ($this->start_at !== null) {
            $query->andFilterWhere(['between', 'start_at', strtotime($this->start_at), strtotime($this->start_at) + 3600 * 24]);
        }

        if ($this->end_at !== null) {
            $query->andFilterWhere(['between', 'end_at', strtotime($this->end_at), strtotime($this->end_at) + 3600 * 24]);
        }
        $query->joinWith(['teacher' => function ($q) {
            $q->joinWith(['userProfile' => function ($z) {
                $z->andFilterWhere([
                    'or',
                    ['like', 'lastname', $this->teacherName],
                    ['like', 'firstname', $this->teacherName],
                ]);
            }]);
        }]);


        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'sub_title', $this->sub_title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'zoom_link', $this->zoom_link])
            ->andFilterWhere(['like', 'requirement', $this->requirement])
            ->andFilterWhere(['like', 'target_student', $this->target_student])
            ->andFilterWhere(['like', 'targeted_skills', $this->targeted_skills]);

        return $dataProvider;
    }
}
