<?php
/* @var $this CouponController */
/* @var $model GuanzhiCoupon */

$this->breadcrumbs=array(
	'Guanzhi Coupons'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GuanzhiCoupon', 'url'=>array('index')),
	array('label'=>'Manage GuanzhiCoupon', 'url'=>array('admin')),
);
?>

<h1>Create GuanzhiCoupon</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>