<?php

class BaseController extends Controller {

    public $user_name; //当前管理员
    public $administrator;
    public $accessnum;//当前访问量

    
    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
        $this->administrator=new GuanzhiAdministrator();
        $this->login();
        $admin=$this->administrator->getAdminInfo($_SESSION['admin_id']);//获取当前用户的信息
        $this->user_name=$admin['name'];
        $this->accessnum=0;
        
    }
    
 
    /**
     * 检查管理员是否登录
     * 登录状态判断 $this->session中是否存在管理员id  管理员角色 和管理员账号
     */
    public function login() {
        //var_dump($this->session('admin_username'));die;
        //如果用户信息存在就检查数据库是否有该用户信息，如果不存在，直接跳到登录页面登录
        $admin_id=$this->session('admin_id');
        $admin_role=$this->session('admin_role');
        $admin_username=$this->session('admin_username');
        if (!empty($admin_id) && !empty($admin_role) && !empty($admin_username)) {
            $result = $this->administrator->checkAdmin($admin_id, $admin_role, $admin_username);
            if (!$result) {
                $this->redirect(array('login/index'));
                exit;
            }
        } else {
            $this->redirect(array('login/index'));
            exit;
        }
    }
    

}
