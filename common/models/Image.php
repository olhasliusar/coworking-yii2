<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $path
 * @property string $name
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 * @property string $urlPath
 */
class Image extends \yii\db\ActiveRecord
{

    public  $imageFile;
    /**
     * @inheritdoc
     */

    public static function tableName()
    {
        return 'image';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {

        return [
            [['path'], 'required'],
            [['updated_by', 'updated_at', 'created_at', 'created_by'], 'integer'],
            [['path'], 'string', 'max' => 255],
            [['name'], 'string', 'max' => 45],
   //         [['path'], 'unique'],
            [['imageFile'], 'file'],
        ];
    }

    public function upload()
    {
        $newName = date('YmdHis');
        if (  !$this->imageFile->saveAs(Yii::getAlias('@static/web/' . $this->imageFile->baseName . $newName . '.' . $this->imageFile->extension))){
            return false;
        }

        $this->path = 'static/web/' . $this->imageFile->baseName . $newName . '.' . $this->imageFile->extension;
        if( $this->save() ){
            return true;
        } else {
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'path' => 'Path',
            'name' => 'Name',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => 'updated_at'
                ]
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by'
            ]
        ];
    }

    public function getUrlPath(){
        $result = ''; // Пока результат пуст
        $default_port = 80; // Порт по-умолчанию

        // А не в защищенном-ли мы соединении?
        if (isset($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
            // В защищенном! Добавим протокол...
            $result .= 'https://';
            // ...и переназначим значение порта по-умолчанию
            $default_port = 443;
        } else {
            // Обычное соединение, обычный протокол
            $result .= 'http://';
        }

        // Имя сервера, напр. site.com или www.site.com
        $result .= $_SERVER['SERVER_NAME'];
        $result .= "/";

        return $result . $this->path;
    }
}
