<?php
header('content-type:text/html;charset=utf-8');
/**
 * This is the model class for table "{{bairong_administrator}}".
 *
 * The followings are the available columns in table '{{bairong_administrator}}':
 * @property integer $id
 * @property string $username
 * @property string $password
 * @property string $name
 * @property integer $role
 * @property string $sex
 * @property string $address
 * @property string $qq
 * @property string $phone
 * @property integer $ctime
 * @property integer $enable
 */
class BairongAdministrator extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{bairong_administrator}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('role, ctime, enable', 'numerical', 'integerOnly'=>true),
			array('username', 'length', 'max'=>30),
			array('password', 'length', 'max'=>64),
			array('name', 'length', 'max'=>20),
			array('sex', 'length', 'max'=>6),
			array('address', 'length', 'max'=>200),
			array('qq', 'length', 'max'=>13),
			array('phone', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, username, password, name, role, sex, address, qq, phone, ctime, enable', 'safe', 'on'=>'search'),
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
			'username' => 'Username',
			'password' => 'Password',
			'name' => 'Name',
			'role' => 'Role',
			'sex' => 'Sex',
			'address' => 'Address',
			'qq' => 'Qq',
			'phone' => 'Phone',
			'ctime' => 'Ctime',
			'enable' => 'Enable',
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
		$criteria->compare('username',$this->username,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('role',$this->role);
		$criteria->compare('sex',$this->sex,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('enable',$this->enable);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Administrator the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        //根据管理员id获取管理员信息
        public function getAdminInfo($id){
            $sql="select * from vip_bairong_administrator where id=".$id;
            $admin=Yii::app()->db->createCommand($sql)->queryAll();
            $admin1=  empty($admin)? array() : $admin[0];
            return $admin1;
        }
        
        //根据管理员username 获取管理员信息
        public function getAdminInfo2($username){
            $sql="select * from vip_bairong_administrator where username='{$username}'";
            $admin=Yii::app()->db->createCommand($sql)->queryAll();
            $admin1=  empty($admin)? array() : $admin[0];
            return $admin1;
        }
        
        //根据管理员id,role ,username,查找用户是否存在
        public function checkAdmin($id,$role,$username){
            $sql="select id from vip_bairong_administrator where id={$id} and role={$role} and username='{$username}'";
            $admin=Yii::app()->db->createCommand($sql)->queryAll();
            if(empty($admin)){
                return false;
            }
            return true;
        }
        
        
        
        
        
}
