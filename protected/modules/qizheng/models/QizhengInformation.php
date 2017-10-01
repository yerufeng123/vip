<?php

/**
 * This is the model class for table "{{qizheng_information}}".
 *
 * The followings are the available columns in table '{{qizheng_information}}':
 * @property integer $id
 * @property string $title
 * @property string $little_pic
 * @property string $content
 * @property integer $display
 * @property integer $PX
 * @property integer $ctime
 * @property integer $pid
 * @property integer $aid
 */
class QizhengInformation extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{qizheng_information}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('display, PX, ctime, pid, aid', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			array('little_pic', 'length', 'max'=>255),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, title, little_pic, display, PX, ctime, pid, aid', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'little_pic' => 'Little Pic',
			'display' => 'Display',
			'PX' => 'Px',
			'ctime' => 'Ctime',
			'pid' => 'Pid',
			'aid' => 'Aid',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('little_pic',$this->little_pic,true);
		$criteria->compare('display',$this->display);
		$criteria->compare('PX',$this->PX);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('pid',$this->pid);
		$criteria->compare('aid',$this->aid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Information the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        //根据文献分类id,获取文献分类信息
        public function getInformationInfo($id){
            $sql="select * from vip_qizheng_information where id='{$id}'";
            $data=Yii::app()->db->createCommand($sql)->queryAll();
            return $data[0];
        }
        
}
