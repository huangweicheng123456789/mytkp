<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<title></title>
		<meta charset='UTF-8'>
	</head>
	<body>
		<p>reg模板</p>
		<?php echo ($ttt); ?><br/>
		<?php echo ($arr["0"]); ?>-----<?php echo ($arr[1]); ?><br/>
		<?php echo ($arr2["aa"]); ?>-----<?php echo ($arr2[bb]); ?><br/>
		<?php echo ($data["0"]["classid"]); ?>----<?php echo ($data[0][classname]); ?><br/>
		<?php echo ($menu->menuid); ?>----<?php echo ($menu->name); ?><br/>
		<?php echo ($_SERVER['HTTP_USER_AGENT']); ?><br/>
		<?php echo (md5($str)); ?><br/>
		<?php echo (substr($str,0,3)); ?>------<?php echo (substr($str,0,3)); ?><br/>
		<?php echo substr($str,0,4);?><br/>
		<?php echo ((isset($str) && ($str !== ""))?($str):"中国你好！！！！"); ?><br/>
		<?php echo ($i+$j); ?>-----<?php echo ($i-$j); ?>-----<?php echo ($i*$j); ?>-----<?php echo ($i/$j); ?>-----<?php echo ($i%$j); ?>-----<?php echo ($i++); ?>----<?php echo ++$j;?><br/>
		<?php echo ($i==4?"对":"错"); ?><br/>
		
		
		<table border="1" bordercolor="red" width="100%" hight="500px" cellspacing="0">
			<tr>
				<td>编号</td>
				<td>姓名</td>
				<td>类型</td>
				<td>备注</td>
				<td>创建时间</td>
				<td>开班时间</td>
				<td>毕业时间</td>
				<td>状态</td>
				<td>班主任</td>
				<td>项目经理</td>
				<td>人数</td>
			</tr>
			<!--  
			<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "$msg" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i; if(($mod) == "0"): ?><tr style="background-color:red;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["classname"]); ?></td>
						<td>
							<?php if($class["classtype"] == 1): ?>常规班
							<?php elseif($class["classtype"] == 2): ?>快速班
							<?php elseif($class["classtype"] == 3): ?>flish班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["remarks"]); ?></td>
						<td><?php echo ($class["estatime"]); ?></td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["gradtime"]); ?></td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["headmaster"]); ?></td>
						<td><?php echo ($class["projectmanager"]); ?></td>
						<td><?php echo ($class["porson"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($mod) == "1"): ?><tr style="background-color:blue;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["classname"]); ?></td>
						<td>
							<?php if($class["classtype"] == 1): ?>常规班
							<?php elseif($class["classtype"] == 2): ?>快速班
							<?php elseif($class["classtype"] == 3): ?>flish班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["remarks"]); ?></td>
						<td><?php echo ($class["estatime"]); ?></td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["gradtime"]); ?></td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["headmaster"]); ?></td>
						<td><?php echo ($class["projectmanager"]); ?></td>
						<td><?php echo ($class["porson"]); ?></td>
					</tr><?php endif; endforeach; endif; else: echo "$msg" ;endif; ?>
			-->
			<?php if(is_array($data)): foreach($data as $i=>$class): if(($i%2) == "0"): ?><tr style="background-color:green;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["classname"]); ?></td>
						<td>
							<?php if($class["classtype"] == 1): ?>常规班
							<?php elseif($class["classtype"] == 2): ?>快速班
							<?php elseif($class["classtype"] == 3): ?>flish班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["remarks"]); ?></td>
						<td><?php echo ($class["estatime"]); ?></td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["gradtime"]); ?></td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["headmaster"]); ?></td>
						<td><?php echo ($class["projectmanager"]); ?></td>
						<td><?php echo ($class["porson"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($i%2) == "1"): ?><tr style="background-color:orange;">
						<td><?php echo ($class["classid"]); ?></td>
						<td><?php echo ($class["classname"]); ?></td>
						<td>
							<?php if($class["classtype"] == 1): ?>常规班
							<?php elseif($class["classtype"] == 2): ?>快速班
							<?php elseif($class["classtype"] == 3): ?>flish班
							<?php else: ?>php班<?php endif; ?>
						</td>
						<td><?php echo ($class["remarks"]); ?></td>
						<td><?php echo ($class["estatime"]); ?></td>
						<td><?php echo ($class["starttime"]); ?></td>
						<td><?php echo ($class["gradtime"]); ?></td>
						<td><?php echo ($class["status"]); ?></td>
						<td><?php echo ($class["headmaster"]); ?></td>
						<td><?php echo ($class["projectmanager"]); ?></td>
						<td><?php echo ($class["porson"]); ?></td>
					</tr><?php endif; endforeach; endif; ?> 
			
			<!--<?php $__FOR_START_26401__=$arrayLenth-1;$__FOR_END_26401__=0;for($i=$__FOR_START_26401__;$i <= $__FOR_END_26401__;$i+=1){ ?><for start="0" end="$arrayLenth" comparison="lt" name="i">
				<?php if(($i%2) == "0"): ?><tr style="background-color:blue;">
						<td><?php echo ($data["$i"]["classid"]); ?></td>
						<td><?php echo ($data["$i"]["classname"]); ?></td>
						<td><?php echo ($data["$i"]["classtype"]); ?></td>
						<td><?php echo ($data["$i"]["remarks"]); ?></td>
						<td><?php echo ($data["$i"]["estatime"]); ?></td>
						<td><?php echo ($data["$i"]["starttime"]); ?></td>
						<td><?php echo ($data["$i"]["gradtime"]); ?></td>
						<td><?php echo ($data["$i"]["status"]); ?></td>
						<td><?php echo ($data["$i"]["headmaster"]); ?></td>
						<td><?php echo ($data["$i"]["projectmanager"]); ?></td>
						<td><?php echo ($data["$i"]["porson"]); ?></td>
					</tr><?php endif; ?>
				<?php if(($i%2) == "1"): ?><tr style="background-color:yellow;">
						<td><?php echo ($data["$i"]["classid"]); ?></td>
						<td><?php echo ($data["$i"]["classname"]); ?></td>
						<td><?php echo ($data["$i"]["classtype"]); ?></td>
						<td><?php echo ($data["$i"]["remarks"]); ?></td>
						<td><?php echo ($data["$i"]["estatime"]); ?></td>
						<td><?php echo ($data["$i"]["starttime"]); ?></td>
						<td><?php echo ($data["$i"]["gradtime"]); ?></td>
						<td><?php echo ($data["$i"]["status"]); ?></td>
						<td><?php echo ($data["$i"]["headmaster"]); ?></td>
						<td><?php echo ($data["$i"]["projectmanager"]); ?></td>
						<td><?php echo ($data["$i"]["porson"]); ?></td>
					</tr><?php endif; } ?>-->
		</table>
		<?php switch($j): case "1": break;?>
			<?php case "2": break;?>
			<?php case "3": break;?>
			<?php case "4": break;?>
			<?php case "5": break;?>
			<?php case "6": break;?>
			<?php case "7": break;?>
			<defult>其他</defult><?php endswitch;?>
		<br/>
		<?php if($j == 3): ?>哈哈哈哈哈哈哈<?php endif; ?>
		
		
		<?php if($j == 3): ?>恭喜你 ，答对了！！！
		<?php else: ?>
			很遗憾你答错了！！<?php endif; ?>
		
		
		<?php if($j == 3): ?>恭喜你 ，答对了！！！
		<?php elseif($j == 3): ?>
			很遗憾你答错了！！<?php endif; ?>
	</body>
</html>