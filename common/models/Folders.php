<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "folders".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $size
 * @property string|null $count
 * @property int|null $type 1-open folder, 2-secret folder
 * @property int|null $status 1-active, 2-inactive, 3-deleted
 * @property int|null $parent_id
 *  * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property Files[] $files
 */
class Folders extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }
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
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
            [['count', 'size'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Имя папки',
            'type' => 'Тип',
            'status' => 'Статус',
            'size' => 'Размер',
            'count' => 'Количество файлов',
            'parent_id' => 'Parent ID',
            'created_at' => 'Создано на',
            'updated_at' => 'Обновлено в'
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

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileSize()
    {
        return $this->hasMany(Files::className(), ['folder_id' => 'id'])->sum('file_size');
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileCount()
    {
        return $this->hasMany(Files::className(), ['folder_id' => 'id'])->count();
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileCountChild()
    {
        $result = 0;
        if ($this->parent_id != null){
            $result = $this->hasMany(Files::className(), ['folder_id' => 'id'])->count();
        }else{
            $folder_with_files = Folders::find()->select('id')->where(['parent_id' => $this->id]);

            $files = Files::find()->where(['in', 'folder_id', $folder_with_files])->count();
            $files_in = $this->hasMany(Files::className(), ['folder_id' => 'id'])->count();
            $result = $files + $files_in;
        }
        return $result;
    }

    /**
     * Gets query for [[Files]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Folders::className(), ['parent_id' => 'id']);
    }
}
