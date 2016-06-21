<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\UserModel;
use Home\Model\MenuModel;
use Home\Model;


class UserController extends Controller{
    
    private $userModel;
    private $menuModel;
    private $userModel2;
    
    public function __construct(){
        parent::__construct();
        $this->userModel = new UserModel();
        $this->menuModel = new MenuModel();
        $this->userModel2 = M("tb_user");
    }
    
    
    public function login(){
         $userName = $_POST["userName"];
         $userPass = $_POST["userPass"];
         $i = $this->userModel->login($userName,$userPass);
         if ($i == 1) {
             $user = $this->userModel->loginUserByName($userName);
             $_SESSION["loginUser"] = $user;
             $uid = $_SESSION["loginUser"][0];
             $secondMenu = $this->menuModel->loadTreeMenu($uid);
             $_SESSION["secondMenu"] = $secondMenu;
             header("location:http://localhost:8080/myphp/welcome.php");
         }else if ($i == 2) {
             $_SESSION["loginError"] = "用户名不存在！";
             header("location:http://localhost:8080/myphp/login.php");
         }else{
             $_SESSION["loginError"] = "密码错误！";
             header("location:http://localhost:8080/myphp/login.php");
        }
        
         
    }
    
    /**
     * 查询班主任
     */
    public function loadAllHeader(){
        $options = array(array("uid"=>-1,"truename"=>"请指定合并后班主任名称"));
        $data = $this->userModel2->field("uid,trueName")->where("userType=1")->select();
        foreach($data as $d){
            array_push($options, $d);
        }
        $this->ajaxReturn($options);
    }
    
    /**
     * 查询项目经理
     */
    public function loadAllMenger(){
        $options = array(array("uid"=>-1,"truename"=>"请指定合并后项目经理名称"));
        $data = $this->userModel2->field("uid,trueName")->where("userType=3")->select();
        foreach($data as $d){
            array_push($options, $d);
        }
        $this->ajaxReturn($options);
    }
    
}

?>
