<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="使用 thinkPHP 和 bootstrap 管理系统">
<meta name="author" content="">
<title><?php echo ($meta_title); ?>|<?php echo C('WEB_SITE_TITLE');?></title>
<link rel="shortcut icon" href="/wwwroot/Public/favicon.ico">

<!-- Bootstrap core CSS -->
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/sb/bootstrap.min.css" />
<!-- Font Awesome CSS -->
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/font-awesome/css/font-awesome.min.css" />

<!-- 表格 css-->
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/sb/dataTables.bootstrap.css" />
<!-- 弹出提示框，ajax用 css -->
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/sb/messenger.css" />
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/sb/messenger-theme-style.css" />

<!-- SB Admin CSS - Include with every page -->
<link rel="stylesheet" type="text/css" href="/wwwroot/Public/Admin/css/sb/sb-admin.css" />   

<!-- Custom styles for this template -->
<!-- 用于加载 css 代码 --> 
<!-- 页面header钩子，一般用于加载插件CSS文件和代码 -->
<?php echo hook('pageHeader');?>
</head>
<body>
<div id="wrapper">
  <!-- 导航条 ================================================== --> 
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="<?php echo U('Index/index');?>">&nbsp;&nbsp;ThinkPHP 3.2.1</a>
    </div><!-- /.navbar-header -->

    <ul class="nav navbar-nav navbar-top-links">
        <li class="disabled"><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li class="disabled"><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
    <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>	
    </ul>

    <ul class="nav navbar-top-links navbar-right">
        <!-- 用户栏 -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i><?php echo get_username();?>  <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="<?php echo U('User/updateNickname');?>"><i class="fa fa-user fa-fw"></i> 修改昵称</a>
                </li>
                <li><a href="<?php echo U('User/updatePassword');?>"><i class="fa fa-gear fa-fw"></i> 修改密码</a>
                </li>
                <li class="divider"></li>
                <li><a href="<?php echo U('Public/logout');?>"><i class="fa fa-sign-out fa-fw"></i> 退出</a>
                </li>
            </ul><!-- /.dropdown-user -->
        </li><!-- /.dropdown -->
    </ul><!-- /.navbar-top-links -->
</nav><!-- /.navbar-static-top -->
<!--  /导航条结束点   ================================================== -->  
  	
<nav class="navbar-default navbar-static-side" role="navigation">
<div class="sidebar-collapse">
  <ul class="nav" id="side-menu">
    
    <li id="subnav" class="active" > 
    <a href="#"><h3><i class="fa fa-home"></i>个人中心</h3><span class="fa arrow"></span></a> 
 	<ul class="nav nav-second-level <?php if(!in_array((ACTION_NAME), explode(',',"mydocument,draftbox,examine"))): ?>subnav-off<?php endif; ?>">
 		<li <?php if((ACTION_NAME) == "mydocument"): ?>class="mydocument"<?php endif; ?>>
            <a class="item" href="<?php echo U('article/mydocument');?>"><i class="fa fa-files-o fa-fw"></i>我的文档</a>
        </li>
 		<?php if(($show_draftbox) == "1"): ?><li <?php if((ACTION_NAME) == "draftbox"): ?>class="draftbox"<?php endif; ?>>
            <a class="item" href="<?php echo U('article/draftbox');?>"><i class="fa fa-picture-o"></i>草稿箱</a>
        </li><?php endif; ?>
		<li <?php if((ACTION_NAME) == "examine"): ?>class="examine"<?php endif; ?>>
            <a class="item" href="<?php echo U('article/examine');?>"><i class="fa fa-chain-broken"></i>待审核</a>
        </li>
 	</ul>
    <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
        <?php if(!empty($sub_menu)): ?><a href="#"><h3>
            	<i class="icon <?php if(($sub_menu['current']) != "1"): ?>icon-fold<?php endif; ?>"></i>
            	<?php if(($sub_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["title"]); ?></a><?php else: ?><i class="fa fa-folder-open-o"></i><?php echo ($sub_menu["title"]); endif; ?>
            </h3><span class="fa arrow"></span></a>
            <ul class="nav nav-second-level <?php if(($sub_menu["current"]) != "1"): ?>subnav-off<?php endif; ?>">
                <?php if(is_array($sub_menu['_child'])): $i = 0; $__LIST__ = $sub_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li <?php if($menu['id'] == $cate_id or $menu['current'] == 1): ?>class="current"<?php endif; ?>>
                        <?php if(($menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($menu["url"])); ?>">&nbsp;&nbsp;<i class="fa fa-list-alt"></i><?php echo ($menu["title"]); ?><span class="fa arrow"></span></a>
                        <?php else: ?>
                          <a class="item" href="javascript:void(0);">&nbsp;&nbsp;<i class="fa fa-table fa-fw"></i><?php echo ($menu["title"]); ?></a><?php endif; ?>

                        <!-- 一级子菜单 -->
                        <?php if(isset($menu['_child'])): ?><ul class="nav nav-third-level">
                        	<?php if(is_array($menu['_child'])): foreach($menu['_child'] as $key=>$three_menu): ?><li>
                                <?php if(($three_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($three_menu["url"])); ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo ($three_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($three_menu["title"]); ?></a><?php endif; ?>
                                <!-- 二级子菜单 -->
                                <?php if(isset($three_menu['_child'])): ?><ul class="subitem">
                                	<?php if(is_array($three_menu['_child'])): foreach($three_menu['_child'] as $key=>$four_menu): ?><li>
                                        <?php if(($four_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$four_menu['id']);?>"><?php echo ($four_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($four_menu["title"]); ?></a><?php endif; ?>
                                        <!-- 三级子菜单 -->
                                        <?php if(isset($four_menu['_child'])): ?><ul class="subitem">
                                        	<?php if(is_array($four_menu['_child'])): $i = 0; $__LIST__ = $four_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$five_menu): $mod = ($i % 2 );++$i;?><li>
                                            	<?php if(($five_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo U('index','cate_id='.$five_menu['id']);?>"><?php echo ($five_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($five_menu["title"]); ?></a><?php endif; ?>
                                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </ul><?php endif; ?>
                                        <!-- end 三级子菜单 -->
                                    </li><?php endforeach; endif; ?>
                                </ul><?php endif; ?>
                                <!-- end 二级子菜单 -->
                            </li><?php endforeach; endif; ?>
                        </ul><?php endif; ?>
                        <!-- end 一级子菜单 -->
                    </li><?php endforeach; endif; else: echo "" ;endif; ?>
            </ul><?php endif; ?>
        <!-- /子导航 --><?php endforeach; endif; else: echo "" ;endif; ?>
    <?php if(!empty($_extra_menu)): ?>
        <?php echo extra_menu($_extra_menu,$__MENU__); endif; ?>
    <?php if(is_array($__MENU__["child"])): $i = 0; $__LIST__ = $__MENU__["child"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i; if(!empty($sub_menu)): if(!empty($key)): ?><a href="#"><h3><i class="fa fa-suitcase"></i><?php echo ($key); ?></h3><span class="fa arrow"></span></a><?php endif; ?>
    <ul class="nav nav-second-level">
        <?php if(is_array($sub_menu)): $i = 0; $__LIST__ = $sub_menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li>											
            <a href="<?php echo (u($menu["url"])); ?>"><i class="fa fa-bitbucket"></i>&nbsp;&nbsp;<?php echo ($menu["title"]); ?></a>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul><?php endif; endforeach; endif; else: echo "" ;endif; ?> 
    <!-- 回收站 -->
    <ul class="nav ">
        <li>											
            <a href="<?php echo U('article/recycle');?>"><h3><i class="fa fa-bitbucket"></i>回收站</h3></a>
        </li>
    </ul>
</li>  

 


  </ul> 
</div>
</nav>

  <div id="page-wrapper"> 
  <div class="row"> 
    <div id="main" class="col-lg-12 main">
      
      <?php if(!empty($_show_nav)): ?><!-- nav -->
      <div class="breadcrumb">
        <span>您的位置:</span>
        <?php $i = '1'; ?>
        <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
            <?php else: ?>
            <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
            <?php $i = $i+1; endforeach; endif; ?>
      </div><!-- /nav --><?php endif; ?>
             
      

<div class="main-title cf">
    <h2>
        新增<?php echo (get_document_model($info["model_id"],'title')); ?> [
        <?php if(is_array($rightNav)): $i = 0; $__LIST__ = $rightNav;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$nav): $mod = ($i % 2 );++$i;?><a href="<?php echo U('article/index','cate_id='.$nav['id']);?>"><?php echo ($nav["title"]); ?></a>
        <?php if(count($rightNav) > $i): ?><i class="ca"></i><?php endif; endforeach; endif; else: echo "" ;endif; ?>
        <?php if(isset($article)): ?>：<a href="<?php echo U('article/index','cate_id='.$info['category_id'].'&pid='.$article['id']);?>"><?php echo ($article["title"]); ?></a><?php endif; ?>
        ]
    </h2>
</div>

<div class="panel panel-default">
    <div class="tab-wrap  panel-body ">	 
        <!-- 标签页导航 --> 
        <ul class="nav nav-tabs ">
            <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><li data-tab="tab<?php echo ($key); ?>" <?php if(($key) == "1"): ?>class="active"<?php endif; ?> ><a href="#tab<?php echo ($key); ?>" data-toggle="tab" ><?php echo ($group); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        
        <div class="row">
            <!-- 表单 -->
            <form id="form" action="<?php echo U('update');?>" method="post" class="form " role="form" >
            <div class="tab-content panel-body">             
                <!-- 基础文档模型 -->
                <?php $_result=parse_config_attr($model['field_group']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$group): $mod = ($i % 2 );++$i;?><div id="tab<?php echo ($key); ?>" class="tab-pane fade <?php if(($key) == "1"): ?>in active<?php endif; ?> tab<?php echo ($key); ?>">
                    <?php if(is_array($fields[$key])): $i = 0; $__LIST__ = $fields[$key];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$field): $mod = ($i % 2 );++$i; if($field['is_show'] == 1 || $field['is_show'] == 2): ?><div class="form-group">
                            <label class="item-label"><?php echo ($field['title']); ?><span class="check-tips"><?php if(!empty($field['remark'])): ?>（<?php echo ($field['remark']); ?>）<?php endif; ?></span></label>
                            <div class="form-group">
                                <?php switch($field["type"]): case "num": ?><input type="text" class="form-control" name="<?php echo ($field["name"]); ?>" value="<?php echo ($field["value"]); ?>"><?php break;?>
                                    <?php case "string": ?><input type="text" class="form-control" name="<?php echo ($field["name"]); ?>" value="<?php echo ($field["value"]); ?>"><?php break;?>
                                    <?php case "textarea": ?><textarea name="<?php echo ($field["name"]); ?>" class="form-control" ><?php echo ($field["value"]); ?></textarea><?php break;?>
                                    <?php case "datetime": ?><input type="datetime" name="<?php echo ($field["name"]); ?>" class="form-control " value="" placeholder="请选择时间" /><?php break;?>
                                    <?php case "bool": ?><select name="<?php echo ($field["name"]); ?>" class="form-control ">
                                            <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select><?php break;?>
                                    <?php case "select": ?><select name="<?php echo ($field["name"]); ?>" class="form-control ">
                                            <?php $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>selected<?php endif; ?>><?php echo ($vo); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                        </select><?php break;?>
                                    <?php case "radio": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="radio">
                                            <input type="radio" value="<?php echo ($key); ?>" <?php if(($field["value"]) == $key): ?>checked<?php endif; ?> name="<?php echo ($field["name"]); ?>"><?php echo ($vo); ?>
                                            </label><?php endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "checkbox": $_result=parse_field_attr($field['extra']);if(is_array($_result)): $i = 0; $__LIST__ = $_result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><label class="checkbox">
                                            <input type="checkbox" value="<?php echo ($key); ?>" name="<?php echo ($field["name"]); ?>" <?php if(($field["value"]) == $key): ?>checked<?php endif; ?>><?php echo ($vo); ?>
                                            </label><?php endforeach; endif; else: echo "" ;endif; break;?>
                                    <?php case "editor": ?><textarea name="<?php echo ($field["name"]); ?>" class=" "><?php echo ($field["value"]); ?></textarea>
                                        <?php echo hook('adminArticleEdit', array('name'=>$field['name'],'value'=>$field['value'])); break;?>
                                    <?php case "picture": ?><div class="controls">
                                            <input type="file" id="upload_picture_<?php echo ($field["name"]); ?>">
                                            <input type="hidden" name="<?php echo ($field["name"]); ?>" id="cover_id_<?php echo ($field["name"]); ?>"/>
                                            <div class="upload-img-box">
                                            <?php if(!empty($data[$field['name']])): ?><div class="upload-pre-item"><img src="<?php echo (get_cover($data[$field['name']],'path')); ?>"/></div><?php endif; ?>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                        //上传图片
                                        /* 初始化上传插件 */
                                        $("#upload_picture_<?php echo ($field["name"]); ?>").uploadify({
                                            "height"          : 30,
                                            "swf"             : "/wwwroot/Public/static/uploadify/uploadify.swf",
                                            "fileObjName"     : "download",
                                            "buttonText"      : "上传图片",
                                            "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
                                            "width"           : 120,
                                            'removeTimeout'	  : 1,
                                            'fileTypeExts'	  : '*.jpg; *.png; *.gif;',
                                            "onUploadSuccess" : uploadPicture<?php echo ($field["name"]); ?>,
                                            'onFallback' : function() {
                                                alert('未检测到兼容版本的Flash.');
                                            }
                                        });
                                        function uploadPicture<?php echo ($field["name"]); ?>(file, data){
                                            var data = $.parseJSON(data);
                                            var src = '';
                                            if(data.status){
                                                $("#cover_id_<?php echo ($field["name"]); ?>").val(data.id);
                                                src = data.url || '/wwwroot' + data.path
                                                $("#cover_id_<?php echo ($field["name"]); ?>").parent().find('.upload-img-box').html(
                                                    '<div class="upload-pre-item"><img src="/wwwroot' + src + '"/></div>'
                                                );
                                            } else {
                                                updateAlert(data.info);
                                                setTimeout(function(){
                                                    $('#top-alert').find('button').click();
                                                    $(that).removeClass('disabled').prop('disabled',false);
                                                },1500);
                                            }
                                        }
                                        </script><?php break;?>
                                    <?php case "file": ?><div class="controls">
                                            <input type="file" id="upload_file_<?php echo ($field["name"]); ?>">
                                            <input type="hidden" name="<?php echo ($field["name"]); ?>" value="<?php echo ($data[$field['name']]); ?>"/>
                                            <div class="upload-img-box">
                                                <?php if(isset($data[$field['name']])): ?><div class="upload-pre-file"><span class="upload_icon_all"></span><?php echo ($data[$field['name']]); ?></div><?php endif; ?>
                                            </div>
                                        </div>
                                        <script type="text/javascript">
                                        //上传图片
                                        /* 初始化上传插件 */
                                        $("#upload_file_<?php echo ($field["name"]); ?>").uploadify({
                                            "height"          : 30,
                                            "swf"             : "/wwwroot/Public/static/uploadify/uploadify.swf",
                                            "fileObjName"     : "download",
                                            "buttonText"      : "上传附件",
                                            "uploader"        : "<?php echo U('File/upload',array('session_id'=>session_id()));?>",
                                            "width"           : 120,
                                            'removeTimeout'	  : 1,
                                            "onUploadSuccess" : uploadFile<?php echo ($field["name"]); ?>,
                                            'onFallback' : function() {
                                                alert('未检测到兼容版本的Flash.');
                                            }
                                        });
                                        function uploadFile<?php echo ($field["name"]); ?>(file, data){
                                            var data = $.parseJSON(data);
                                            if(data.status){
                                                var name = "<?php echo ($field["name"]); ?>";
                                                $("input[name="+name+"]").val(data.data);
                                                $("input[name="+name+"]").parent().find('.upload-img-box').html(
                                                    "<div class=\"upload-pre-file\"><span class=\"upload_icon_all\"></span>" + data.info + "</div>"
                                                );
                                            } else {
                                                updateAlert(data.info);
                                                setTimeout(function(){
                                                    $('#top-alert').find('button').click();
                                                    $(that).removeClass('disabled').prop('disabled',false);
                                                },1500);
                                            }
                                        }
                                        </script><?php break;?>
                                    <?php default: ?>
                                    <input type="text" class="form-control" name="<?php echo ($field["name"]); ?>" value="<?php echo ($field["value"]); ?>"><?php endswitch;?>
                            </div>
                        </div><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                </div><?php endforeach; endif; else: echo "" ;endif; ?>

                <div class="form-group">
                    <button class="btn btn-default submit-btn ajax-post hidden" id="submit" type="submit" target-form="form">确 定</button>
                    <button class="btn btn-default btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
                    <?php if(C('OPEN_DRAFTBOX') and (ACTION_NAME == 'add' or $info['status'] == 3)): ?><button class="btn btn-default save-btn ajax-post" url="<?php echo U('article/autoSave');?>" target-form="form" id="autoSave">
                        存草稿
                    </button><?php endif; ?>
                    <input type="hidden" name="id" value="<?php echo ((isset($info["id"]) && ($info["id"] !== ""))?($info["id"]):''); ?>"/>
                    <input type="hidden" name="pid" value="<?php echo ((isset($info["pid"]) && ($info["pid"] !== ""))?($info["pid"]):''); ?>"/>
                    <input type="hidden" name="model_id" value="<?php echo ((isset($info["model_id"]) && ($info["model_id"] !== ""))?($info["model_id"]):''); ?>"/>
                    <input type="hidden" name="category_id" value="<?php echo ((isset($info["category_id"]) && ($info["category_id"] !== ""))?($info["category_id"]):''); ?>">
                </div>
            </div>
            </form>
        </div>
    </div>
</div>
 
    </div>  
  </div>
</div>		  
    <!--  页脚，版权信息   ================================================== -->     
  <footer class="bs-footer" role="contentinfo">
	<div class="container">	  
		<p> 本站由 <strong><a href="http://www.thinkphp.cn" target="_blank">Think 3.2.1</a></strong> 强力驱动</p>
	</div>
  </footer>
  <!--  /页脚，版权信息   ================================================== -->  

  <div class="hidden"><!-- 用于加载统计代码等隐藏元素 -->
	
  </div>
</div>    
  
<!-- Core Scripts - Include with every page -->
<script type="text/javascript" src="/wwwroot/Public/static/jquery-1.10.2.min.js"></script> 
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/bootstrap.min.js"></script> 
<!-- Page-Level Plugin Scripts - 侧边栏 -->
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/plugins/metisMenu/jquery.metisMenu.js"></script> 
<!-- 弹出提示框，ajax用 js -->
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/plugins/messenger/messenger.js"></script> 
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/plugins/messenger/messenger-theme-future.js"></script> 
<!-- Page-Level Plugin Scripts - Tables 表格-->
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/plugins/dataTables/jquery.dataTables.js"></script> 
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/plugins/dataTables/dataTables.bootstrap.js"></script> 

<!-- SB Admin Scripts - Include with every page -->
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/sb-admin.js"></script>

<!-- Page-Level Demo Scripts - Blank - Use for reference -->

<!--  think JS   ================================================== --> 
<script type="text/javascript">
(function(){
	var ThinkPHP = window.Think = {
		"ROOT"   : "/wwwroot", //当前网站地址
		"APP"    : "/wwwroot/index.php?s=", //当前项目地址
		"PUBLIC" : "/wwwroot/Public", //项目公共目录地址
		"DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
		"MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
		"VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
	}
})();
</script>
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/think.js"></script>
<script type="text/javascript" src="/wwwroot/Public/Admin/js/sb/think_ajax.js"></script>
<!--include file="Public/navjs"/-->


<script type="text/javascript" src="/wwwroot/Public/static/uploadify/jquery.uploadify.min.js"></script> 

<script type="text/javascript">

$('#submit').click(function(){
	$('#form').submit();
});

$(function(){
    $('.time').datetimepicker({
        format: 'yyyy-mm-dd hh:ii',
        language:"zh-CN",
        minView:2,
        autoclose:true
    });
    showTab();

	<?php if(C('OPEN_DRAFTBOX') and (ACTION_NAME == 'add' or $info['status'] == 3)): ?>//保存草稿
	var interval;
	$('#autoSave').click(function(){
        var target_form = $(this).attr('target-form');
        var target = $(this).attr('url')
        var form = $('.'+target_form);
        var query = form.serialize();
        var that = this;

        $(that).addClass('disabled').attr('autocomplete','off').prop('disabled',true);
        $.post(target,query).success(function(data){
            if (data.status==1) {
                updateAlert(data.info ,'alert-success');
                $('input[name=id]').val(data.data.id);
            }else{
                updateAlert(data.info);
            }
            setTimeout(function(){
                $('#top-alert').find('button').click();
                $(that).removeClass('disabled').prop('disabled',false);
            },1500);
        })

        //重新开始定时器
        clearInterval(interval);
        autoSaveDraft();
        return false;
    });

	//Ctrl+S保存草稿
	$('body').keydown(function(e){
		if(e.ctrlKey && e.which == 83){
			$('#autoSave').click();
			return false;
		}
	});

	//每隔一段时间保存草稿
	function autoSaveDraft(){
		interval = setInterval(function(){
			//只有基础信息填写了，才会触发
			var title = $('input[name=title]').val();
			var name = $('input[name=name]').val();
			var des = $('textarea[name=description]').val();
			if(title != '' || name != '' || des != ''){
				$('#autoSave').click();
			}
		}, 1000*parseInt(<?php echo C('DRAFT_AOTOSAVE_INTERVAL');?>));
	}
	autoSaveDraft();<?php endif; ?>

});
</script>
 
<!-- 页面footer钩子，一般用于加载插件JS文件和JS代码 -->
<?php echo hook('pageFooter', 'widget');?>
</body>
</html>