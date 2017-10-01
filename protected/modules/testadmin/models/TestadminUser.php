<?php

/**
 * This is the model class for table "{{testadmin_user}}".
 *
 * The followings are the available columns in table '{{testadmin_user}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $tel
 * @property string $fax
 * @property string $email
 * @property string $qq
 * @property string $weibo
 * @property string $wechat
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $address
 * @property string $headimgurl
 * @property integer $ctime
 * @property string $channel
 * @property integer $credit
 * @property integer $scores
 * @property integer $status
 * @property integer $carestatus
 */
class TestadminUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{testadmin_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('ctime, credit, scores, status, carestatus', 'numerical', 'integerOnly'=>true),
			array('username, email', 'length', 'max'=>30),
			array('password, nickname, sex, province, city, country, headimgurl, channel', 'length', 'max'=>255),
			array('name, tel, fax, qq, weibo, wechat', 'length', 'max'=>20),
			array('phone', 'length', 'max'=>11),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, name, phone, tel, fax, email, qq, weibo, wechat, nickname, sex, province, city, country, address, headimgurl, ctime, channel, credit, scores, status, carestatus', 'safe', 'on'=>'search'),
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
			'password' => 'Password',
			'name' => 'Name',
			'phone' => 'Phone',
			'tel' => 'Tel',
			'fax' => 'Fax',
			'email' => 'Email',
			'qq' => 'Qq',
			'weibo' => 'Weibo',
			'wechat' => 'Wechat',
			'nickname' => 'Nickname',
			'sex' => 'Sex',
			'province' => 'Province',
			'city' => 'City',
			'country' => 'Country',
			'address' => 'Address',
			'headimgurl' => 'Headimgurl',
			'ctime' => 'Ctime',
			'channel' => 'Channel',
			'credit' => 'Credit',
			'scores' => 'Scores',
			'status' => 'Status',
			'carestatus' => 'Carestatus',
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
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('tel',$this->tel,true);
		$criteria->compare('fax',$this->fax,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('weibo',$this->weibo,true);
		$criteria->compare('wechat',$this->wechat,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('channel',$this->channel,true);
		$criteria->compare('credit',$this->credit);
		$criteria->compare('scores',$this->scores);
		$criteria->compare('status',$this->status);
		$criteria->compare('carestatus',$this->carestatus);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestadminUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
