<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:69:"E:\wamp64\www\blog\public/../application/admin\view\category\add.html";i:1550228971;s:59:"E:\wamp64\www\blog\application\admin\view\Public\_meta.html";i:1550228971;s:61:"E:\wamp64\www\blog\application\admin\view\Public\_footer.html";i:1550228971;}*/ ?>
﻿<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<link rel="Bookmark" href="/favicon.ico" >
<link rel="Shortcut Icon" href="/favicon.ico" />
<!--[if lt IE 9]>
<script type="text/javascript" src="/Admin/lib/html5shiv.js"></script>
<script type="text/javascript" src="/Admin/lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="/Admin/lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="/Admin/static/h-ui.admin/css/style.css" />

<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css">
<!--[if IE 6]>
<script type="text/javascript" src="/Admin/lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->

<title>Ligo--后台</title>
<meta name="keywords" content="H-ui.admin v3.1,H-ui网站后台模版,后台模版下载,后台管理系统模版,HTML后台模版下载">
<meta name="description" content="H-ui.admin v3.1，是一款由国人开发的轻量级扁平化网站后台模板，完全免费开源的网站后台管理系统模版，适合中小型CMS后台系统。">
</head>
<body>
<article class="page-container">
	<form action="<?php echo url('add'); ?>" method="post" class="form form-horizontal" id="form-article-add">
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>分类名称：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="cate_name" name="cate_name">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">分类别名：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="" placeholder="" id="cate_alias" name="cate_alias">
			</div>
		</div>
		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2"><span class="c-red">*</span>上级分类：</label>
			<div class="formControls col-xs-8 col-sm-9"> <span class="select-box">
				<select id="parent_cate_id" name="parent_cate_id" class="select">
					<option value="0">顶级分类</option>
					<?php if(is_array($cateData) || $cateData instanceof \think\Collection || $cateData instanceof \think\Paginator): $i = 0; $__LIST__ = $cateData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$val): $mod = ($i % 2 );++$i;?>
					  <option value="<?php echo $val['cate_id']; ?>"><?php echo str_repeat('-',4*$val['level']) ?> <?php echo $val['cate_name']; ?></option>
					<?php endforeach; endif; else: echo "" ;endif; ?>
				</select>
				</span> </div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">排序值：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<input type="text" class="input-text" value="100" placeholder="" id="order_id" name="order_id">
			</div>
		</div>

		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">分类描述：</label>
			<div class="formControls col-xs-8 col-sm-9">
				<textarea name="cate_description" id="cate_description" cols="" rows="" class="textarea"  placeholder="说点什么...最少输入10个字符" datatype="*10-100" dragonfly="true" nullmsg="备注不能为空！" onKeyUp="$.Huitextarealength(this,200)"></textarea>
				<p class="textarea-numberbar"><em class="textarea-length">0</em>/200</p>
			</div>
		</div>


		<div class="row cl">
			<label class="form-label col-xs-4 col-sm-2">是否显示：</label>
			<div class="formControls col-xs-8 col-sm-9 skin-minimal">
				<div class="check-box">
					<input type="checkbox" id="is_index" name="is_index" value="1">
					<label for="checkbox-pinglun">&nbsp;</label>
				</div>
			</div>
		</div>

		<div class="row cl">
			<div class="col-xs-8 col-sm-9 col-xs-offset-4 col-sm-offset-2">
			 <button onClick="cate_save_submit();" class="btn btn-primary radius" type="submit"><i class="Hui-iconfont">&#xe632;</i> 提交</button>
		     <a href="<?php echo url('index'); ?>" class="btn btn-default radius" type="button">&nbsp;&nbsp;取消&nbsp;&nbsp;</a>
		    </div>
	    </div>
	</form>
</article>

<!--_footer 作为公共模版分离出去-->
<script type="text/javascript" src="/Admin/lib/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript" src="/Admin/lib/layer/2.4/layer.js"></script>
<script type="text/javascript" src="/Admin/static/h-ui/js/H-ui.min.js"></script>
<script type="text/javascript" src="/Admin/static/h-ui.admin/js/H-ui.admin.js"></script>

<script type="text/javascript" src="/bootstrap/js/bootstrap.min.js"></script>
<!--/_footer /作为公共模版分离出去-->

<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript">
	function cate_save_submit(){
	    var cateName = $('#cate_name').val(),
			cateAlias = $('#cate_alias').val(),
			parentCateId = $('#parent_cate_id').val(),
			orderId = $('#order_id').val(),
			cateDescription = $('#cate_description').val(),
			isIndex = 0;
        $.each($('input:checkbox'),function(){
            if(this.checked){
               isIndex = 1;
            }
        });
        $.ajax({
            type : "POST",
            url : "<?php echo url('add'); ?>",
            dataType : "json",
		})
		console.log(isIndex);
	}

	$(function(){
		$('.skin-minimal input').iCheck({
			checkboxClass: 'icheckbox-blue',
			radioClass: 'iradio-blue',
			increaseArea: '20%'
		});
	});

</script>
<!--/请在上方写此页面业务相关的脚本-->
</body>
</html>