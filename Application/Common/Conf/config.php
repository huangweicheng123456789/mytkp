<?php
return array(
	//'配置项'=>'配置值'
	
    //关于数据库访问的配置
//     "DSN"=>"mysql:host=localhost;dbname=u20",
//     "DBUSER"=>"root",
//     "DBPASS"=>"123456",
//     "DBPORT"=>3306,
//     "PDOOPTIONS"=>array(
//         \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
//     ),
   //调用方法 $this->pdo = new \PDO(C("DSN"), C("DBUSER"), C("DBPASS"), C("DBPORT"),C("PDOOPTIONS"));
    
    //修改参数来配置简化模板的目录层次
    //'TMPL_FILE_DEPR'=>'_',
    
    //分页查询相关配置
    "PAGENO"=>1,
    "PAGESIZE"=>10,
    
    //
    //"URL_MODEL"=>2,
    
    
    //设置2级目录的控制器层
    //"CONTROLLER_LEVEL"=>2,
    
    //Action参数绑定设置
    // "URL_PARAMS_BIND" => true,
    
    
    //按照顺序参数绑定
    //"URL_PARAMS_BIND_TYPE" => 1,
    //开启路由
    
    
    //
    "THINKPHP_DSN"=>"mysql://root123456@localhost:3306/u20#utf8",
    
    /* 数据库设置 */
    'DB_TYPE'               =>  'mysql',     // 数据库类型
    'DB_HOST'               =>  'localhost', // 服务器地址
    'DB_NAME'               =>  'U20',          // 数据库名
    'DB_USER'               =>  'root',      // 用户名
    'DB_PWD'                =>  '123456',          // 密码
    'DB_PORT'               =>  '3306',        // 端口
   // 'DB_PREFIX'             =>  '',    // 数据库表前缀
    'DB_PARAMS'          	=>  array(
        \PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION
    ), // 数据库连接参数    
//     'DB_DEBUG'  			=>  TRUE, // 数据库调试模式 开启后可以记录SQL日志
//     'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
     'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8
//     'DB_DEPLOY_TYPE'        =>  0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
//     'DB_RW_SEPARATE'        =>  false,       // 数据库读写是否分离 主从式有效
//     'DB_MASTER_NUM'         =>  1, // 读写分离后 主服务器数量
//     'DB_SLAVE_NO'           =>  '', // 指定从服务器序号
    
    
    
     'URL_ROUTER_ON'=>true,
     "URL_ROUTER_RULTS"=>array(
//         'ttt'                       =>   "Home/Index/index", //静态规则路由
        'tttt/:Name/:Pass'  =>    "Home/Index/text",//静态和动态规则路由结合
//         "login"                     =>    "Home/User/login",
    ),
    'URLL_MAP_RULES'=>array(
        
    )
);

?>