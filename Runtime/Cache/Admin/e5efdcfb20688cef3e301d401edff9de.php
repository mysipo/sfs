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
            

            
	<!-- 标题栏 -->
	<div class="main-title">
		<h2>直播列表</h2>

	</div>
    <div class="tools clearfloat">
        <div style="float:right;">
                频道：
            <select name="clid" id="cl_id" class="input-2x" onchange="form1()">
                <option value="0">全部</option>
                <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cl["cl_id"]); ?>"><?php echo ($cl["cl_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>

                状态：
            <select name="status" id="status" class="input-2x" onchange="form1()">
                <option value="0">全部</option>
                <option value="1">直播中</option>
                <option value="2">即将开始</option>
                <option value="3">已结束</option>
            </select>
                类型：
            <select name="type" id="type" class="input-2x" onchange="form1()">
                <option value="0">全部</option>
                <option value="1">理论</option>
                <option value="2">实践</option>
            </select>
                详情页：
            <select name="content" id="content" class="input-2x" onchange="form1()">
                <option value="0">全部</option>
                <option value="1">已开通</option>
                <option value="2">未开通</option>
            </select>
        </div>

        <a class="btn" href="<?php echo U('Playlive/add');?>" style="float:left;">新 增</a>
    </div>

	<!-- 数据列表 -->
	<div class="data-table">
        <div class="data-table table-striped">
<table class="">
    <thead>
        <tr>
		<th>ID</th>
		<th width="150">课程标题</th>
        <th width="90">频道</th>
        <th width="70">状态</th>
        <th width="50">类型</th>
		<th width="50">人数</th>
		<th width="80">课程详情</th>
		<th width="100">讲师</th>
        <th width="100">助教</th>
        <th width="90">开始时间</th>
		<th width="90">结束时间</th>
		<th width="90">操作</th>
		</tr>
    </thead>
    <tbody>
	<?php if(!empty($list)): ?><tbody>
		<notempty name="list">
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$live): $mod = ($i % 2 );++$i;?><tr>
				<td><?php echo ($live["live_id"]); ?></td>
                <td class="td-lesson01">
                    <div class="limit-cur" style=""><?php echo ($live["live_title"]); ?></div>
                    <div class="limit-all" style="display: none;position: absolute;background: rgba(78,78,78,.9);z-index: 9;border: 1px solid #eee;padding: 3px 5px;border-radius: 4px;color: #fff;font-size: 12px;"><p><?php echo ($live["sub_title"]); ?><p/></div>
                </td>
                <td>
                    <select name="cl_id" id="" class="cl_id input-2x" live="<?php echo ($live["live_id"]); ?>">
                        <?php if(is_array($class)): $i = 0; $__LIST__ = $class;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$cl): $mod = ($i % 2 );++$i;?><option value="<?php echo ($cl["cl_id"]); ?>" <?php if($live['cl_id'] == $cl['cl_id']): ?>selected="selected"<?php endif; ?>><?php echo ($cl["cl_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </td>
                <td><?php if($live['status'] == 1): ?>未开始<?php elseif($live['status'] == 2): ?><a href="http://s.mysipo.com/show/<?php echo ($live["live_id"]); ?>.html">直播中</a><?php elseif($live['status'] == 4): ?>即将开始<?php else: ?>已结束<?php endif; ?></td>
                <td>
                    <select name="" id="" class="live_type" live="<?php echo ($live["live_id"]); ?>">
                        <option value="1" <?php if($live['live_type'] == 1): ?>selected<?php endif; ?>>理论</option>
                        <option value="2" <?php if($live['live_type'] == 2): ?>selected<?php endif; ?>>实践</option>
                    </select>
                </td>
				<td><?php if($live['live_num'] == 0): ?>不限<?php else: echo ($live["live_num"]); endif; ?></td>

				<td><?php if($live['lc_id'] == 0): ?><a title="频道" href="<?php echo U('content?id='.$live['live_id']);?>">开通</a><?php else: ?><a title="频道" href="<?php echo U('content?id='.$live['live_id']);?>">编辑</a><?php endif; ?></td>
				<td><?php echo ($live["tch_name"]); ?></td>
                <td><?php echo ($live["tutor_name"]); ?></td>
                <td><?php echo (substr($live["live_start_time"],0,10)); ?></td>
				<td><?php echo (substr($live["live_stop_time"],0,10)); ?></td>
				<td>
                    <a title="编辑" href="<?php echo U('edit?id='.$live['live_id']);?>">编辑</a>
					<a class="confirm ajax-get" title="删除" href="<?php echo U('del?id='.$live['live_id']);?>">删除</a>
				</td>
			</tr><?php endforeach; endif; else: echo "" ;endif; ?>
		<?php else: ?>
		<td colspan="12" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
	</tbody>
    </table>

        </div>
    </div>
    <div class="page">
        <?php echo ($_page); ?>
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
    
    <script src="/mysipo_video/Public/static/thinkbox/jquery.thinkbox.js"></script>
    <script type="text/javascript">
    <?php if(isset($select)): ?>Think.setValue("clid", <?php echo ((isset($cl_id) && ($cl_id !== ""))?($cl_id):0); ?>);
        Think.setValue("status", <?php echo ((isset($status) && ($status !== ""))?($status):0); ?>);
        Think.setValue("type", <?php echo ((isset($type) && ($type !== ""))?($type):0); ?>);
        Think.setValue("content", <?php echo ((isset($content) && ($content !== ""))?($content):0); ?>);<?php endif; ?>
    $(function(){
    	$("#search").click(function(){
    		var url = $(this).attr('url');
    		var status = $('select[name=status]').val();
    		var search = $('input[name=search]').val();
    		if(status != ''){
    			url += '/status/' + status;
    		}
    		if(search != ''){
    			url += '/search/' + search;
    		}
    		window.location.href = url;
    	});

        $('.live_type').change(function(){
            var live_type = $(this).val();
            var live_id = $(this).attr('live');
            $.post("<?php echo U('update');?>",{'live_type' : live_type , 'live_id' : live_id},function(data){

            })
        })

        $('.cl_id').change(function(){
            var cl_id = $(this).val();
            var live_id = $(this).attr('live');
            $.post("<?php echo U('update');?>",{'cl_id' : cl_id , 'live_id' : live_id},function(data){

            })
        })

    })
    function form1(){
            var cl_id = $("#cl_id").val();
            var status = $("#status").val();
            var type = $("#type").val();
            var content = $("#content").val();
            window.location.href="<?php echo U('Playlive/index');?>&cl_id="+cl_id+"&status="+status+"&type="+type+"&content="+content;//页面跳转并传参
        }
    !(function($){
        $('.td-lesson01, .td-lesson02').on('mouseenter', function(e) {
            if($(this).children('.limit-cur').text().length > 8) {
                $(this).children('.limit-all').stop().show('fast');
            }
        }).on('mouseleave', function(e) {
            $(this).children('.limit-all').stop().hide('fast');
        });
    })(jQuery);
</script>

</body>
</html>