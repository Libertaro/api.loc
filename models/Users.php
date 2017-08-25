<?php

namespace app\models;

use yii\db\ActiveRecord;

class Users extends ActiveRecord
{

    public static function tableName()
    {
        return 'users';
    }

    public function fields()
    {
        return [
            'id',
            'name',
        ];
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
        ];
    }

    public static function getAllUsers(){
        return Users::find()->all();
    }
}
