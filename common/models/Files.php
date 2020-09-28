<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\web\UploadedFile;

/**
 * This is the model class for table "files".
 *
 * @property int $id
 * @property string|null $fileInput
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

    public $fileInput;
    public $languages;
    public $downloadButton;

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
        return 'files';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        if($this->isNewRecord){
            return [
                [['folder_id', 'category_id', 'view_count', 'document_date', 'file_page_count'], 'integer'],
                [['document_description'], 'string'],
                [['title', 'fileInput'], 'required'],
//                [['languages', 'document_date'], 'safe'],
                [['title', 'document_number', 'document_author'], 'string', 'max' => 255],
                [['fileInput'], 'file', 'skipOnEmpty' => true, 'maxSize' => 1024 * 1024 * 100],
                [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
                [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folders::className(), 'targetAttribute' => ['folder_id' => 'id']],
            ];
        }else{
            return [
                [['folder_id', 'category_id', 'view_count', 'document_date', 'file_page_count'], 'integer'],
                [['document_description'], 'string'],
                [['title'], 'required'],
//                [['languages', 'document_date'], 'safe'],
                [['title', 'document_number', 'document_author'], 'string', 'max' => 255],
                [['fileInput'], 'file', 'skipOnEmpty' => true],
                [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
                [['folder_id'], 'exist', 'skipOnError' => true, 'targetClass' => Folders::className(), 'targetAttribute' => ['folder_id' => 'id']],
            ];
        }
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Номланиши',
            'folder_id' => 'Папка номи',
            'category_id' => 'Категория номи',
            'file_page_count' => 'Саҳифалар сони',
            'type_id' => 'Тип',
            'file_cover' => 'File Cover',
            'document_number' => 'Ҳужжат рақами',
            'document_date' => 'Нашр этилган сана',
            'document_description' => 'Файл тавсифи',
            'document_author' => 'Муаллиф',
            'downloadButton' => 'Юклаш',
            'file_name' => 'File Name',
            'file_size' => 'Файл хажми',
            'file_extension' => 'File Extension',
            'file_path' => 'File Path',
            'languages' => 'Тили',
            'created_at' => 'Яратилган вақти',
            'updated_at' => 'Ўзгартирилган вақти',
            'fileInput' => 'Файл'
        ];
    }


    public function upload($file)
    {
        $base_directory = Yii::getAlias('@frontend/web');
        $db_path = '/uploads/'.date('Y').'/'.date('m').'/'.date('d');
        $new_directory = $base_directory.$db_path;
        if(!is_dir($new_directory)) {
            mkdir($new_directory, 0777, true);
        }
        if($file != null){
            $filename = 'file_'.$this->id.'_'.md5($file->baseName);
            $file_dir = $new_directory .'/'. $filename;
            $this->file_name = $filename;
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
     * Gets query for [[Folder]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Folders::className(), ['id' => 'folder_id']);
    }

    public static function deleteByID($deletedID)
    {
        $model = Files::find()->where(['folder_id' => $deletedID])->all();
        foreach ($model as $value){
            $value->delete();
            unlink(Yii::getAlias('@frontend/web') . $value->file_path . '/' . $value->file_name);
        }
    }
}
