<?php

header('content-type:text/html;charset=utf-8');
error_reporting(E_ALL ^ E_NOTICE);

class RecruitController extends BaseController {

    //招聘管理
    public function actionIndex() {
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;

        $where = '';


        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_jinganshun_recruiter where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        } else {
            $sql = "select * from vip_jinganshun_recruiter order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理资料图片和发布人和所属产品
//        foreach ($data as $key => $value) {
//            $data[$key]['little_pic'] = Yii::app()->request->hostInfo . '/' . $value['little_pic'];
//            $admin = new QizhengAdministrator();
//            $admin1 = $admin->getAdminInfo($value['aid']);
//            $data[$key]['adminname'] = $admin1['name'];
//            $product=new QizhengProduct();
//            $product1 =$product->getProductInfo($value['pid']);
//            $data[$key]['productname'] = $product1['name'];
//        }
        if (!empty($where)) {
            $sql2 = "select * from vip_jinganshun_recruiter where {$where}";
        } else {
            $sql2 = "select count(id) as num from vip_jinganshun_recruiter";
        }
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }

        //实现分页
        include_once 'page.php';
        $this->renderPartial('index', array(
            'page' => $show,
            'search' => $search,
            'list' => $result['content'],
        ));
    }
    
    //招聘管理--删除应聘人
    public function actionRecruiterdelete(){
        $_POST['id'] = $_GET['id'];
        $recruit = JinganshunRecruiter::model();
        $recruitnum = $recruit->deleteByPk($_POST['id']);
        if ($recruitnum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    /*     * *******************************************以下备删********************************************************** */

    //招聘管理---轮播图
    public function actionPics() {
        if (Yii::app()->request->isAjaxRequest) {
            $other = JinganshunOther::model()->findByPk($_POST['pid']);
            $other->content = trim($_POST['pic'], ',');
            $other->ctime = time();
            if ($other->save()) {
                returnJson('成功', '100000');
            } else {
                returnJson('保存轮播图失败', '600001');
            }
        } else {
            $sql = "select * from vip_jinganshun_other where type=3 order by ctime desc";
            $pics = Yii::app()->db->createCommand($sql)->queryRow();
            $pics['pic2'] = explode(',', $pics['content']);
            $this->renderPartial('pics', array('data' => $pics));
        }
    }

    //总模板  ----添加
    public function actionModeladd() {
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($_POST['title']) || empty($_POST['little_pic']) || empty($_POST['content'])) {
                returnJson('缺少必填项', '600002');
            }
            $recruit = new JinganshunRecruit();
            $recruit->title = $_POST['title'];
            $recruit->pic = $_POST['little_pic'];
            $recruit->content = $_POST['content'];
            $recruit->type = $_POST['type'];
            $recruit->ctime = time();
            if ($recruit->save()) {
                returnJson('增加成功', '100000');
            } else {
                returnJson('保存失败', '600003');
            }
        } else {
            $this->renderPartial('modeladd');
        }
    }

    //总模板  ----修改
    public function actionModeleditor() {
        if (Yii::app()->request->isAjaxRequest) {
            
        } else {
            $_POST = array_merge($_GET, $_POST);
            unset($_POST['_URL_']);

            //如果页数为空，默认为1
            $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
            //给模板查询区域赋值
            $data = $_POST;
            $search = $_POST;

            $where = '';


            $page = $_POST['p']; //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            if (!empty($where)) {
                $sql = "select * from vip_jinganshun_modelone where oid={$_POST['id']} and {$where} order by ctime desc limit {$startnum},{$pernum} ";
            } else {
                $sql = "select * from vip_jinganshun_modelone where oid={$_POST['id']} order by ctime desc limit {$startnum},{$pernum}";
            }
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            //处理模板名称和图片
            foreach ($data as $key => $value) {
                $data[$key]['oid'] = JinganshunRecruit::getName($value['oid']);
                $data[$key]['pics'] = explode(',', $value['pic']);
            }
            if (!empty($where)) {
                $sql2 = "select * from vip_jinganshun_modelone where oid={$_POST['id']} and {$where}";
            } else {
                $sql2 = "select count(id) as num from vip_jinganshun_modelone where oid={$_POST['id']}";
            }
            $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if (!empty($data)) {
                $result['content'] = $data;
                $result['count'] = $data2[0]['num'];
            } else {
                $result['content'] = array();
                $result['count'] = $data2[0]['num'];
            }

            //实现分页
            include_once 'page.php';
            $this->renderPartial('modeleditor', array(
                'page' => $show,
                //'search' => $search,
                'list' => $result['content'],
            ));
        }
    }

    //总模板  ----删除
    public function actionModeldelete() {
        $_POST['id'] = $_GET['id'];
        $recruit = JinganshunRecruit::model();
        $recruitnum = $recruit->deleteByPk($_POST['id']);
        if ($recruitnum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //模板一  ----首页
    public function actionModelone() {

        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;

        $where = '';


        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select * from vip_jinganshun_recruit where type={$_POST['type']} and {$where} order by ctime desc limit {$startnum},{$pernum} ";
        } else {
            $sql = "select * from vip_jinganshun_recruit where type={$_POST['type']} order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理资料图片和发布人和所属产品
//        foreach ($data as $key => $value) {
//            $data[$key]['little_pic'] = Yii::app()->request->hostInfo . '/' . $value['little_pic'];
//            $admin = new QizhengAdministrator();
//            $admin1 = $admin->getAdminInfo($value['aid']);
//            $data[$key]['adminname'] = $admin1['name'];
//            $product=new QizhengProduct();
//            $product1 =$product->getProductInfo($value['pid']);
//            $data[$key]['productname'] = $product1['name'];
//        }
        if (!empty($where)) {
            $sql2 = "select * from vip_jinganshun_recruit where type={$_POST['type']} and {$where}";
        } else {
            $sql2 = "select count(id) as num from vip_jinganshun_recruit where type={$_POST['type']}";
        }
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }

        //实现分页
        include_once 'page.php';
        $this->renderPartial('modelone', array(
            'page' => $show,
            'search' => $search,
            'list' => $result['content'],
        ));
    }

    //模板一  ----添加
    public function actionModeloneadd() {
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($_POST['title']) || empty($_POST['pic'])) {
                returnJson('缺少必填项', '600004');
            }
            $modelone = new JinganshunModelone();
            $modelone->title = $_POST['title'];
            $modelone->pic = trim($_POST['pic'], ',');
            $modelone->ctime = time();
            $modelone->oid = $_POST['oid'];
            if ($modelone->save()) {
                returnJson('增加成功', '100000');
            } else {
                returnJson('保存失败', '600005');
            }
        } else {
            $this->renderPartial('modeloneadd');
        }
    }

    //模板一  ----修改
    public function actionModeloneeditor() {
        if (!Yii::app()->request->isAjaxRequest) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql = "select * from vip_jinganshun_modelone where id='{$_POST['id']}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $data[0]['pic2'] = explode(',', $data[0]['pic']);
            $this->renderPartial('modeloneeditor', array(
                'list' => $data[0],
            ));
        } else {
            if (empty($_POST['title']) || empty($_POST['pic'])) {
                returnJson('缺少必填项', '600006');
            }

            $modelone = JinganshunModelone::model()->findByPk($_POST['id']);
            $modelone->title = $_POST['title'];
            $modelone->pic = trim($_POST['pic'], ',');
            if ($modelone->save()) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新失败', '600007');
            }
        }
    }

    //模板一  ----删除
    public function actionModelonedelete() {
        $_POST['id'] = $_GET['id'];
        $modelone = JinganshunModelone::model();
        $modelonenum = $modelone->deleteByPk($_POST['id']);
        if ($modelonenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //获取答题结果
    public function actionAsk() {
        $_POST = array_merge($_GET, $_POST);
        unset($_POST['_URL_']);

        //如果页数为空，默认为1
        $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
        //给模板查询区域赋值
        $data = $_POST;
        $search = $_POST;

        $where = '';
        /*
         * 获取管理员列表
         */
        /* 查询条件拼写 */
        //状态
        if (!empty($data['state'])) {
            $where.=' and state =' . $data['state'];
        }

        //姓名
        if (!empty($data['name'])) {
            $where.=' and name like "%' . $data['name'] . '%"';
        }
        //开始时间
        if (!empty($data['stime'])) {
            $stime = strtotime($data['stime']);
            $where.=' and a.ctime >= ' . $stime;
        }

        //结束时间
        if (!empty($data['etime'])) {
            $etime = strtotime($data['etime']) + 24 * 60 * 60;
            $where.=' and a.ctime <= ' . $etime;
        }
        $where = substr($where, 4);

        $page = $_POST['p']; //第几页
        $pernum = 5; //每页显示数
        $startnum = ($page - 1) * $pernum;
        if (!empty($where)) {
            $sql = "select a.id,a.openid,a.state,a.ctime,b.name,b.username from vip_jinganshun_askresult as a left join vip_jinganshun_user b on b.openid=a.openid where {$where} order by ctime desc limit {$startnum},{$pernum} ";
        } else {
            $sql = "select a.id,a.openid,a.state,a.ctime,b.name,b.username from vip_jinganshun_askresult as a left join vip_jinganshun_user b on b.openid=a.openid order by ctime desc limit {$startnum},{$pernum}";
        }
        $data = Yii::app()->db->createCommand($sql)->queryAll();
        //处理资料图片和发布人和所属产品
//        foreach ($data as $key => $value) {
//            $data[$key]['little_pic'] = Yii::app()->request->hostInfo . '/' . $value['little_pic'];
//            $admin = new QizhengAdministrator();
//            $admin1 = $admin->getAdminInfo($value['aid']);
//            $data[$key]['adminname'] = $admin1['name'];
//            $product=new QizhengProduct();
//            $product1 =$product->getProductInfo($value['pid']);
//            $data[$key]['productname'] = $product1['name'];
//        }
        if (!empty($where)) {
            $sql2 = "select a.id,a.openid,a.state,a.ctime,b.name,b.username from vip_jinganshun_askresult as a left join vip_jinganshun_user b on b.openid=a.openid where {$where}";
        } else {
            $sql2 = "select count(id) as num from vip_jinganshun_askresult";
        }
        $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
        if (!empty($data)) {
            $result['content'] = $data;
            $result['count'] = $data2[0]['num'];
        } else {
            $result['content'] = array();
            $result['count'] = $data2[0]['num'];
        }

        //实现分页
        include_once 'page.php';
        $this->renderPartial('ask', array(
            'page' => $show,
            'search' => $search,
            'list' => $result['content'],
        ));
    }

    //有奖征稿---活动规则
    public function actionArticle() {
        if (Yii::app()->request->isAjaxRequest) {
            $rule = JinganshunOther::model()->findByPk($_POST['id']);
            $rule->content = $_POST['content'];
            $rule->ctime = time();
            if ($rule->save()) {
                returnJson('成功', '100000');
            } else {
                returnJson('更新失败', '500001');
            }
        } else {
            $sql = "select * from vip_jinganshun_other where type=1 order by ctime desc";
            $rule = Yii::app()->db->createCommand($sql)->queryRow();


            $_POST = array_merge($_GET, $_POST);
            unset($_POST['_URL_']);

            //如果页数为空，默认为1
            $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
            //给模板查询区域赋值
            $data = $_POST;
            $search = $_POST;

            $where = '';
            /*
             * 获取管理员列表
             */
            /* 查询条件拼写 */

            //姓名
            if (!empty($data['name'])) {
                $where.=' and name like "%' . $data['name'] . '%"';
            }
            //手机号
            if (!empty($data['phone'])) {
                $where.=' and phone like "%' . $data['phone'] . '%"';
            }
            //分数
            if (!empty($data['score'])) {
                $where.=' and score >= ' . $data['score'];
            }

            $where = substr($where, 4);

            $page = $_POST['p']; //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            if (!empty($where)) {
                $sql = "select a.id,a.openid,a.title,a.ctime,a.score,b.name,b.phone from vip_jinganshun_article as a left join vip_jinganshun_user b on b.openid=a.openid where {$where} order by ctime desc limit {$startnum},{$pernum} ";
            } else {
                $sql = "select a.id,a.openid,a.title,a.ctime,a.score,b.name,b.phone from vip_jinganshun_article as a left join vip_jinganshun_user b on b.openid=a.openid order by ctime desc limit {$startnum},{$pernum}";
            }
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            if (!empty($where)) {
                $sql2 = "select a.id,a.openid,a.title,a.ctime,a.score,b.name,b.phone from vip_jinganshun_article as a left join vip_jinganshun_user b on b.openid=a.openid where {$where}";
            } else {
                $sql2 = "select count(id) as num from vip_jinganshun_article";
            }
            $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if (!empty($data)) {
                $result['content'] = $data;
                $result['count'] = $data2[0]['num'];
            } else {
                $result['content'] = array();
                $result['count'] = $data2[0]['num'];
            }

            //实现分页
            include_once 'page.php';
            $this->renderPartial('article', array(
                'page' => $show,
                'search' => $search,
                'list' => $result['content'],
                'data' => $rule,
            ));
        }
    }

    //有奖征稿---修改
    public function actionArticle_editor() {
        if (!Yii::app()->request->isAjaxRequest) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql = "select * from vip_jinganshun_article where id='{$_POST['id']}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('articleeditor', array(
                'list' => $data[0],
            ));
        } else {
            if (empty($_POST['score'])) {
                $_POST['score'] = 0;
            }

            $article = JinganshunArticle::model()->findByPk($_POST['id']);
            $article->score = $_POST['score'];
            if ($article->save()) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新成绩失败', '500002');
            }
        }
    }

    //有奖征稿---删除
    public function actionArticle_delete() {
        $_POST['id'] = $_GET['id'];
        $article = JinganshunArticle::model();
        $articlenum = $article->deleteByPk($_POST['id']);
        if ($articlenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //评选系统
    public function actionElect() {
        if (Yii::app()->request->isAjaxRequest) {
            $rule = JinganshunOther::model()->findByPk($_POST['id']);
            $rule->content = $_POST['content'];
            $rule->ctime = time();
            if ($rule->save()) {
                returnJson('成功', '100000');
            } else {
                returnJson('更新失败', '500001');
            }
        } else {
            $sql = "select * from vip_jinganshun_other where type=2 order by ctime desc";
            $rule = Yii::app()->db->createCommand($sql)->queryRow();


            $_POST = array_merge($_GET, $_POST);
            unset($_POST['_URL_']);

            //如果页数为空，默认为1
            $_POST['p'] = !empty($_GET['p']) ? $_GET['p'] : '1';
            //给模板查询区域赋值
            $data = $_POST;
            $search = $_POST;

            $where = '';
            /*
             * 获取管理员列表
             */
            /* 查询条件拼写 */
            //类型
            if (!empty($data['type'])) {
                $where.=' and type = ' . $data['type'];
            }

            //姓名
            if (!empty($data['name'])) {
                $where.=' and name like "%' . $data['name'] . '%"';
            }


            $where = substr($where, 4);

            $page = $_POST['p']; //第几页
            $pernum = 5; //每页显示数
            $startnum = ($page - 1) * $pernum;
            if (!empty($where)) {
                $sql = "select * from vip_jinganshun_elect where {$where} order by ctime desc limit {$startnum},{$pernum} ";
            } else {
                $sql = "select * from vip_jinganshun_elect order by ctime desc limit {$startnum},{$pernum}";
            }
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            if (!empty($where)) {
                $sql2 = "select * from vip_jinganshun_elect where {$where}";
            } else {
                $sql2 = "select count(id) as num from vip_jinganshun_elect";
            }
            $data2 = Yii::app()->db->createCommand($sql2)->queryAll();
            if (!empty($data)) {
                $result['content'] = $data;
                $result['count'] = $data2[0]['num'];
            } else {
                $result['content'] = array();
                $result['count'] = $data2[0]['num'];
            }

            //实现分页
            include_once 'page.php';
            $this->renderPartial('elect', array(
                'page' => $show,
                'search' => $search,
                'list' => $result['content'],
                'data' => $rule,
            ));
        }
    }

    //评选系统----增加一条
    public function actionElect_add() {
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($_POST['name']) || empty($_POST['content']) || empty($_POST['little_pic'])) {
                returnJson('缺少必填项', '500002');
            }
            $elect = new JinganshunElect();
            $elect->type = $_POST['type'];
            $elect->name = $_POST['name'];
            $elect->pic = $_POST['little_pic'];
            $elect->content = $_POST['content'];
            $elect->ctime = time();
            if ($elect->save()) {
                returnJson('增加成功', '100000');
            } else {
                returnJson('保存失败', '500003');
            }
        } else {
            $this->renderPartial('electadd');
        }
    }

    //评选系统---修改
    public function actionElect_editor() {
        if (!Yii::app()->request->isAjaxRequest) {
            $_POST['id'] = $_GET['id'];
            $where = array('id' => $_POST['id']);
            $sql = "select * from vip_jinganshun_elect where id='{$_POST['id']}'";
            $data = Yii::app()->db->createCommand($sql)->queryAll();
            $this->renderPartial('electeditor', array(
                'list' => $data[0],
            ));
        } else {
            if (empty($_POST['type']) || empty($_POST['name']) || empty($_POST['content']) || empty($_POST['little_pic'])) {
                returnJson('缺少必填项', '500004');
            }

            $elect = JinganshunElect::model()->findByPk($_POST['id']);
            $elect->type = $_POST['type'];
            $elect->name = $_POST['name'];
            $elect->content = $_POST['content'];
            $elect->pic = $_POST['little_pic'];
            if ($elect->save()) {
                //更新成功
                returnJson('成功', '100000');
            } else {
                returnJson('更新评选失败', '500005');
            }
        }
    }

    //评选系统---删除
    public function actionElect_delete() {
        $_POST['id'] = $_GET['id'];
        $elect = JinganshunElect::model();
        $electnum = $elect->deleteByPk($_POST['id']);
        if ($electnum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

    //招聘管理---区域管理首页
    public function actionArea() {
        $sql = "select * from vip_jinganshun_area where pid=0";
        $first = Yii::app()->db->createCommand($sql)->queryAll();
        $this->renderPartial('area', array('list' => $first));
    }

    //招聘管理--- 一级区域添加
    public function actionAreaadd() {
        if (Yii::app()->request->isAjaxRequest) {
            if (empty($_GET['name'])) {
                
            }
        } else {
            $this->renderPartial('areaadd');
        }
    }

    //招聘管理--- 一级区域修改
    public function actionAreaeditor() {
        if (Yii::app()->request->isAjaxRequest) {
            
        } else {
            $this->renderPartial('areaeditor');
        }
    }

    //招聘管理--- 一级区域删除
    public function actionAreadelete() {
        $_POST['id'] = $_GET['id'];
        $article = JinganshunArticle::model();
        $articlenum = $article->deleteByPk($_POST['id']);
        if ($articlenum > 0) {

            $this->renderPartial('../public/success', array(
                'message' => '删除成功！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        } else {
            $this->renderPartial('../public/error', array(
                'message' => '删除失败！',
                'jumpUrl' => $_SERVER['HTTP_REFERER'],
                'waitSecond' => 3,
            ));
        }
    }

}
