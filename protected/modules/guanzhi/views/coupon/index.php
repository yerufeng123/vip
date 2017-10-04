<?php
/* @var $this CouponController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Guanzhi Coupons',
);

$this->menu=array(
	array('label'=>'Create GuanzhiCoupon', 'url'=>array('create')),
	array('label'=>'Manage GuanzhiCoupon', 'url'=>array('admin')),
);
?>

<h1>Guanzhi Coupons</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
