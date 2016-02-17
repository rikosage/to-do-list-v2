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
        ['title', "string", 'min'=>3, 'max'=>50, 'tooShort'=>"Слишком короткое сообщение", "tooLong"=>"Слишком длинное сообщение"],
    );
}

  public function getComment()
  {
    return $this->hasMany(Comment::className(), ['task_id' => 'id']);
  }

  public static function tableName()
  {
    return "tasks";
  }
}

?>