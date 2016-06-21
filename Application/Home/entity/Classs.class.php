<?php
namespace entity;
class Classs{
    public $classid;
    public $url;
    public $className;
    public $classType;
    public $remarks;
    public $estaTime;
    public $startTime;
    public $gradTime;
    public $status;
    public $headmaster;
    public $projectmanager;
    public $porson;
    /**
     * @return $classid
     */
    public function getClassid(){
        return $this->classid;
    }

    /**
     * @return $url
     */
    public function getUrl(){
        return $this->url;
    }

    /**
     * @return $className
     */
    public function getClassName(){
        return $this->className;
    }

    /**
     * @return $classType
     */
    public function getClassType(){
        return $this->classType;
    }

    /**
     * @return $remarks
     */
    public function getRemarks(){
        return $this->remarks;
    }

    /**
     * @return $estaTime
     */
    public function getEstaTime(){
        return $this->estaTime;
    }

    /**
     * @return $startTime
     */
    public function getStartTime(){
        return $this->startTime;
    }

    /**
     * @return $gradTime
     */
    public function getGradTime(){
        return $this->gradTime;
    }

    /**
     * @return $status
     */
    public function getStatus(){
        return $this->status;
    }

    /**
     * @return $headmaster
     */
    public function getHeadmaster()
    {
        return $this->headmaster;
    }

    /**
     * @return $projectmanager
     */
    public function getProjectmanager(){
        return $this->projectmanager;
    }

    /**
     * @return $porson
     */
    public function getPorson(){
        return $this->porson;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setClassid($classid){
        $this->classid = $classid;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setUrl($url){
        $this->url = $url;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setClassName($className){
        $this->className = $className;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setClassType($classType){
        $this->classType = $classType;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setRemarks($remarks){
        $this->remarks = $remarks;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setEstaTime($estaTime){
        $this->estaTime = $estaTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStartTime($startTime){
        $this->startTime = $startTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setGradTime($gradTime){
        $this->gradTime = $gradTime;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setStatus($status){
        $this->status = $status;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setHeadmaster($headmaster){
        $this->headmaster = $headmaster;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setProjectmanager($projectmanager){
        $this->projectmanager = $projectmanager;
    }

    /**
     * @param !CodeTemplates.settercomment.paramtagcontent!
     */
    public function setPorson($porson){
        $this->porson = $porson;
    }

    
    
    
    
}

?>