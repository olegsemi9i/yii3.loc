<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "telephone".
 *
 * @property int $id
 * @property int $id_contacts
 * @property string $name
 *
 * @property Contacts $contacts
 */
class Telephone extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'telephone';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_contacts', 'name'], 'required', 'message' => 'Не может быть пустым'],
            [['id_contacts'], 'integer'],
            [['name'], 'string', 'max' => 20],
            [['id_contacts'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['id_contacts' => 'id']],
            
            //['name', 'match', 'pattern' => '^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$', 'message' => 'неверный формат'],
            
            [['name'], 'validateName' ]
        ];
    }

    public function validateName($attribute, $params)
    {
    
        $pattern = "/^\+38\[0-9]{10,10}+$/";
        if(preg_match($pattern, $attribute)){
            return;    
        } else {
            $this->addError($attribute, 'неверный формат');
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
            'id_contacts' => 'Id Contacts',
            'name' => 'Телефон',
        ];
    }

    /**
     * Gets query for [[Contacts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContacts()
    {
        return $this->hasOne(Contacts::className(), ['id' => 'id_contacts']);
    }
}
