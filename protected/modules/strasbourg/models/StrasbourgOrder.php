<?php

/**
 * This is the model class for table "{{strasbourg_order}}".
 *
 * The followings are the available columns in table '{{strasbourg_order}}':
 * @property integer $id
 * @property string $order_sn
 * @property string $activename
 * @property integer $pid
 * @property integer $uid
 * @property integer $state
 * @property integer $time
 * @property string $price
 * @property integer $cid
 * @property string $businesscode
 */
class StrasbourgOrder extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{strasbourg_order}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('order_sn, activename, pid, uid, time, price, cid', 'required'),
			array('pid, uid, state, time, cid', 'numerical', 'integerOnly'=>true),
			array('order_sn, activename', 'length', 'max'=>50),
			array('price', 'length', 'max'=>9),
			array('businesscode', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, order_sn, activename, pid, uid, state, time, price, cid, businesscode', 'safe', 'on'=>'search'),
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
			'order_sn' => 'Order Sn',
			'activename' => 'Activename',
			'pid' => 'Pid',
			'uid' => 'Uid',
			'state' => 'State',
			'time' => 'Time',
			'price' => 'Price',
			'cid' => 'Cid',
			'businesscode' => 'Businesscode',
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
		$criteria->compare('order_sn',$this->order_sn,true);
		$criteria->compare('activename',$this->activename,true);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('state',$this->state);
		$criteria->compare('time',$this->time);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('cid',$this->cid);
		$criteria->compare('businesscode',$this->businesscode,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StrasbourgOrder the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
