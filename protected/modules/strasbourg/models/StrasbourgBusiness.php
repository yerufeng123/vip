<?php

/**
 * This is the model class for table "{{strasbourg_business}}".
 *
 * The followings are the available columns in table '{{strasbourg_business}}':
 * @property integer $id
 * @property string $openid
 * @property string $company
 * @property string $phone
 * @property integer $ctime
 * @property string $businesscode
 * @property string $roomnumer
 */
class StrasbourgBusiness extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{strasbourg_business}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime', 'numerical', 'integerOnly'=>true),
			array('openid, company, businesscode, roomnumer', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, company, phone, ctime, businesscode, roomnumer', 'safe', 'on'=>'search'),
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
			'openid' => 'Openid',
			'company' => 'Company',
			'phone' => 'Phone',
			'ctime' => 'Ctime',
			'businesscode' => 'Businesscode',
			'roomnumer' => 'Roomnumer',
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
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('businesscode',$this->businesscode,true);
		$criteria->compare('roomnumer',$this->roomnumer,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StrasbourgBusiness the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
