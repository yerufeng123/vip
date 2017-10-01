<?php

/**
 * This is the model class for table "{{strasbourg_user}}".
 *
 * The followings are the available columns in table '{{strasbourg_user}}':
 * @property integer $id
 * @property string $username
 * @property string $name
 * @property string $phone
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 * @property integer $ctime
 * @property string $channel
 * @property integer $credit
 * @property string $openid
 * @property integer $scores
 * @property string $hometown
 */
class StrasbourgUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{strasbourg_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime, credit, scores', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('name', 'length', 'max'=>20),
			array('phone', 'length', 'max'=>11),
			array('nickname, sex, province, city, country, headimgurl, channel, openid', 'length', 'max'=>255),
			array('hometown', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, name, phone, nickname, sex, province, city, country, headimgurl, ctime, channel, credit, openid, scores, hometown', 'safe', 'on'=>'search'),
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
			'nickname' => 'Nickname',
			'sex' => 'Sex',
			'province' => 'Province',
			'city' => 'City',
			'country' => 'Country',
			'headimgurl' => 'Headimgurl',
			'ctime' => 'Ctime',
			'channel' => 'Channel',
			'credit' => 'Credit',
			'openid' => 'Openid',
			'scores' => 'Scores',
			'hometown' => 'Hometown',
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
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('scores',$this->scores);
		$criteria->compare('hometown',$this->hometown,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StrasbourgUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
