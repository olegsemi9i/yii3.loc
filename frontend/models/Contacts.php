<?php

namespace frontend\models;

use Yii;
use yii\data\ActiveDataProvider;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $name
 * @property string|null $surname
 * @property string|null $email
 * @property string|null $datebirth
 */
class Contacts extends \yii\db\ActiveRecord
{

    
    
    public static function minBirthDate(): string
    {
        return date('d.m.Y', strtotime('-117 years'));
    }


    public static function maxBirthDate(): string
    {
        return date('d.m.Y', strtotime('-18 years'));
    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['datebirth'], 'safe'],
            [['name', 'surname', 'email'], 'string', 'max' => 255],
            
            [['name'], 'required', 'message' => 'Не может быть пустым'],   
            
            ['email', 'trim'],
            ['email', 'email', 'message' => 'Не верный формат Email'],
            
            [['datebirth'], 'validateBirthDate'],
            
        ];
    }

    
    public function validateBirthDate($attribute, $params)
    {
        $inputDate = strtotime($this->{$attribute});
        if (!$inputDate) {
            $this->addError($attribute, 'Задана некорректная дата.');
            return;
        }

        $min = strtotime(self::minBirthDate());
        if ($inputDate < $min) {
            $this->addError($attribute, 'Минимально допустимое значение: ' . self::minBirthDate());
            return;
        }

        $max = strtotime(self::maxBirthDate());
        if ($inputDate > $max) {
            $this->addError($attribute, 'Максимально допустимое значение: ' . self::maxBirthDate());
            return;
        }
    }
    
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'email' => 'Email',
            'datebirth' => 'Дата рождения',
        ];
    }
    
    public function getTelephones()
    {
        return $this->hasMany(Telephone::className(), ['id_contacts' => 'id']);
    }

   
    public function getTelephonesContacts()
    {
        $telephones = '';
        foreach($this->telephones as $tel){
            $telephones .= $tel->name.', ';    
        }
        return $telephones;  
    }
    
}
