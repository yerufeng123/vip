<?php

/**
 * This is the model class for table "{{luyin_user}}".
 *
 * The followings are the available columns in table '{{luyin_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $nickname
 * @property integer $sex
 * @property string $province
 * @property string $city
 * @property string $country
 * @property string $headimgurl
 * @property string $bgimgurl
 * @property string $voiceurl
 * @property integer $state
 * @property integer $ctime
 */
class LuyinUser extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return LuyinUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{luyin_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sex, state, ctime', 'numerical', 'integerOnly'=>true),
			array('openid, nickname, province, city, country, headimgurl, bgimgurl, voiceurl', 'length', 'max'=>255),
			array('name', 'length', 'max'=>50),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, openid, name, nickname, sex, province, city, country, headimgurl, bgimgurl, voiceurl, state, ctime', 'safe', 'on'=>'search'),
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
			'nickname' => 'Nickname',
			'sex' => 'Sex',
			'province' => 'Province',
			'city' => 'City',
			'country' => 'Country',
			'headimgurl' => 'Headimgurl',
			'bgimgurl' => 'Bgimgurl',
			'voiceurl' => 'Voiceurl',
			'state' => 'State',
			'ctime' => 'Ctime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('bgimgurl',$this->bgimgurl,true);
		$criteria->compare('voiceurl',$this->voiceurl,true);
		$criteria->compare('state',$this->state);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}