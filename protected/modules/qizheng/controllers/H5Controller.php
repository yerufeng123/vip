<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class H5Controller extends Controller {

    public function actionHtml1() {
        $this->renderPartial('index');
    }
    
     public function actionHtml2() {
        $this->renderPartial('index2');
    }
    
     public function actionHtml3() {
        $this->renderPartial('index3');
    }
    
     public function actionHtml4() {
        $this->renderPartial('index4');
    }

    

}
