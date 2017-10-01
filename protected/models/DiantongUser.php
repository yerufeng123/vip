<?php

/**
 * This is the model class for table "{{diantong_user}}".
 *
 * The followings are the available columns in table '{{diantong_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $phone
 * @property double $price1
 * @property double $price2
 * @property integer $gtime1
 * @property integer $gtime2
 * @property integer $ctime
 */
class DiantongUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{diantong_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('gtime1, gtime2, ctime', 'numerical', 'integerOnly'=>true),
			array('price1, price2', 'numerical'),
			array('openid', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, phone, price1, price2, gtime1, gtime2, ctime', 'safe', 'on'=>'search'),
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
			'phone' => 'Phone',
			'price1' => 'Price1',
			'price2' => 'Price2',
			'gtime1' => 'Gtime1',
			'gtime2' => 'Gtime2',
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
		$criteria->compare('openid',$this->openid,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('price1',$this->price1);
		$criteria->compare('price2',$this->price2);
		$criteria->compare('gtime1',$this->gtime1);
		$criteria->compare('gtime2',$this->gtime2);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return DiantongUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
