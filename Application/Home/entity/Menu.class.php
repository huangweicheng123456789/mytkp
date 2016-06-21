<?php
namespace Home\entity;
class Menu{
    public   $menuid ;
    //展示菜单名称
    public  $name ;
     //url 表示树形菜单被点击后要发送的超链接地址，如果此菜单不是最低级则此列的数值为null。
    public  $url ;
    //parentid 表示此菜单的主键id，如果此类菜单已经是最顶级菜单，则此列的值为-1.
    public  $parentid ;
    //isshow表示是否在首页左边的树形菜单中展示 1表示要展示
    public  $isshow ;
    //如果此菜单是二级菜单，则它是所有子菜单放在$children数组中
    //如果此菜单是一个最低级菜单，则$children为null。
    public $children;
    
    /**
     * 从类的外部获取当前类的对象，并设置属性的值，因为不能覆盖无参数构造方法
     * @param unknown $menuid
     * @param unknown $name
     * @param unknown $url
     * @param unknown $parentid
     * @param unknown $isshow
     * @return \Home\entity\Menu
     */
    public static function getInstance($menuid,$name,$url,$parentid,$isshow){
        $m = new Menu();
        $m->menuid = $menuid;
        $m->name = $name;
        $m->url = $url;
        $m->parentid = $parentid;
        $m->isshow = $isshow;
        return $m;
    }
    
    /**
     * @return $children
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setChildren(array $children)
    {
        $this->children = $children;
    }

    /**
     * @return $menuid
     */
    public function getMenuid()
    {
        return $this->menuid;
    }

    /**
     * @return $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return $parentid
     */
    public function getParentid()
    {
        return $this->parentid;
    }

    /**
     * @return $isshow
     */
    public function getIsshow()
    {
        return $this->isshow;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setMenuid($menuid)
    {
        $this->menuid = $menuid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setParentid($parentid)
    {
        $this->parentid = $parentid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setIsshow($isshow)
    {
        $this->isshow = $isshow;
    }

    
    
    
    
}

?>