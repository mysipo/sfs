<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|思博网管理平台</title>
    <link href="/mysipo_video/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/mysipo_video/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/mysipo_video/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/mysipo_video/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/mysipo_video/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/mysipo_video/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
    <link rel="stylesheet" href="/mysipo_video/Public/Admin/css/series.css">

     <!--[if lt IE 9]>
    <script type="text/javascript" src="/mysipo_video/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/mysipo_video/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/mysipo_video/Public/Admin/js/jquery.mousewheel.js"></script>
    <!--<![endif]-->
    
</head>
<body>
    <!-- 头部 -->
    <div class="header">
        <!-- Logo -->
        <span class="logo"></span>
        <!-- /Logo -->

        <!-- 主导航 -->
        <ul class="main-nav">
            <?php if(is_array($__MENU__["main"])): $i = 0; $__LIST__ = $__MENU__["main"];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li class="<?php echo ((isset($menu["class"]) && ($menu["class"] !== ""))?($menu["class"]):''); ?>"><a href="<?php echo (u($menu["url"])); ?>"><?php echo ($menu["title"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <!-- /主导航 -->

        <!-- 用户栏 -->
        <div class="user-bar">
            <a href="javascript:;" class="user-entrance"><i class="icon-user"></i></a>
            <ul class="nav-list user-menu hidden">
                <li class="manager">你好，<em title="<?php echo session('user_auth.username');?>"><?php echo session('user_auth.username');?></em></li>
                <li><a href="<?php echo U('User/updatePassword');?>">修改密码</a></li>
                <li><a href="<?php echo U('User/updateNickname');?>">修改昵称</a></li>
                <li><a href="<?php echo U('Public/logout');?>">退出</a></li>
            </ul>
        </div>
    </div>
    <!-- /头部 -->

    <!-- 边栏 -->
    <div class="sidebar">
        <!-- 子导航 -->
        
    <div id="subnav" class="subnav">
    <?php if(is_array($nodes)): $i = 0; $__LIST__ = $nodes;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sub_menu): $mod = ($i % 2 );++$i;?><!-- 子导航 -->
        <?php if(!empty($sub_menu)): ?><h3>
            	<i class="icon <?php if(($sub_menu['current']) != "1"): ?>icon-fold<?php endif; ?>"></i>
            	<?php if(($sub_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($sub_menu["url"])); ?>"><?php echo ($sub_menu["title"]); ?></a><?php else: echo ($sub_menu["title"]); endif; ?>
            </h3>
            <ul class="side-sub-menu <?php if(($sub_menu["current"]) != "1"): ?>subnav-off<?php endif; ?>">
                <?php if(is_array($sub_menu['_child'])): $i = 0; $__LIST__ = $sub_menu['_child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><li <?php if($menu['id'] == $cate_id or $menu['current'] == 1): ?>class="current"<?php endif; ?>>
                        <?php if(($menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($menu["url"])); ?>&cate_id=<?php echo ($sub_menu["id"]); ?>"><?php echo ($menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($menu["title"]); ?></a><?php endif; ?>

                        <!-- 一级子菜单 -->
                        <?php if(isset($menu['_child'])): ?><ul class="subitem">
                        	<?php if(is_array($menu['_child'])): foreach($menu['_child'] as $key=>$three_menu): ?><li>
                                <?php if(($three_menu['allow_publish']) > "0"): ?><a class="item" href="<?php echo (u($three_menu["url"])); ?>"><?php echo ($three_menu["title"]); ?></a><?php else: ?><a class="item" href="javascript:void(0);"><?php echo ($three_menu["title"]); ?></a><?php endif; ?>
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
</div>
<script>
    $(function(){
        $(".side-sub-menu li").hover(function(){
            $(this).addClass("hover");
        },function(){
            $(this).removeClass("hover");
        });
    })
</script>


        <!-- /子导航 -->
    </div>
    <!-- /边栏 -->

    <!-- 内容区 -->
    <div id="main-content">
        <div id="top-alert" class="fixed alert alert-error" style="display: none;">
            <button class="close fixed" style="margin-top: 4px;">&times;</button>
            <div class="alert-content">这是内容</div>
        </div>
        <div id="main" class="main">
            
            <!-- nav -->
            <?php if(!empty($_show_nav)): ?><div class="breadcrumb">
                <span>您的位置:</span>
                <?php $i = '1'; ?>
                <?php if(is_array($_nav)): foreach($_nav as $k=>$v): if($i == count($_nav)): ?><span><?php echo ($v); ?></span>
                    <?php else: ?>
                    <span><a href="<?php echo ($k); ?>"><?php echo ($v); ?></a>&gt;</span><?php endif; ?>
                    <?php $i = $i+1; endforeach; endif; ?>
            </div><?php endif; ?>
            <!-- nav -->
            

            
	<script type="text/javascript" src="/mysipo_video/Public/static/uploadify/jquery.uploadify.min.js"></script>
	<script src="/mysipo_video/Public/static/laydate/laydate.dev.js"></script>
	<div class="main-title">
		<h2><?php echo isset($info['live_id'])?'编辑':'新增';?>直播</h2>
	</div>
	<div class="tab-wrap">

		<div class="tab-content">
			<form action="<?php echo U();?>" method="post" class="form-horizontal">
				<!-- 基础 -->

				<div id="tab1" class="tab-pane in tab1">
					<div class="form-item">
						<div class="controls">
							课程标题：
							<input type="text" name="live_title" class="text input-large" value="<?php echo ((isset($info["live_title"]) && ($info["live_title"] !== ""))?($info["live_title"]):''); ?>"><span class="check-tips">（标题不能为空）</span>
						</div>
					</div>
					<div class="form-item cf">
						<div class="controls">
							频&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;道：
							<select name="cl_id" class="input-3x">
								<?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$class): $mod = ($i % 2 );++$i;?><option value="<?php echo ($class["cl_id"]); ?>"><?php echo ($class["cl_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
							</select>
						</div>
					</div>
					<div class="form-item cf">
						<div class="controls">
							类&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;型：
							<select name="live_type" class="input-3x">
								<option value="1">理论</option>
								<option value="2">实践</option>
							</select>
						</div>
					</div>


					<div class="form-item">
						<div class="controls">
							开始时间：
							<input type="datetime" id="start" placeholder="请选择" readonly="readOnly" name="live_start_time" class="laydate-icon text input-3x" value="<?php echo ((isset($info["live_start_time"]) && ($info["live_start_time"] !== ""))?($info["live_start_time"]):''); ?>">

						</div>
					</div>
					<div class="form-item">
						<div class="controls">
							结束时间：
							<input  type="datetime" id="end" placeholder="请选择" readonly="readOnly" name="live_stop_time" class="laydate-icon text input-3x" value="<?php echo ((isset($info["live_stop_time"]) && ($info["live_stop_time"] !== ""))?($info["live_stop_time"]):''); ?>">
						</div>
					</div>
					<div class="form-item">
						<div class="controls">
							价&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;格：
							<input type="text" name="price" class="text input-3x" value="<?php echo ((isset($info["price"]) && ($info["price"] !== ""))?($info["price"]):'0.00'); ?>" onkeyup="this.value=this.value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')" maxlength="9"><span class="check-tips">6位整数2小数，默认0为免费</spa
						</div>
					</div>
					<div class="form-item">
						<div class="controls">
							折&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;扣：
							<select name="dct_id" id="" class="input-3x" disabled>
								<option value="1">原价</option>
								<option value="2">打折</option>
							</select>
						</div>
					</div>

					<div class="form-item">
						<div class="controls">
							讲师帐号：
							<input type="text" name="tch_name" class="text input-3x" value="<?php echo ((isset($info["tch_name"]) && ($info["tch_name"] !== ""))?($info["tch_name"]):''); ?>">
						</div>
					</div>
					<div class="form-item">
						<div class="controls">
							助教帐号：
							<input type="text" name="tutor_name" class="text input-3x" value="<?php echo ((isset($info["tutor_name"]) && ($info["tutor_name"] !== ""))?($info["tutor_name"]):'思博学院助教'); ?>">
						</div>
					</div>
					<div class="form-item">
						<div class="controls">
							报名人数：
							<input type="text" name="live_num" class="text input-3x" value="<?php echo ((isset($info["live_num"]) && ($info["live_num"] !== ""))?($info["live_num"]):'0'); ?>" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')" maxlength="4"><span class="check-tips">默认0为不限人数</span>
						</div>
					</div>
					<div class="form-item">
		                <label class="item-label">
		                    标志图<span class="check-tips"></span>
		                </label>
		                <div class="controls">
		                    <input type="file" id="upload_picture">
		                    <input type="hidden" name="live_img" id="live_img" value="<?php echo ($info["live_img"]); ?>"/>
		                    <input type="hidden" name='old_live_img' value="<?php echo ($info["live_img"]); ?>">
		                    <div class="upload-img-box">
		                    <?php if(!empty($info['live_img'])): ?><div id="img"><div class="upload-pre-item" style="width:300px;max-height:200px;"><img src="/mysipo_video<?php echo ($info['live_img']); ?>"/>
		                        </div>
		                        </div>
		                    <?php else: ?>
		                        <div id="img"></div><?php endif; ?>

		                    </div>
		                    <script type="text/javascript">
		                    //上传图片
		                    /* 初始化上传插件 */
		                    $("#upload_picture").uploadify({
		                        "height"          : 30,
		                        "swf"             : "/mysipo_video/Public/static/uploadify/uploadify.swf",
		                        "fileObjName"     : "download",
		                        "buttonText"      : "上传图片",
		                        "uploader"        : "<?php echo U('File/uploadPicture',array('session_id'=>session_id()));?>",
		                        "width"           : 120,
		                        'removeTimeout'   : 1,
		                        'fileTypeExts'    : '*.jpg; *.png; *.gif;',
		                        "onUploadSuccess" : uploadPicture,
		                        "onUploadError"   : uploadPicture,
		                        'onFallback' : function() {
		                            alert('未检测到兼容版本的Flash.');
		                        }
		                    });
		                    function uploadPicture(file, data){
		                        var data = $.parseJSON(data);
		                        console.log(data);
		                        if(data.id){
		                            $("#live_img").val(data.path);
		                            src = '/mysipo_video' + data.path
		                            $("#img").html(
		                                '<div class="upload-pre-item" style="width:300px;max-height:200px;"><img src="' + src + '"/></div>'
		                            );

		                        } else {
		                            updateAlert(data.info);
		                            setTimeout(function(){
		                                $('#top-alert').find('button').click();
		                                $(this).removeClass('disabled').prop('disabled',false);
		                            },1500);
		                        }
		                    }
		                    </script>
		            </div>

				</div>

				<div class="form-item" style="margin-top:30px;">
					<input type="hidden" name="live_id" value="<?php echo ((isset($info["live_id"]) && ($info["live_id"] !== ""))?($info["live_id"]):''); ?>">
					<button type="submit" id="submit" class="btn submit-btn ajax-post" target-form="form-horizontal">确 定</button>
					<button class="btn btn-return" onclick="javascript:history.back(-1);return false;">返 回</button>
				</div>
			</form>
		</div>
	</div>

        </div>
        <div class="cont-ft">
            <div class="copyright">
                <div class="fl">感谢使用<a href="http://www.mysipo.com" target="_blank">思博知网</a>管理平台</div>
                <div class="fr">V<?php echo (ONETHINK_VERSION); ?></div>
            </div>
        </div>
    </div>
    <!-- /内容区 -->
    <script type="text/javascript">
    (function(){
        var ThinkPHP = window.Think = {
            "ROOT"   : "/mysipo_video", //当前网站地址
            "APP"    : "/mysipo_video/index.php?s=", //当前项目地址
            "PUBLIC" : "/mysipo_video/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/mysipo_video/Public/static/think.js"></script>
    <script type="text/javascript" src="/mysipo_video/Public/Admin/js/common.js"></script>
    <script type="text/javascript">
        +function(){
            var $window = $(window), $subnav = $("#subnav"), url;
            $window.resize(function(){
                $("#main").css("min-height", $window.height() - 130);
            }).resize();

            /* 左边菜单高亮 */
            url = window.location.pathname + window.location.search;
            url = url.replace(/(\/(p)\/\d+)|(&p=\d+)|(\/(id)\/\d+)|(&id=\d+)|(\/(group)\/\d+)|(&group=\d+)/, "");
            $subnav.find("a[href='" + url + "']").parent().addClass("current");

            /* 左边菜单显示收起 */
            $("#subnav").on("click", "h3", function(){
                var $this = $(this);
                $this.find(".icon").toggleClass("icon-fold");
                $this.next().slideToggle("fast").siblings(".side-sub-menu:visible").
                      prev("h3").find("i").addClass("icon-fold").end().end().hide();
            });

            $("#subnav h3 a").click(function(e){e.stopPropagation()});

            /* 头部管理员菜单 */
            $(".user-bar").mouseenter(function(){
                var userMenu = $(this).children(".user-menu ");
                userMenu.removeClass("hidden");
                clearTimeout(userMenu.data("timeout"));
            }).mouseleave(function(){
                var userMenu = $(this).children(".user-menu");
                userMenu.data("timeout") && clearTimeout(userMenu.data("timeout"));
                userMenu.data("timeout", setTimeout(function(){userMenu.addClass("hidden")}, 100));
            });

	        /* 表单获取焦点变色 */
	        $("form").on("focus", "input", function(){
		        $(this).addClass('focus');
	        }).on("blur","input",function(){
				        $(this).removeClass('focus');
			        });
		    $("form").on("focus", "textarea", function(){
			    $(this).closest('label').addClass('focus');
		    }).on("blur","textarea",function(){
			    $(this).closest('label').removeClass('focus');
		    });

            // 导航栏超出窗口高度后的模拟滚动条
            var sHeight = $(".sidebar").height();
            var subHeight  = $(".subnav").height();
            var diff = subHeight - sHeight; //250
            var sub = $(".subnav");
            if(diff > 0){
                $(window).mousewheel(function(event, delta){
                    if(delta>0){
                        if(parseInt(sub.css('marginTop'))>-10){
                            sub.css('marginTop','0px');
                        }else{
                            sub.css('marginTop','+='+10);
                        }
                    }else{
                        if(parseInt(sub.css('marginTop'))<'-'+(diff-10)){
                            sub.css('marginTop','-'+(diff-10));
                        }else{
                            sub.css('marginTop','-='+10);
                        }
                    }
                });
            }
        }();
    </script>
    
	<script type="text/javascript">
		<?php if(isset($info["live_id"])): ?>Think.setValue("allow_publish", <?php echo ((isset($info["allow_publish"]) && ($info["allow_publish"] !== ""))?($info["allow_publish"]):1); ?>);
		Think.setValue("cl_id", <?php echo ((isset($info["cl_id"]) && ($info["cl_id"] !== ""))?($info["cl_id"]):1); ?>);
		Think.setValue("live_type", <?php echo ((isset($info["live_type"]) && ($info["live_type"] !== ""))?($info["live_type"]):1); ?>);
		Think.setValue("dct_id", <?php echo ((isset($info["dct_id"]) && ($info["dct_id"] !== ""))?($info["dct_id"]):0); ?>);
		Think.setValue("type[]", <?php echo (json_encode($info["type"])); ?> || [2]);
		Think.setValue("display", <?php echo ((isset($info["display"]) && ($info["display"] !== ""))?($info["display"]):1); ?>);
		Think.setValue("reply", <?php echo ((isset($info["reply"]) && ($info["reply"] !== ""))?($info["reply"]):0); ?>);
		Think.setValue("reply_model[]", <?php echo (json_encode($info["reply_model"])); ?> || [1]);<?php endif; ?>
		$(function(){
			showTab();
			$("input[name=reply]").change(function(){
				var $reply = $(".form-item.reply");
				parseInt(this.value) ? $reply.show() : $reply.hide();
			}).filter(":checked").change();
		});
		//导航高亮
		highlight_subnav('<?php echo U('Playlive/index');?>');
	</script>
	 <script>
        var start = {
            elem: '#start',
            format: 'YYYY-MM-DD hh:mm:ss',
            min: laydate.now(), //设定最小日期为当前日期
            max: '2099-06-16 23:59:59', //最大日期
            istime: true,
            istoday: false,
            choose: function(datas){
                 end.min = datas; //开始日选好后，重置结束日的最小日期
                 end.start = datas //将结束日的初始值设定为开始日
            }
        };
        var end = {
            elem: '#end',
            format: 'YYYY-MM-DD hh:mm:ss',
            min: laydate.now(),
            max: '2099-06-16 23:59:59',
            istime: true,
            istoday: false,
            choose: function(datas){
                start.max = datas; //结束日选好后，重置开始日的最大日期
            }
        };
        laydate(start);
        laydate(end);
        </script>

</body>
</html>