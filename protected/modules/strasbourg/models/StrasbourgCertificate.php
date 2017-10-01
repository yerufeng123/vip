<?php

/**
 * This is the model class for table "{{strasbourg_certificate}}".
 *
 * The followings are the available columns in table '{{strasbourg_certificate}}':
 * @property integer $id
 * @property integer $uid
 * @property string $erweimaurl
 * @property string $code
 * @property string $openid
 * @property string $type
 * @property integer $ctime
 * @property integer $overtime
 * @property string $channel
 */
class StrasbourgCertificate extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{strasbourg_certificate}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, ctime, overtime', 'numerical', 'integerOnly'=>true),
			array('erweimaurl, code, openid, type', 'length', 'max'=>255),
			array('channel', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, erweimaurl, code, openid, type, ctime, overtime, channel', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'erweimaurl' => 'Erweimaurl',
			'code' => 'Code',
			'openid' => 'Openid',
			'type' => 'Type',
			'ctime' => 'Ctime',
			'overtime' => 'Overtime',
			'channel' => 'Channel',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('erweimaurl',$this->erweimaurl,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('overtime',$this->overtime);
		$criteria->compare('channel',$this->channel,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StrasbourgCertificate the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
