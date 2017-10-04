<?php
/* @var $this QuestionsController */
/* @var $model GuanzhiQuestions */

$this->breadcrumbs=array(
	'Guanzhi Questions'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List GuanzhiQuestions', 'url'=>array('index')),
	array('label'=>'Create GuanzhiQuestions', 'url'=>array('create')),
	array('label'=>'Update GuanzhiQuestions', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete GuanzhiQuestions', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage GuanzhiQuestions', 'url'=>array('admin')),
);
?>

<h1>View GuanzhiQuestions #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'question',
		'options',
		'answer',
		'created_at',
		'created_by',
		'updated_at',
		'updated_by',
	),
)); ?>
