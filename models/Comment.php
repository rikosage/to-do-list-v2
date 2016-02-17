<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;


/**
 * Модель для работы с таблицей comments
 */
class Comment extends ActiveRecord
{

  /**
   * Правила валидации для модели
   */
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

  /**
   * Поиск комментариев по идентификатору записи
   * @return object  Выборка из базы данных
   */
  public function getTask()
  {
    return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
  }


  /**
   * Имя запрашиваемой таблицы
   * @return string
   */
  public static function tableName()
  {
    return "comments";
  }
}