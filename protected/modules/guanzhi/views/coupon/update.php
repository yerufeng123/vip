<?php
/* @var $this CouponController */
/* @var $model GuanzhiCoupon */

$this->breadcrumbs=array(
	'Guanzhi Coupons'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GuanzhiCoupon', 'url'=>array('index')),
	array('label'=>'Create GuanzhiCoupon', 'url'=>array('create')),
	array('label'=>'View GuanzhiCoupon', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GuanzhiCoupon', 'url'=>array('admin')),
);
?>

<h1>Update GuanzhiCoupon <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>