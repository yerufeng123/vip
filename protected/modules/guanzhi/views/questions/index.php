<?php
/* @var $this QuestionsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Guanzhi Questions',
);

$this->menu=array(
	array('label'=>'Create GuanzhiQuestions', 'url'=>array('create')),
	array('label'=>'Manage GuanzhiQuestions', 'url'=>array('admin')),
);
?>

<h1>Guanzhi Questions</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
