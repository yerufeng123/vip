<?php

/**
 * This is the model class for table "{{yiqi_user}}".
 *
 * The followings are the available columns in table '{{yiqi_user}}':
 * @property integer $id
 * @property string $business
 * @property string $address1
 * @property string $phone
 * @property string $address2
 * @property string $code
 * @property integer $todaynum
 * @property integer $totalnum
 * @property integer $ctime
 * @property string $erweima
 * @property string $weixin
 */
class YiqiUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{yiqi_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('address1, address2', 'required'),
			array('todaynum, totalnum, ctime', 'numerical', 'integerOnly'=>true),
			array('business, address2, erweima, weixin', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			array('code', 'length', 'max'=>20),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, business, address1, phone, address2, code, todaynum, totalnum, ctime, erweima, weixin', 'safe', 'on'=>'search'),
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
			'business' => 'Business',
			'address1' => 'Address1',
			'phone' => 'Phone',
			'address2' => 'Address2',
			'code' => 'Code',
			'todaynum' => 'Todaynum',
			'totalnum' => 'Totalnum',
			'ctime' => 'Ctime',
			'erweima' => 'Erweima',
			'weixin' => 'Weixin',
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
		$criteria->compare('business',$this->business,true);
		$criteria->compare('address1',$this->address1,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('address2',$this->address2,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('todaynum',$this->todaynum);
		$criteria->compare('totalnum',$this->totalnum);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('erweima',$this->erweima,true);
		$criteria->compare('weixin',$this->weixin,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return YiqiUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
