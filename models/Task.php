<?php 

namespace app\models;

use yii\db\ActiveRecord;
use yii\base\InvalidParamException;
use yii\base\Model;
use Yii;

class Task extends ActiveRecord
{

  const STATUS_ACTIVE = 1;
  const STATUS_COMPLETED = 0;

  public function rules(){
    return array(
        ['text', 'required'],
    );
}

  public static function tableName()
  {
    return "tasks";
  }
}

?>