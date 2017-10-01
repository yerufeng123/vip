<?php

/**
 * This is the model class for table "{{aotocom_user}}".
 *
 * The followings are the available columns in table '{{aotocom_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $phone
 * @property string $email
 * @property string $company
 * @property string $link
 * @property integer $ctime
 * @property string $viewnum
 */
class AotocomUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{aotocom_user}}';
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
			array('openid, email, company, link', 'length', 'max'=>255),
			array('name', 'length', 'max'=>50),
			array('phone', 'length', 'max'=>11),
			array('viewnum', 'length', 'max'=>5),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, name, phone, email, company, link, ctime, viewnum', 'safe', 'on'=>'search'),
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
			'email' => 'Email',
			'company' => 'Company',
			'link' => 'Link',
			'ctime' => 'Ctime',
			'viewnum' => 'Viewnum',
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
		$criteria->compare('email',$this->email,true);
		$criteria->compare('company',$this->company,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('viewnum',$this->viewnum,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return AotocomUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
