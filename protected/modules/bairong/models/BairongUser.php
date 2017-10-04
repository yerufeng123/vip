<?php

/**
 * This is the model class for table "{{bairong_user}}".
 *
 * The followings are the available columns in table '{{bairong_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $wxname
 * @property integer $friendnum
 * @property integer $totalnum
 * @property string $phone
 * @property integer $gid
 * @property integer $sid
 * @property integer $state
 * @property integer $gtime
 * @property integer $ctime
 */
class BairongUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{bairong_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('sid, ctime', 'required'),
			array('friendnum, totalnum, gid, sid, state, gtime, ctime', 'numerical', 'integerOnly'=>true),
			array('openid, wxname', 'length', 'max'=>255),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, wxname, friendnum, totalnum, phone, gid, sid, state, gtime, ctime', 'safe', 'on'=>'search'),
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
			'wxname' => 'Wxname',
			'friendnum' => 'Friendnum',
			'totalnum' => 'Totalnum',
			'phone' => 'Phone',
			'gid' => 'Gid',
			'sid' => 'Sid',
			'state' => 'State',
			'gtime' => 'Gtime',
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
		$criteria->compare('wxname',$this->wxname,true);
		$criteria->compare('friendnum',$this->friendnum);
		$criteria->compare('totalnum',$this->totalnum);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('gid',$this->gid);
		$criteria->compare('sid',$this->sid);
		$criteria->compare('state',$this->state);
		$criteria->compare('gtime',$this->gtime);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Game1 the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}