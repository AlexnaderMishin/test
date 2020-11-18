<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $fio
 * @property string $username
 * @property string $password
 * @property string $email
 * @property int $admin
 *
 * @property Request[] $requests
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fio', 'username', 'password', 'email'], 'required'],
            [['admin'], 'integer'],
            [['fio'], 'string', 'max' => 255],
            [['username', 'password', 'email'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fio' => 'Fio',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'admin' => 'Admin',
        ];
    }

    /**
     * Gets query for [[Requests]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRequests()
    {
        return $this->hasMany(Request::className(), ['idUser' => 'id']);
    }
}
