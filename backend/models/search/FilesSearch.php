<?php

namespace backend\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Files;

/**
 * FilesSearch represents the model behind the search form of `common\models\Files`.
 */
class FilesSearch extends Files
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'folder_id', 'category_id', 'type_id', 'document_date', 'created_at', 'updated_at'], 'integer'],
            [['title', 'file_cover', 'document_number', 'document_description', 'document_author', 'file_name', 'file_size', 'file_extension', 'file_path'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $folder_id = $params['id'];
        $query = Files::find()->where(['folder_id' => $folder_id]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'folder_id' => $this->folder_id,
            'category_id' => $this->category_id,
            'type_id' => $this->type_id,
            'document_date' => $this->document_date,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'file_cover', $this->file_cover])
            ->andFilterWhere(['like', 'document_number', $this->document_number])
            ->andFilterWhere(['like', 'document_description', $this->document_description])
            ->andFilterWhere(['like', 'document_author', $this->document_author])
            ->andFilterWhere(['like', 'file_name', $this->file_name])
            ->andFilterWhere(['like', 'file_size', $this->file_size])
            ->andFilterWhere(['like', 'file_extension', $this->file_extension])
            ->andFilterWhere(['like', 'file_path', $this->file_path]);

        return $dataProvider;
    }
}
