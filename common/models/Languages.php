<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "languages".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property FileLanguage[] $fileLanguages
 */
class Languages extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'languages';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }

    /**
     * Gets query for [[FileLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileLanguages()
    {
        return $this->hasMany(FileLanguage::className(), ['language_id' => 'id']);
    }
}
