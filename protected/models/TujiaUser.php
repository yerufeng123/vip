<?php

/**
 * This is the model class for table "{{tujia_user}}".
 *
 * The followings are the available columns in table '{{tujia_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $phone
 * @property string $room
 * @property integer $year
 * @property integer $mouth
 * @property integer $day
 * @property string $fname
 * @property integer $ctime
 * @property string $code
 */
class TujiaUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{tujia_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('year, mouth, day, ctime', 'numerical', 'integerOnly'=>true),
			array('openid, code', 'length', 'max'=>255),
			array('name, fname', 'length', 'max'=>30),
			array('phone', 'length', 'max'=>11),
			array('room', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, name, phone, room, year, mouth, day, fname, ctime, code', 'safe', 'on'=>'search'),
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
			'room' => 'Room',
			'year' => 'Year',
			'mouth' => 'Mouth',
			'day' => 'Day',
			'fname' => 'Fname',
			'ctime' => 'Ctime',
			'code' => 'Code',
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
		$criteria->compare('room',$this->room,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('mouth',$this->mouth);
		$criteria->compare('day',$this->day);
		$criteria->compare('fname',$this->fname,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('code',$this->code,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TujiaUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
