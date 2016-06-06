<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "subscribe".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property integer $status
 */
class Subscribe extends \yii\db\ActiveRecord
{
//    public $name;
//    public $email;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'subscribe';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['email'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['status'], 'default', 'value' =>  1],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'status' => 'Status',
        ];
    }
}
