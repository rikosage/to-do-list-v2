<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Task extends ActiveRecord
{

  const STATUS_ACTIVE = 1;
  const STATUS_COMPLETED = 0;

  public function rules(){
    return array(
        ['title', 'required', 'message'=>"Заголовок обязателен!"],
        ['title', 'unique', 'message'=>"Такое задание уже есть!"],
        ['title', "string", 'min'=>3, 'max'=>25, 'tooShort'=>"Минимум три символа в заголовке!", "tooLong"=>"Максимум 25 символов в заголовке!"],
    );
}

  public static function tableName()
  {
    return "tasks";
  }
}

?>