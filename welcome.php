<?php 
session_start();
// require_once 'Autoload.php';
// use model\MenuModel;
// $menuModel = new MenuModel();
// $uid = $_SESSION["loginUser"][0];
// $secondMenu = $menuModel->loadTreeMenu($uid);
?>
<!DOCTYPE html>
<html>
	<head>
		<title>欢迎界面</title>
		<meta charset="utf-8">
		<link type="text/css" rel="stylesheet" href="http://localhost:8080/mytkp/Public/easyui/themes/bootstrap/easyui.css"/>
		<link type="text/css" rel="stylesheet" href="http://localhost:8080/mytkp/Public/easyui/themes/icon.css"/>
		<script type="text/javascript" src="http://localhost:8080/mytkp/Public/easyui/jquery.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/mytkp/Public/easyui/jquery.easyui.min.js"></script>
		<script type="text/javascript" src="http://localhost:8080/mytkp/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
		<script type="text/javascript">
		function addTabs(url,name){
			if($("#tabs").tabs("exists",name)){
				//如果当前选项卡也存在，则直接选中它
				$("#tabs").tabs("select",name);
			}else{
				//添加有未选中状态的选项卡面板
				$("#tabs").tabs("add",{
					title:name,
					selected:true,
					closable:true,
					content:"<iframe name='"+name+"' src='"+url+"' width='100%' height='100%' frameborder='0' scrolling='auto'></iframe>"
				});		
			}
		}
			
		</script>
	</head>
	<body class="easyui-layout">   
        <div data-options="region:'north',split:true" style="height:100px;">
        	<div><img id="aiqiyi-loge" src="../sys/img/logo108x35_black.png"/></div>
        	 <p style="margin-left:1200px;margin-top: -20px;color: red">
            	<?php 
            	if (isset($_SESSION["loginUser"])){
            	    echo "欢迎登陆:".$_SESSION["loginUser"][4];
            	}
            	
            	?>
        	</p> 
        </div>  
       
        
        <div data-options="region:'west',title:'菜单栏',split:true" style="width:200px;">
        	<ul id="tree" class="easyui-tree"> 
        		<?php 
                if (array_key_exists("secondMenu", $_SESSION)){
        		    $secondMenu =$_SESSION["secondMenu"];
            		foreach ($secondMenu as $menu2){
            		    echo "<li>";
    		            echo "<span>{$menu2[1]}</span>";
    		            echo "<ul>";
    		            foreach ($menu2[5] as $menu3){
    		                echo "<li><span><a href=\"javascript:addTabs('{$menu3[2]}','{$menu3[1]}');\">{$menu3[1]}</a></span></li>";
    		            }
    		            echo "</ul>";
    		            echo "</li>";
            		}
        		}
        		?>  
            </ul>
        </div>   
        <div data-options="region:'center'" style="padding:5px;background:#eee;">
        	<div id="tabs" class="easyui-tabs" data-options="fit:true" >   
                <div title="欢迎">   
                    	欢迎你   
                </div>   
            </div>   
        </div> 
	</body>  

 
</html>