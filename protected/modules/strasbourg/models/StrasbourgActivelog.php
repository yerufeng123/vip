<?php

/**
 * This is the model class for table "{{strasbourg_activelog}}".
 *
 * The followings are the available columns in table '{{strasbourg_activelog}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $cid
 * @property string $activename
 * @property integer $num
 * @property integer $ctime
 * @property integer $state
 * @property integer $pid
 * @property string $price
 * @property string $goods_json
 */
class StrasbourgActivelog extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{strasbourg_activelog}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('pid', 'required'),
			array('uid, cid, num, ctime, state, pid', 'numerical', 'integerOnly'=>true),
			array('activename', 'length', 'max'=>255),
			array('price', 'length', 'max'=>9),
			array('goods_json', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, uid, cid, activename, num, ctime, state, pid, price, goods_json', 'safe', 'on'=>'search'),
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
			'cid' => 'Cid',
			'activename' => 'Activename',
			'num' => 'Num',
			'ctime' => 'Ctime',
			'state' => 'State',
			'pid' => 'Pid',
			'price' => 'Price',
			'goods_json' => 'Goods Json',
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
		$criteria->compare('cid',$this->cid);
		$criteria->compare('activename',$this->activename,true);
		$criteria->compare('num',$this->num);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('state',$this->state);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('goods_json',$this->goods_json,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return StrasbourgActivelog the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
