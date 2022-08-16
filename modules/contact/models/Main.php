<?php

namespace app\modules\contact\models;

use app\models\User;
use Yii;

/**
 * This is the model class for table "main".
 *
 * @property int $id
 * @property string|null $prefix
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $title
 * @property string|null $company
 * @property string|null $phone
 * @property string|null $cellphone
 * @property string|null $phone2
 * @property string|null $address1
 * @property string|null $address2
 * @property string|null $po_box
 * @property string|null $zip_code
 * @property string|null $country
 * @property string|null $city
 * @property string|null $language
 * @property int|null $owner_id
 * @property string|null $category
 * @property string|null $subcategory
 */
class Main extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'main';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address1', 'address2'], 'string'],
            [['owner_id'], 'integer'],
            [['prefix', 'company', 'firstname', 'lastname', 'title', 'phone', 'cellphone', 'po_box', 'zip_code', 'country', 'city'], 'required'],
            [['company', 'language', 'category', 'subcategory'], 'string', 'max' => 500],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'prefix' => 'Префикс',
            'firstname' => 'Имя',
            'lastname' => 'Фамилия',
            'title' => 'Заголовок',
            'company' => 'Компания',
            'phone' => 'Телефон',
            'cellphone' => 'Сотовый телефон',
            'phone2' => 'Телефон 2',
            'address1' => 'Адрес 1',
            'address2' => 'Адрес 2',
            'po_box' => 'Эл. адрес',
            'zip_code' => 'Почтовый индекс',
            'country' => 'Страна',
            'city' => 'Город',
            'language' => 'Язык',
            'owner_id' => 'Владелец',
            'category' => 'Категория',
            'subcategory' => 'Подкатегория',
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category']);
    }

    public function getSubCategory()
    {
        return $this->hasOne(Subcategory::className(), ['id' => 'subcategory']);
    }
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'owner_id']);
    }


    public function getAdditionalFieldsVal()
    {
        return $this->hasMany(AdditionalField::className(), ['id' => 'contact_id']);
    }

    /**
     * @param $id
     * @return array|\yii\db\ActiveRecord[]
     */
    public function getAdditioanalVal($id){
        return AdditionalFieldsValue::find()->where(['contact_id' => $id])->all();
    }
    public function getSubCategoryById($id){
        return Subcategory::find()->where(['id' => $id])->one();
    }
}
