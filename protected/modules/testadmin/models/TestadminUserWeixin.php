<?php

/**
 * This is the model class for table "{{testadmin_user_weixin}}".
 *
 * The followings are the available columns in table '{{testadmin_user_weixin}}':
 * @property integer $id
 * @property integer $uid
 * @property string $wxnickname
 * @property integer $wxsex
 * @property string $wxprovince
 * @property string $wxcity
 * @property string $wxcountry
 * @property string $wxheadimgurl
 * @property string $openid
 * @property integer $bindstatus
 * @property integer $ctime
 */
class TestadminUserWeixin extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{testadmin_user_weixin}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('uid, wxsex, bindstatus, ctime', 'numerical', 'integerOnly'=>true),
			array('wxnickname, wxprovince, wxcity, wxcountry, wxheadimgurl, openid', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, wxnickname, wxsex, wxprovince, wxcity, wxcountry, wxheadimgurl, openid, bindstatus, ctime', 'safe', 'on'=>'search'),
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
			'wxnickname' => 'Wxnickname',
			'wxsex' => 'Wxsex',
			'wxprovince' => 'Wxprovince',
			'wxcity' => 'Wxcity',
			'wxcountry' => 'Wxcountry',
			'wxheadimgurl' => 'Wxheadimgurl',
			'openid' => 'Openid',
			'bindstatus' => 'Bindstatus',
			'ctime' => 'Ctime',
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
		$criteria->compare('wxnickname',$this->wxnickname,true);
		$criteria->compare('wxsex',$this->wxsex);
		$criteria->compare('wxprovince',$this->wxprovince,true);
		$criteria->compare('wxcity',$this->wxcity,true);
		$criteria->compare('wxcountry',$this->wxcountry,true);
		$criteria->compare('wxheadimgurl',$this->wxheadimgurl,true);
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('bindstatus',$this->bindstatus);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TestadminUserWeixin the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
