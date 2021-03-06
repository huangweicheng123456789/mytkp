<?php if (!defined('THINK_PATH')) exit(); ?>
<!DOCTYPE html>
<html>
    <head>
        <title>班级管理表</title>
        <meta charset="utf-8">
        <link type="text/css" rel="stylesheet" href="http://localhost:8080/myphp/Public/easyui/themes/bootstrap/easyui.css"/>
        <link type="text/css" rel="stylesheet" href="http://localhost:8080/myphp/Public/easyui/themes/icon.css"/>
        <script type="text/javascript" src="http://localhost:8080/myphp/Public/easyui/jquery.min.js"></script>
        <script type="text/javascript" src="http://localhost:8080/myphp/Public/easyui/jquery.easyui.min.js"></script>
        <script type="text/javascript" src="http://localhost:8080/myphp/Public/easyui/locale/easyui-lang-zh_CN.js"></script>
        <script type="text/javascript">
        	$(function(){
        		$('#win').window('close');  
        		$('#dg').datagrid({	
        			striped:true,
            		method:"GET",        
        			url:'http://localhost:8080/myphp/index.php/Home/Class/loadClassByPage?pageNo=1&pageSize=10',
        			pagination:true,
        			rownumbers:true,
        			frozenColumns:[[
        				{field:"AAAA",checkbox:true}
        		    ]],
        		 	columns:[[  
					   {field:'classid',hidden:true,}, 	  
					   {field:'classname',title:'班级名称',width:100,align:'center'},
					   {field:'classtype',title:'班级类型',width:100,align:'center',formatter:function(value){
							if(value == 1)return '常规班';
							else if(value == 2) return '快速班';
							else if(value == 3) return 'flash班';
							else return 'php班';
            	       }},
					   {field:'remarks',title:'备注',width:200,align:'center'},
        	           {field:'estatime',title:'创建时间',width:200,align:'center'},    
        	           {field:'starttime',title:'开班时间',width:200,align:'center'},
        	           {field:'gradtime',title:'毕业时间',width:200,align:'center'},
        	           {field:'status',title:'状态',width:50,align:'center',formatter:function(value){
							if(value == 1)return '正常';
							else if(value == 2) return '被合并';
							else if(value == 3) return '已结业';
							else return "已废除";
            	       }},
        	           {field:'headmaster',title:'班主任',width:50,align:'center'},
        	           {field:'projectmanager',title:'项目经理',width:60,align:'center'},
        	           {field:'porson',title:'班级人数',width:50,align:'center'},
        			]],
        			toolbar: '#tb'
        			        				
        		});
        		//设置翻阅功能
        		var pager = $("#dg").datagrid("getPager");
        		pager.pagination({
        			onSelectPage:function(pageNumber, pageSize){
        				refreshData(pageNumber,pageSize);
        			}
        		});
        	});
	
        	function saveorUpDateMenu(){
				var classid =$("#classid").val();
				var className =$("#className").val();
				var remarks =$("#remarks").val();
				var estaTime=$("#estaTime").val();
				var startTime =$("#startTime").val();
				var gradTime =$("#gradTime").val();
				var status =$("#status").val();
				var headmaster =$("#headmaster").val();
				var projectmanager =$("#projectmanager").val();
				var porson =$("#porsone").val();
				$.post("deal/addMenu.php",{
					"classid"	      : classid,
					"className"	      : className,
					"remarks"         : remarks,
					"estaTime"        : estaTime,
					"startTime"       : estaTime, 
					"gradTime"        : gradTime, 
					"status"          : status, 
					"headmaster"      : headmaster, 
					"projectmanager"  : projectmanager, 
					"porson"          : porson
				},function(data){
					if(data="insertok"){
						$message.alert('消息','菜单添加成功');
						refreshData(1,10);
						$('#win').window('close');
					}
				},"text");
        	}
        	//刷新表格数据
        	function refreshData(pageNumber, pageSize){
        		$("#dg").datagrid('loading');
				$.getJSON("http://localhost:8080/myphp/index.php/Home/Class/loadClassByPage?pageNo="+pageNumber+"&pageSize="+pageSize,{},function(result){
					$("#dg").datagrid('loadData',{
						rows: result.rows,
						total:result.total
					});
    			var pager = $("#dg").datagrid("getPager");
    				pager.pagination({
    					pageNumber:pageNumber,
    					pageSize:pageSize
    				});
    				$("#dg").datagrid('loaded');
				});	
        	}	
			//搜索班级
			function searchClass(){
				$.post("http://localhost:8080/myphp/index.php/Home/Class/loadClassByPage",{
					'pageNo'           : 1,
					'pageSize'         : 10,
					'className'	       : $("#search-className").val(),
					'estaTime1'        : $("#search-createtime1").combo("getValue"),
					'estaTime2'        : $("#search-createtime2").combo("getValue"),
					'startTime1'       : $("#search-benintime1").combo("getValue"),
					'startTime2'       : $("#search-benintime2").combo("getValue"),
					'gradTime1'        : $("#search-endtime1").combo("getValue"), 
					'gradTime2'        : $("#search-endtime2").combo("getValue"), 
					'status'           : $("#search-status").combo("getValue"),  
					'headmaster'       : $("#search-headerName").val(), 
					'projectmanager'   : $("#search-managerName").val()
				},function(result){
					$("#dg").datagrid('loadData',{
						rows:result.rows,
						total:result.total
					});
				},"json");
			}
			
			//班级合并
			/*
			至少选两个班级进行合并
			所选班级其中状态必须全是正常的
			所选班级不能有考试
			*/
			function combineClass(){
				//打开合并的窗口表单界面
				 
				var selectedRows = $("#dg").datagrid("getSelections");
				if(selectedRows.length < 2){
					alert("对不起！你至少选中两个班级才可以合并！");
					return;
				}
				var b = true;
				for(var i=0;i<selectedRows.length;i++){
					if(selectedRows[i].status != 1){
						b = false;
						break;
					}
				}
				if(!b){
					alert("对不起,你所选的班级状态必须全是正常的！！");
					return;
				}
				//获取已选中的班级的id
				var cids = new Array();
				var options = new Array();
				options.push({"name":"请指定你要选择的班级名称","classid":"-1"});
				for(var i=0;i<selectedRows.length;i++){
					cids.push(selectedRows[i].classid);
					options.push({"name":selectedRows[i].classname,"classid":selectedRows[i].classid});
				}
				$.post("http://localhost:8080/myphp/index.php/Home/Class/checkExamToday",{"cids":cids.join(",")},function(data){
					if(data == "ok"){
						//根据已选中的数据动态填入合并后班级名选项
						$("#combinedClassid").combobox({
							valueField:'classid',
							textField :'name',
							data      :options,
							value     :'-1'
						});
						//ajax载入班主任选项
						$("#combinedHeaderid").combobox({
							url        : "http://localhost:8080/myphp/index.php/Home/User/loadAllHeader",
							valueField : 'uid',
							textField  : 'truename',
							value     :'-1'
						});
						//ajax载入班项目经理选项
						$("#combinedManagerid").combobox({
							url        : "http://localhost:8080/myphp/index.php/Home/User/loadAllMenger",
							valueField : 'uid',
							textField  : 'truename',
							value     :'-1'
						});
						$('#win').window('open');
					}else{
						alert(data);
					}
				},"text");
				
			}
			
			
			function hebingClasses(){
				//获取已选中的班级id
				var selectedRows = $("#dg").datagrid("getSelections");
				var cids = new Array();
				for(var i=0;i<selectedRows.length;i++){
					cids.push(selectedRows[i].classid);
				}
				$.post("http://localhost:8080/myphp/index.php/Home/Class/hebingClasses",{
					"cids"              :cids.join(","),
					"combinedClassid"   :$("#combinedClassid").combo("getValue"),
					"combinedHeaderid"  :$("#combinedHeaderid").combo("getValue"),
					"combinedManagerid" :$("#combinedManagerid").combo("getValue")
					
				},function(result){
					$("#win").window('close');
					alert("班级合并成功");
					$("#dg").datagrid('loadData',{
						rows:result.rows,
						total:result.total
					});
						
				},"json");
			}
        </script>
    </head>
    <body>
	    <table id="dg"></table>
	    <div id="tb">
	    	<form action="" id="seachForm">
	    		<label>班级名称</label>
				<input type="text" class="easyui-validatebox in" placeholder="班级名称查询" id="search-className"/>
				<label>班主任名称</label>
				<input type="text" class="easyui-validatebox in" placeholder="班主任名称查询" id="search-headerName"/>
				<label>项目经理名称</label>
				<input type="text" class="easyui-validatebox in" placeholder="项目经理名称查询" id="search-managerName"/>
				<label>状态</label>
				<select class="easyui-combobox" id="search-status">
					<option value="-1">状态搜索</option>
					<option value="1">正常</option>
					<option value="2">被合并</option>
					<option value="3">已结业</option>
					<option value="4">已废除</option>
				</select>
				<label>创建时间</label>
				<input type="text" class="easyui-datebox in" id="search-createtime1" date-options="ed"/>
				<label>至</label>
				<input type="text" class="easyui-datebox in" id="search-createtime2"/>
				<label>开班时间</label>
				<input type="text" class="easyui-datebox in" id="search-benintime1"/>
				<label>至</label>
				<input type="text" class="easyui-datebox in" id="search-benintime2"/>
				<label>结业时间</label>
				<input type="text" class="easyui-datebox in" id="search-endtime1"/>
				<label>至</label>
				<input type="text" class="easyui-datebox in" id="search-endtime2"/>
				<a href="javaScript:searchClass();" class="easyui-linkbutton" data-options="iconCls:'icon-search',plain:true">搜索</a>
				<a href="javaScript:combineClass();" class="easyui-linkbutton" data-options="iconCls:'icon-collect'">合并</a>
	    	</form>
	    </div>
	    
		<div id="win" class="easyui-window" title="班级合并" style="width:600px;height:400px"   
			data-options="iconCls:'icon-adduser',modal:true,collapsible:false,maximizable:false">   
			 <form id="ff" method="post"> 
			 	<table id="formtable" style="width:100%;margin:auto;margin-top:20px">
			 		<tr>
			 			<td align="right"><label for="combinedClassid">合并后班级名称:</label></td>
			 			<td><select id="combinedClassid" style="width:150px;" class="easyui-combobox" ></select></td>
			 		</tr>
			 		<tr>
			 			<td align="right"><label for="combinedHeaderid">合并后班主任名称:</label></td>
			 			<td><select id="combinedHeaderid" style="width:150px;" class="easyui-combobox" ></select></td>
			 		</tr>
			 		<tr>
			 			<td align="right"><label for="combinedManagerid">合并后项目经理名称:</label></td>
			 			<td><select id="combinedManagerid" style="width:150px;" class="easyui-combobox" ></select></td>
			 		</tr>
			 		<tr>
			 			<td align="right" colspan="2">
			 				<a id="btn" href="javascript:hebingClasses();" class="easyui-linkbutton" data-options="iconCls:'icon-submit'">确认提交</a>  
			 			</td>
		 			</tr>
	 			</table>
	       </form> 
	  </div>  
	    
	    
	    
	    
	    
	     
    </body>
</html>