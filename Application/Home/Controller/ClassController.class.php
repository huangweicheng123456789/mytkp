<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
use Home\entity\Menu;
class ClassController extends Controller{
    private $classModel;
    
    
    public function __construct(){
        parent::__construct();
        //直接实例化Model类 ，用来完成简单的增删改查操作
        //$this->classModel = new Model("class","",c("DB_DSN"));
        //$this->classModel = M("tb_user");//new Model();
       $this->classModel = new Model("class");
    }
    
    
    public function classMange(){
        $this->display();
    }
    
    
//     public function loadClassByPage(){
//         $count = $this->classModel->find("count(*) as cc")->find()["cc"];
//         $page["total"]= $count;
//         $rows = $this->classModel->page($pageNo,$pageSize)->select();
//         $page["rows"]= $rows;
//         $this->ajaxReturn($rows);
//     }
    
    public function loadClassByPage($pageNo=1,$pageSize=10,$className=null, $estaTime1=null,
        $estaTime2=null,$headmaster=null,$startTime1=null,$startTime2=null,$managerName=null,
        $gradTime1=null,$gradTime2=null,$status=-1){
    
            $sql=" from class c,tb_user u1,tb_user u2 where c.headmaster=u1.uid and u2.uid=c.projectmanager ";
    
            if (null != $className){
                $sql .= " and c.className like '%$className%'";
            }
            if(null != $estaTime1){
                $sql .= " and c.estaTime >= '".$estaTime1."'";
            }
            if(null != $estaTime2){
                $sql .= " and c.estaTime <= '".$estaTime2."'";
            }
            if (null != $headmaster){
                $sql .= " and u1.trueName like '%$headmaster%'";
            }
            if(null != $startTime1){
                $sql .= " and c.startTime >= '".$startTime1."'";
            }
            if(null != $startTime2){
                $sql .= " and c.startTime <= '".$startTime2."'";
            }
    
            if (null != $managerName){
                $sql .= " and u2.trueName like '%$managerName%'";
            }
            if(null != $gradTime1){
                $sql .= " and c.gradTime >= '".$gradTime1."'";
            }
            if(null != $gradTime2){
                $sql .= " and c.gradTime <= '".$gradTime2."'";
            }
    
            //状态
            if($status > 0){
                $sql .= " and c.status = $status";
            }
    
    
    
    
            $count = $this->classModel->query("select count(*) as cc".$sql)[0]["cc"];
            $page["total"] = $count;
    
            $begin = ($pageNo-1)*$pageSize;
            $rows = $this->classModel->query("select c.classid,c.className,c.classType,c.status,
            c.estatime,c.starttime,c.gradtime,u1.truename headmaster,
            u2.trueName projectmanager,c.remarks,c.porson".$sql." limit $begin,$pageSize");
            $page["rows"] = $rows;
    
            $this->ajaxReturn($page);
    }
    /**
     * 检查所有班级今天是否有考试
     * @param unknown $cids 参数绑定样式为1,2,3
     */
    public function checkExamToday($cids=null){
        $d = date("Y-m-d");
        $db = $d." 00:00:00";
        $de = $d." 23:59:59";
        $data = $this->classModel->table("exam")->where("classid in($cids) and begintime between '$db' and '$de'")->select();
       // $sql= "select * from exam where cid in(cids)and begintime $db and $de";
       if (count($data)> 0){
           //获取到今天考试的班级id,用于提示那些班级有考试
           $classids = array();
           foreach($data as $exam){
              array_push($classids, $exam["classid"]);
           }
           $str = implode(",", $classids);
           $className=$this->classModel->field("className")->where("classid in($str)")->select();
           //存放今天又考试的班级名称数组
           $names = array();
           foreach ($className as $n){
               array_push($names,$n["className"]);
           }
           $this->ajaxReturn("对不起".implode(",",$names)."今天有考试，不能参与合并","EVAL");
       }else {
           $this->ajaxReturn("ok","EVAL");
       }
    }
    /**
     * 
     * @param unknown $cids
     * @param unknown $combinedClassid
     * @param unknown $combinedHeaderid
     * @param unknown $combinedManagerid
     */
    public function hebingClasses($cids=null,$combinedClassid=-1,$combinedHeaderid=-1,$combinedManagerid=-1){
       try {
           $this->classModel->setProperty(\PDO::ATTR_AUTOCOMMIT,false);
           $this->classModel->startTrans();//开启事务
           //查询合并后要保留的班级信息
//            $combinedClass = $this->classModel->table("class")->where("classid");
           $classes = $this->classModel->table("class")->where("classid in(3,4)")->select();
           $totalCount = 0;
           foreach($classes as $c){
               if ($c["classid"]==$combinedClassid){
                   //要保留的班级
//                    $c["headmaster"] = $combinedHeaderid;
//                    $c["projectmanager"] = $combinedManagerid;
               }else{
                   //不保留的班级
                   $totalCount += $c["porson"];
                   $c["porson"] = 0;//被合并之后人数清零
                   $c["status"]=2;//被合并
                   $this->classModel->save($c);
                   $sql = "update tb_user set classid=%d where classid=%d";
                   $this->classModel->execute($sql,$combinedClassid,$c["classid"]);
                  // array_push($str, $c["cid"]);
               }
           }
           //查询合并后要保留的班级信息
           $combinedClass = $this->classModel->table("class")->where("classid=%d",$combinedClassid)->find();
           $combinedClass ["headmaster"] = $combinedHeaderid;
           $combinedClass ["projectmanager"] = $combinedManagerid;
           $combinedClass ["porson"] += $totalCount;
           $this->classModel->save($combinedClass);
           
           
           $this->classModel->commit();//提交事务
       } catch (\Exception $e) {
           $this->classModel->rollback();//事务回滚到上一次提交的数据状态
       }
       $this->loadClassByPage();
    }
    
    
    
    
    
    public function loadAllclass(){
//       $data = $this->classModel->select();
//            $data = $this->classModel->where("cid>%d",1)->select();
//         print_r($data);
    }
   public function reg(){
       //保存一个标量变量
       $this->assign("ttt","中国你好！！");
       
       //保存一个索引数组
       $arr = array(11,22,33,44);
       $this->assign("arr",$arr);
       
       
       //保存一个关联数组
       $arr2 = array("aa"=>"我们","bb"=>"你们");
       $this->assign("arr2",$arr2);
       
       //保存一个二维数组
       $data = $this->classModel->select();
       $this->assign("data",$data);
       $this->assign("arrayLenth",count($data));
       
       //保存一个对象
       $menu = Menu::getInstance(111, '菜单管理', 'aaaa.html', 1, 1);
       $this->assign("menu",$menu);
       
       
       //演示模板中使用函数
       $this->assign("str","abcdefg");
       
       //演示模板中的运算
       $this->assign("i",2);
       $this->assign("j",3);
       $this->display(); //查找默认模板进行展示
     // $this->display("index");//查找另一个模板进行展示
    //$this->display("User/user");//跨目录模板进行展示
   }
}

?>