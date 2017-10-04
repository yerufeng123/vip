<?php

/**
 * This is the model class for table "{{guanzhi_user}}".
 *
 * The followings are the available columns in table '{{guanzhi_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $phone
 * @property string $code
 * @property integer $level
 * @property integer $score
 * @property integer $ranking
 * @property integer $coupon_id
 * @property integer $created_at
 * @property integer $updated_at
 */
class GuanzhiUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{guanzhi_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('level, score, ranking, coupon_id, created_at, updated_at', 'numerical', 'integerOnly'=>true),
			array('openid', 'length', 'max'=>255),
			array('name', 'length', 'max'=>30),
			array('phone, code', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, name, phone, code, level, score, ranking, coupon_id, created_at, updated_at', 'safe', 'on'=>'search'),
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
			'openid' => '微信openid',
			'name' => '用户姓名',
			'phone' => '用户手机号',
			'code' => '手机验证码',
			'level' => '用户游戏关数',
			'score' => '用户分数',
			'ranking' => '奖品等级',
			'coupon_id' => '关联券id',
			'created_at' => '创建时间',
			'updated_at' => '更新时间',
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
		$criteria->compare('code',$this->code,true);
		$criteria->compare('level',$this->level);
		$criteria->compare('score',$this->score);
		$criteria->compare('ranking',$this->ranking);
		$criteria->compare('coupon_id',$this->coupon_id);
		$criteria->compare('created_at',$this->created_at);
		$criteria->compare('updated_at',$this->updated_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GuanzhiUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
