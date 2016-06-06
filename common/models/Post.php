<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $image_id
 * @property string $title
 * @property string $text
 * @property integer $begin
 * @property integer $end
 * @property string $cost
 * @property integer $status
 * @property Image $image
 * @property integer $updated_by
 * @property integer $updated_at
 * @property integer $created_at
 * @property integer $created_by
 */
class Post extends \yii\db\ActiveRecord
{
    public $beginTime;
    public $endTime;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
    //        [['user_id', 'updated_by', 'updated_at', 'created_at', 'created_by'], 'required'],
//            [['user_id', 'image_id', 'begin', 'end', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by'], 'integer'],
            [['user_id', 'image_id', 'status', 'updated_by', 'updated_at', 'created_at', 'created_by'], 'integer'],
            [['cost'], 'number'],
            [['title'], 'string', 'max' => 45],
            [['text'], 'string', 'max' => 255],

            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['status'], 'default', 'value' =>  1],
            [['beginTime', 'endTime'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'image_id' => 'Image ID',
            'title' => 'Title',
            'text' => 'Text',
            'begin' => 'Begin',
            'end' => 'End',
            'cost' => 'Cost',
            'status' => 'Status',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
        ];
    }

    public function getImage(){
        return Image::findOne($this->image_id);
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
}
