<?php

namespace common\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property int|null $folder_id
 * @property int|null $category_id
 * @property int|null $type_id
 * @property int|null $view_count
 * @property int|null $download_count
 * @property string|null $title
 * @property string|null $file_cover Обложка файла
 * @property string|null $document_number
 * @property int|null $document_date
 * @property string|null $document_description
 * @property string|null $document_author
 * @property string|null $file_name
 * @property string|null $file_size
 * @property string|null $file_extension
 * @property string|null $file_path
 * @property string|null $file_page_count
 * @property int|null $created_at
 * @property int|null $updated_at
 *
 * @property FileLanguage[] $fileLanguages
 * @property Categories $category
 * @property Folders $folder
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['folder_id', 'category_id', 'document_date', 'view_count', 'download_count', 'file_page_count'], 'integer'],
            [['document_description'], 'string'],
            [['title', 'document_number', 'document_author'], 'string', 'max' => 255],
            [['file_name'], 'file', 'skipOnEmpty' => true, 'extensions' => ['png', 'jpg', 'jpeg', 'mp4', 'mp3', 'pdf', 'doc', 'docx', 'xls', 'xlsx']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folders::className(), 'targetAttribute' => ['folder_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'folder_id' => 'Folder ID',
            'category_id' => 'Category ID',
            'type_id' => 'Type ID',
            'title' => 'Title',
            'file_cover' => 'File Cover',
            'document_number' => 'Document Number',
            'document_date' => 'Document Date',
            'document_description' => 'Document Description',
            'document_author' => 'Document Author',
            'file_name' => 'File Name',
            'file_size' => 'File Size',
            'file_extension' => 'File Extension',
            'file_path' => 'File Path',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }


    public function upload($file)
    {
        $base_directory = Yii::getAlias('@frontend/web');
        $db_path = '/files/'.date('Y').'/'.date('m').'/'.date('d');
        $new_directory = $base_directory.$db_path;
        if(!is_dir($new_directory)) {
            mkdir($new_directory, 0777, true);
        }
        if($file != null){
            $filename = $file->baseName;
            $file_dir = $new_directory .'/'. $filename;
            $this->file_name = $file->name;
            $this->file_size = $file->size;
            $this->file_path = $db_path;
            $this->file_extension = $file->extension;
            if ($this->save(false)){
                $file->saveAs($file_dir . '.' . $file->extension);
            }
        }
    }

    /**
     * Gets query for [[FileLanguages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFileLanguages()
    {
        return $this->hasMany(FileLanguage::className(), ['file_id' => 'id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Folder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFolder()
    {
        return $this->hasOne(Folders::className(), ['id' => 'folder_id']);
    }

    public static function deleteByIDs($deletedIDs)
    {
        $model = Files::find()->where(['in', 'id', $deletedIDs])->all();
        foreach ($model as $value){
            $value->delete();
        }
    }
}
