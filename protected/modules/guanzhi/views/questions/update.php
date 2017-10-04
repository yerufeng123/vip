<?php
/* @var $this QuestionsController */
/* @var $model GuanzhiQuestions */

$this->breadcrumbs=array(
	'Guanzhi Questions'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List GuanzhiQuestions', 'url'=>array('index')),
	array('label'=>'Create GuanzhiQuestions', 'url'=>array('create')),
	array('label'=>'View GuanzhiQuestions', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage GuanzhiQuestions', 'url'=>array('admin')),
);
?>

<h1>Update GuanzhiQuestions <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>