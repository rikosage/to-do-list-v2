<?php 

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;

class Comment extends ActiveRecord
{

  public function getTask()
  {
    return $this->hasOne(Tasks::className(), ['task_id' => 'task_id']);
  }

  public static function tableName()
  {
    return "comments";
  }
}