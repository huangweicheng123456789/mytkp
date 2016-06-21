<?php
namespace Home\Controller;
use Home\Model\MenuModel;
use Think\Controller;
class MenuController extends Controller{
    private $menuModel;
    
    public function __construct(){
        parent::__construct();
        $this->menuModel = new MenuModel();
        
    }
    /**
     * 分页查询菜单例表
     * @param number $pageNo
     * @param number $pageSize
     */
    public function loadMenuByPage($pageNo=1,$pageSize=10){
        $page = $this->menuModel->loadByIdMenu($pageNo,$pageSize);
        $this->ajaxReturn($page);
    }
    
    
    public function menuMange(){
        $this->assign("root",ROOT);
        $this->display();
    }
    
    /**
     * 
     */
   
    /**
     * 分页查询菜单例表
     * @return 异步返回并输出json字符串
     */
//     public function loadMenuByPage() {
//         $pageNo = (int)$_GET["pageNo"];
//         $pageSize = (int)$_GET["pageSize"];
//         $page = $this->menuModel->loadMenuByPage($pageNo, $pageSize);
//         $jsonStr = json_encode($page);
//         echo $jsonStr;
//     }
    
    
}

?>