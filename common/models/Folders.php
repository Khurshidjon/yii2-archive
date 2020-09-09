<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "folders".
 *
 * @property int $id
 * @property string|null $title
 * @property int|null $type 1-open folder, 2-secret folder
 * @property int|null $status 1-active, 2-inactive, 3-deleted
 * @property int|null $parent_id
 *
 * @property Files[] $files
 */
class Folders extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'folders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['type', 'status', 'parent_id'], 'integer'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'type' => 'Type',
            'status' => 'Status',
            'parent_id' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::className(), ['folder_id' => 'id']);
    }
}
