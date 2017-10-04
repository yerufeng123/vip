<?php
/* @var $this CouponController */
/* @var $model GuanzhiCoupon */

$this->breadcrumbs=array(
	'Guanzhi Coupons'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GuanzhiCoupon', 'url'=>array('index')),
	array('label'=>'Create GuanzhiCoupon', 'url'=>array('create')),
	array('label'=>'Update GuanzhiCoupon', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GuanzhiCoupon', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GuanzhiCoupon', 'url'=>array('admin')),
);
?>

<h1>View GuanzhiCoupon #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'couponnum',
		'type',
		'status',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	),
)); ?>
