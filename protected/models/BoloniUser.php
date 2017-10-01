<?php

/**
 * This is the model class for table "{{boloni_user}}".
 *
 * The followings are the available columns in table '{{boloni_user}}':
 * @property integer $id
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property integer $coupon1
 * @property integer $coupon2
 * @property integer $num
 * @property integer $sharetime
 * @property integer $updatetime
 * @property string $openid
 */
class BoloniUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{boloni_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('updatetime, openid', 'required'),
			array('coupon1, coupon2, num, sharetime, updatetime', 'numerical', 'integerOnly'=>true),
			array('name, city, openid', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, phone, city, coupon1, coupon2, num, sharetime, updatetime, openid', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
			'phone' => 'Phone',
			'city' => 'City',
			'coupon1' => 'Coupon1',
			'coupon2' => 'Coupon2',
			'num' => 'Num',
			'sharetime' => 'Sharetime',
			'updatetime' => 'Updatetime',
			'openid' => 'Openid',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('coupon1',$this->coupon1);
		$criteria->compare('coupon2',$this->coupon2);
		$criteria->compare('num',$this->num);
		$criteria->compare('sharetime',$this->sharetime);
		$criteria->compare('updatetime',$this->updatetime);
		$criteria->compare('openid',$this->openid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RongyuanGame2user the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
