<?php

/**
 * This is the model class for table "{{enicar_user}}".
 *
 * The followings are the available columns in table '{{enicar_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $phone
 * @property string $city
 * @property string $address
 * @property integer $gamenum
 * @property integer $friendnum
 * @property integer $sharenum
 * @property integer $giftlevel
 * @property integer $utime
 * @property integer $ctime
 * @property integer $gtime
 * @property integer $gid
 */
class EnicarUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{enicar_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('openid, utime, ctime', 'required'),
			array('gamenum, friendnum, sharenum, giftlevel, utime, ctime, gtime, gid', 'numerical', 'integerOnly'=>true),
			array('openid, name, city', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			array('address', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, name, phone, city, address, gamenum, friendnum, sharenum, giftlevel, utime, ctime, gtime, gid', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'phone' => 'Phone',
			'city' => 'City',
			'address' => 'Address',
			'gamenum' => 'Gamenum',
			'friendnum' => 'Friendnum',
			'sharenum' => 'Sharenum',
			'giftlevel' => 'Giftlevel',
			'utime' => 'Utime',
			'ctime' => 'Ctime',
			'gtime' => 'Gtime',
			'gid' => 'Gid',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('gamenum',$this->gamenum);
		$criteria->compare('friendnum',$this->friendnum);
		$criteria->compare('sharenum',$this->sharenum);
		$criteria->compare('giftlevel',$this->giftlevel);
		$criteria->compare('utime',$this->utime);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('gtime',$this->gtime);
		$criteria->compare('gid',$this->gid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return EnicarUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
