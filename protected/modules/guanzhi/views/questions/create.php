<?php
/* @var $this QuestionsController */
/* @var $model GuanzhiQuestions */

$this->breadcrumbs=array(
	'Guanzhi Questions'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List GuanzhiQuestions', 'url'=>array('index')),
	array('label'=>'Manage GuanzhiQuestions', 'url'=>array('admin')),
);
?>

<h1>Create GuanzhiQuestions</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>