<?php

/**
 * This is the model class for table "{{qizheng_product}}".
 *
 * The followings are the available columns in table '{{qizheng_product}}':
 * @property integer $id
 * @property string $name
 * @property string $introduction
 * @property string $use_method
 * @property string $bad_reaction
 * @property string $taboo
 * @property string $pic
 * @property string $product_pic
 * @property integer $PX
 * @property integer $ctime
 * @property string $other
 * @property integer $aid
 */
class QizhengProduct extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{qizheng_product}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('introduction, use_method, bad_reaction, taboo, pic, product_pic, other', 'required'),
			array('PX, ctime, aid', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>200),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, name, introduction, use_method, bad_reaction, taboo, pic, product_pic, PX, ctime, other, aid', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'introduction' => 'Introduction',
			'use_method' => 'Use Method',
			'bad_reaction' => 'Bad Reaction',
			'taboo' => 'Taboo',
			'pic' => 'Pic',
			'product_pic' => 'Product Pic',
			'PX' => 'Px',
			'ctime' => 'Ctime',
			'other' => 'Other',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('introduction',$this->introduction,true);
		$criteria->compare('use_method',$this->use_method,true);
		$criteria->compare('bad_reaction',$this->bad_reaction,true);
		$criteria->compare('taboo',$this->taboo,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('product_pic',$this->product_pic,true);
		$criteria->compare('PX',$this->PX);
		$criteria->compare('ctime',$this->ctime);
		$criteria->compare('other',$this->other,true);
		$criteria->compare('aid',$this->aid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Product the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
                
        //根据产品id获取产品信息
        public function getProductInfo($id){
            $sql="select * from vip_qizheng_product where id='{$id}'";
            $data=  Yii::app()->db->createCommand($sql)->queryAll();
            if(empty($data)){
                return array();
            }else{
                return $data[0];
            }
        }
}
