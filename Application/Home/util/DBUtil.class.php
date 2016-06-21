<?php
namespace Home\util;
use Home\util\XMLParse;
/**
 * 封装增删改擦四种操作为两个通用方法
 * @author j
 *
 */
class DBUtil{
    
    private $pdoMysql;
    
    private $pdo;
    
    public function __construct(){
//         $this->pdoMysql = XMLParse::parseDBXML();
//         $this->pdo = new \PDO($this->pdoMysql[0], $this->pdoMysql[1], $this->pdoMysql[2], array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));

       // $this->pdo = new \PDO(C("DSN"), C("DBUSER"), C("DBPASS"),C("PDOOPTIONS"));
        $this->pdo = new \PDO(C("DB_TYPE").":host=". C("DB_HOST").";dbname=".C("DB_NAME"), C("DB_USER"), C("DB_PWD"),C("DB_PARAMS"));
    }
    
    
    /**
     * 通用的DML语句执行方法
     * @param unknown $sql  将要执行的DML语句，可以带有问号占位符
     * @param array $params  可选参数，当$sql中有问号时，此参数必填，问号个数必须与此数组内元素个数相同且注意顺序，若$sql中无问号则此参数可不填或者可填一个null 或 array()
     * @return true表示执行成功  false表示执行失败
     */
    public function executeDML($sql,array $params=null){
        try{
//             $pdoMysql = XMLParse::parseDBXML();
//             $pdo = new \PDO($this->{$pdoMysql[0]}, $this->{$pdoMysql[1]}, $this->{$pdoMysql[2]}, array(\PDO::ATTR_ERRMODE=>\PDO::ERRMODE_EXCEPTION));
            $ps = $this->pdo->prepare($sql);
            
            //参数数组不为空  并且元素个数大于0  需要绑定参数
            if($params != null && count($params) > 0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
            return true;
        }catch(\PDOException $e){
            return false;
        }
        
    }
    
    /**
     * 通用的执行查询语句的方法
     * @param unknown $sql 将要执行的查询语句字符串，可以带有问号
     * @param array $params 可选参数 当$sql中带有问号时此参数必填，问号个数必须此数组内元素个数相同且注意顺序，当$sql中无问号时则此参数可不填或者可填一个null 或 array()
     * @param unknown $fetchStyle 可选参数  提取数据的方式 默认为\PDO::FETCH_NUM   可选有FETCH_OBJ
     * @param unknown $className 可选参数，当$fetchStyle的值为\PDO::FETCH_OBJ时此参数要求填入实体类的全名（命名空间、类名称）  当$fetchStyle的值不为\PDO::FETCH_OBJ时此参数可不填
     * @return array  当查询有数据时返回
     */
    
    public function executeQuery($sql,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        try{
            $ps = $this->pdo->prepare($sql);
        
            //参数数组不为空  并且元素个数大于0  需要绑定参数
            if($params != null && count($params) > 0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
            if ($fetchStyle == \PDO::FETCH_OBJ){
                   $objs = array();
                   while ($obj = $ps->fetchObject($className)){
                       array_push($objs, $obj);
                   }
                   return $objs;
            }else{
                return $ps->fetchAll($fetchStyle);
            }
        }catch(\PDOException $e){
            return array();
        }
    }
    
    
    /**
     * 
     * @param unknown $sql
     * @param unknown $pageNo
     * @param unknown $pageSize
     * @param array $params
     * @param unknown $fetchStyle
     * @param unknown $className
     * @return array 关联数组  有两个索引  索引total
     */
    public function executePageQuery($sql,$pageNo,$pageSize,array $params=null,$fetchStyle=\PDO::FETCH_NUM,$className=null){
        
        $page = array("total"=>0,"rows"=>array());
        
        try{
            //查询总共有多少行数据
            $index1= strpos($sql,"from");
            $index2= strpos($sql,"limit");
            $sql2 = "select count(*) ".substr($sql,$index1, $index2- $index1);
            $ps = $this->pdo->prepare($sql2);
            if($params != null && count($params) > 0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
            $page["total"] = $ps->fetch(\PDO::FETCH_NUM)[0];
            
            
            
            //查询当前页的数据
            $ps = $this->pdo->prepare($sql);
            //手动绑定limit后面的两个参数
            $begin = ($pageNo-1)*$pageSize;
            //统计原sql中包含多少 问号 最少两个包含两个问号(limit后面的)
            $countWenhao = 0;
            str_replace("?", "?", $sql, $countWenhao);
            $ps->bindParam($countWenhao-1,$begin,\PDO::FETCH_NUM);
            $ps->bindParam($countWenhao,$pageSize,\PDO::FETCH_NUM);
        
            //参数数组不为空  并且元素个数大于0  需要绑定参数
            if($params != null && count($params) > 0){
                $ps->execute($params);
            }else{
                $ps->execute();
            }
            if ($fetchStyle == \PDO::FETCH_OBJ){
                $objs = array();
                while ($obj = $ps->fetchObject($className)){
                    array_push($objs, $obj);
                }
                $page['rows'] = $objs;
            }else{
                $page['rows'] = $ps->fetchAll($fetchStyle);
            }
        }catch(\PDOException $e){
            
        }
        return $page;
    }
    
    /**
     * 释放内存
     * 
     */
    private function free($pdo,$ps){
        if (null !=$pdo){
            $pdo = null;
            
        }
        if (null !=$ps){
            $ps = null;
        }
    }
    
    
    
    
    
    
}

?>