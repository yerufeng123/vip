<?php

/**
 * This is the model class for table "{{jinganshun_user}}".
 *
 * The followings are the available columns in table '{{jinganshun_user}}':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $phone
 * @property string $erweima
 * @property string $erweimaurl
 * @property string $starttime
 * @property string $endtime
 * @property integer $ctime
 * @property integer $enable
 * @property string $openid
 */
class JinganshunUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{jinganshun_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime, enable', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('name', 'length', 'max'=>20),
			array('phone', 'length', 'max'=>11),
			array('erweima, erweimaurl, openid', 'length', 'max'=>255),
			array('starttime, endtime', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, name, phone, erweima, erweimaurl, starttime, endtime, ctime, enable, openid', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'name' => 'Name',
			'phone' => 'Phone',
			'erweima' => 'Erweima',
			'erweimaurl' => 'Erweimaurl',
			'starttime' => 'Starttime',
			'endtime' => 'Endtime',
			'ctime' => 'Ctime',
			'enable' => 'Enable',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('erweima',$this->erweima,true);
		$criteria->compare('erweimaurl',$this->erweimaurl,true);
		$criteria->compare('starttime',$this->starttime,true);
		$criteria->compare('endtime',$this->endtime,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('enable',$this->enable);
		$criteria->compare('openid',$this->openid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return JinganshunUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
