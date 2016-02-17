<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Comment extends ActiveRecord
{

  public function rules()
  {
    return 
    [
      ['text', 'required', 'message'=>Yii::t('msg/msg', 'Текст комментария обязателен')],
      ['text', 'string', 'min'=>5, 'max'=>300, 
      'tooShort' => Yii::t('msg/msg', 'Слишком короткое сообщение'), 
      'tooLong'=> Yii::t('msg/msg', 'Слишком длинное сообщение')]
    ];
  }

  public function getTask()
  {
    return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
  }

  public static function tableName()
  {
    return "comments";
  }
}