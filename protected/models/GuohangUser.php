<?php

/**
 * This is the model class for table "{{guohang_user}}".
 *
 * The followings are the available columns in table '{{guohang_user}}':
 * @property integer $id
 * @property string $openid
 * @property string $name
 * @property string $nickname
 * @property string $sex
 * @property string $province
 * @property string $wxcity
 * @property string $country
 * @property string $headimgurl
 * @property string $content
 * @property integer $select
 * @property integer $ctime
 */
class GuohangUser extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{guohang_user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('select, ctime', 'numerical', 'integerOnly'=>true),
			array('openid, nickname, sex, province, wxcity, country, headimgurl', 'length', 'max'=>255),
			array('name', 'length', 'max'=>50),
			array('content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, openid, name, nickname, sex, province, wxcity, country, headimgurl, content, select, ctime', 'safe', 'on'=>'search'),
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
			'nickname' => 'Nickname',
			'sex' => 'Sex',
			'province' => 'Province',
			'wxcity' => 'Wxcity',
			'country' => 'Country',
			'headimgurl' => 'Headimgurl',
			'content' => 'Content',
			'select' => 'Select',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('nickname',$this->nickname,true);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('province',$this->province,true);
		$criteria->compare('wxcity',$this->wxcity,true);
		$criteria->compare('country',$this->country,true);
		$criteria->compare('headimgurl',$this->headimgurl,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('select',$this->select);
		$criteria->compare('ctime',$this->ctime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return GuohangUser the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
