<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo ($meta_title); ?>|思博网管理平台</title>
    <link href="/adminmanager/Public/favicon.ico" type="image/x-icon" rel="shortcut icon">
    <link rel="stylesheet" type="text/css" href="/adminmanager/Public/Admin/css/base.css" media="all">
    <link rel="stylesheet" type="text/css" href="/adminmanager/Public/Admin/css/common.css" media="all">
    <link rel="stylesheet" type="text/css" href="/adminmanager/Public/Admin/css/module.css">
    <link rel="stylesheet" type="text/css" href="/adminmanager/Public/Admin/css/style.css" media="all">
	<link rel="stylesheet" type="text/css" href="/adminmanager/Public/Admin/css/<?php echo (C("COLOR_STYLE")); ?>.css" media="all">
    <link rel="stylesheet" href="/adminmanager/Public/Admin/css/series.css">

     <!--[if lt IE 9]>
    <script type="text/javascript" src="/adminmanager/Public/static/jquery-1.10.2.min.js"></script>
    <![endif]--><!--[if gte IE 9]><!-->
    <script type="text/javascript" src="/adminmanager/Public/static/jquery-2.0.3.min.js"></script>
    <script type="text/javascript" src="/adminmanager/Public/Admin/js/jquery.mousewheel.js"></script>
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
            

            

	<div class="main-title">
		<h2><?php echo isset($info['id'])?'编辑':'人工新增';?>订单</h2>
	</div>
	<div class="tab-wrap">

		<div class="tab-content">
			<form action="<?php echo U();?>" method="post" class="form-horizontal">

				<div id="tab1" class="tab-pane in tab1">

					<div class="form-item cf ">
						<label class="item-label">系列<span class="check-tips"></span></label>
						<div class="controls">
							<select name="lesson_type" class="input-5x form-all">
								<option value="1" <?php if($info["live_type"] == 0): ?>selected="selected"<?php endif; ?>>系列</option>
								<option value="2" <?php if($info["live_type"] != 0): ?>selected="selected"<?php endif; ?>>课程</option>
							</select>
						</div>
					</div>
					<div class="form-select01">
					  <div class="form-item cf">
					  	<label class="item-label">课程系列<span class="check-tips"></span></label>
					  	<div class="controls">
					  		<select name="series_id" class="input-5x">
					  			<?php if(is_array($series)): $i = 0; $__LIST__ = $series;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$series): $mod = ($i % 2 );++$i;?><option value="<?php echo ($series["ser_id"]); ?>" <?php if($info["lesson_id"] == $series["ser_id"] and $info["live_type"] == 0): ?>selected="selected"<?php endif; ?>><?php echo ($series["ser_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
					  		</select>
					  	</div>
					  </div>
					</div>

					<div class="form-select02" style="display: none;">

				    <div class="form-item cf">
				    	<label class="item-label">课程类型<span class="check-tips"></span></label>
				    	<div class="controls">
				    		<select name="live_type" class="input-5x form-two">
				    			<option value="1" <?php if($info["live_type"] == 1): ?>selected="selected"<?php endif; ?>>直播</option>
								<option value="2" <?php if($info["live_type"] == 2): ?>selected="selected"<?php endif; ?>>录播</option>
				    		</select>
				    	</div>
				    </div>

				    <div class="form-item cf form-select03">
				    	<label class="item-label">直播课程<span class="check-tips"></span></label>
				    	<div class="controls">
				    		<select name="live_id" class="input-5x">
				    			<?php if(is_array($live)): $i = 0; $__LIST__ = $live;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$live): $mod = ($i % 2 );++$i;?><option value="<?php echo ($live["live_id"]); ?>" <?php if($info["lesson_id"] == $live["live_id"] and $info["live_type"] == 1): ?>selected="selected"<?php endif; ?>><?php echo ($live["live_title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				    		</select>
				    	</div>
				    </div>

						<div class="form-item cf form-select04" style="display: none;">
				    	<label class="item-label">录播课程<span class="check-tips"></span></label>
				    	<div class="controls">
				    		<select name="video_id" class="input-5x">
				    			<?php if(is_array($video)): $i = 0; $__LIST__ = $video;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): $mod = ($i % 2 );++$i;?><option value="<?php echo ($video["video_id"]); ?>" <?php if($info["lesson_id"] == $video["video_id"] and $info["live_type"] == 2): ?>selected="selected"<?php endif; ?>><?php echo ($video["title"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
				    		</select>
				    	</div>
				    </div>

					</div>

					<div class="form-item">
						<label class="item-label">
							付款人用户名<span class="check-tips">（用户名不能为空）</span>
						</label>
						<div class="controls">
							<input type="text" name="uname" class="text input-5x" value="<?php echo ((isset($info["uname"]) && ($info["uname"] !== ""))?($info["uname"]):''); ?>">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							付款人电话<span class="check-tips"></span>
						</label>
						<div class="controls">
							<input type="text" name="telphone" class="text input-5x" value="<?php echo ((isset($info["telphone"]) && ($info["telphone"] !== ""))?($info["telphone"]):''); ?>">
						</div>
					</div>

					<div class="form-item cf" style="width:250px;float;left;">
						<label class="item-label">支付渠道<span class="check-tips"></span></label>
						<div class="controls" style="position: relative;">
							<select name="pay_channels" class="input-small">
								<option value="9" selected="selected">其他</option>
								<option value="4">线下支付宝</option>
								<option value="5">线下微信</option>
								<option value="6">线下银行转账</option>
								<option value="7">pos机刷卡</option>
								<option value="8">现金支付</option>
							</select>
							<div class="cash" style="display: none;">
								<span>点击填写银行信息</span>
							</div>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							付款金额<span class="check-tips">（6位整数2位小数）</span>
						</label>
						<div class="controls">
							<input type="text" name="pay_real" class="text input-4x" value="<?php echo ((isset($info["pay_real"]) && ($info["pay_real"] !== ""))?($info["pay_real"]):''); ?>" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')" maxlength="9">
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">
							手续费用<span class="check-tips"></span>
						</label>
						<div class="controls">
							<input type="text" name="pay_fee" value="<?php echo ((isset($payinfo["fee"]) && ($payinfo["fee"] !== ""))?($payinfo["fee"]):''); ?>" class="text input-4x" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')" maxlength="3">
						</div>
					</div>
					<!-- <div class="form-item"  style="padding-bottom: 14px;margin-top:16px;">
						<label class="item-label">
							折扣<span class="check-tips">（默认不打折）</span>
						</label>
						<div class="controls">
							<label class="inline radio"><input type="radio" name="dct_id" value="1" checked disabled>不打折</label>
							<label class="inline radio"><input type="radio" name="dct_id" value="2"disabled>打折期</label>
						</div>
					</div> -->
					<div class="form-item"  style="padding-bottom: 14px;margin-top:16px;">
						<label class="item-label">
							付款状态<span class="check-tips"></span>
						</label>
						<div class="controls">
							<label class="inline radio"><input type="radio" name="status" value="1" checked >未支付</label>
							<label class="inline radio"><input type="radio" name="status" value="2" checked>已支付</label>
							<label class="inline radio"><input type="radio" name="status" value="3">已退款</label>
						</div>
					</div>
					<div class="form-item">
						<label class="item-label">描述</label>
						<div class="controls">
							<label class="textarea input-large">
								<textarea name="description"><?php echo ((isset($info["description"]) && ($info["description"] !== ""))?($info["description"]):''); ?></textarea>
							</label>
						</div>
					</div>

					<!-- 增加弹窗 -->
	<div class="fixed-edit" style="display: none;">
		<div class="fix-main">
			<div class="fix-header">
				<button type="button" class="close" id="close-btn"><span>×</span></button>
          <h4 class="fix-title" >请填写银行卡信息</h4>
			</div>
			<div class="fix-box">
				<div class="fix-item">
					<label for="">开户银行</label>
					<input type="text" class="fix-bank" name="bankname" value="<?php echo ((isset($payinfo["bankname"]) && ($payinfo["bankname"] !== ""))?($payinfo["bankname"]):''); ?>">
				</div>
				<div class="fix-item">
					<label for="">开户姓名</label>
					<input type="text" class="fix-bank" name="username" value="<?php echo ((isset($payinfo["username"]) && ($payinfo["username"] !== ""))?($payinfo["username"]):''); ?>">
				</div>
				<div class="fix-item">
					<label for="">银行卡号</label>
					<input type="text" class="fix-bank" name="card_id" value="<?php echo ((isset($payinfo["card_id"]) && ($payinfo["card_id"] !== ""))?($payinfo["card_id"]):''); ?>" onkeyup="value=value.replace(/[^\d{1,}\.\d{1,}|\d{1,}]/g,'')" maxlength="18">
				</div>
				<div class="fix-item">
					<label for="">描述备注</label>
					<input type="text" class="fix-bank" name="note" value="<?php echo ((isset($payinfo["description"]) && ($payinfo["description"] !== ""))?($payinfo["description"]):''); ?>">
				</div>
				<input type="hidden" name="pay_id" value="<?php echo ((isset($payinfo["pay_id"]) && ($payinfo["pay_id"] !== ""))?($payinfo["pay_id"]):''); ?>">
				<div class="fix-btn fix-item">
					<label for=""></label>
					<p>确认</p>
				</div>
			</div>

		</div>
	</div>
	<!-- 弹窗end -->


				</div>
				<!-- btn submit-btn ajax-post -->
				<div class="form-item">
					<input type="hidden" name="order_on" value="<?php echo ((isset($info["order_on"]) && ($info["order_on"] !== ""))?($info["order_on"]):''); ?>">
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
            "ROOT"   : "/adminmanager", //当前网站地址
            "APP"    : "/adminmanager/index.php?s=", //当前项目地址
            "PUBLIC" : "/adminmanager/Public", //项目公共目录地址
            "DEEP"   : "<?php echo C('URL_PATHINFO_DEPR');?>", //PATHINFO分割符
            "MODEL"  : ["<?php echo C('URL_MODEL');?>", "<?php echo C('URL_CASE_INSENSITIVE');?>", "<?php echo C('URL_HTML_SUFFIX');?>"],
            "VAR"    : ["<?php echo C('VAR_MODULE');?>", "<?php echo C('VAR_CONTROLLER');?>", "<?php echo C('VAR_ACTION');?>"]
        }
    })();
    </script>
    <script type="text/javascript" src="/adminmanager/Public/static/think.js"></script>
    <script type="text/javascript" src="/adminmanager/Public/Admin/js/common.js"></script>
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
		<?php if(isset($info["order_on"])): ?>Think.setValue("ser_level", <?php echo ((isset($info["ser_level"]) && ($info["ser_level"] !== ""))?($info["ser_level"]):2); ?>);
		Think.setValue("dct_id", <?php echo ((isset($info["dct_id"]) && ($info["dct_id"] !== ""))?($info["dct_id"]):0); ?>);
		Think.setValue("lesson_id", <?php echo ((isset($info["lesson_id"]) && ($info["lesson_id"] !== ""))?($info["lesson_id"]):1); ?>);
		Think.setValue("pay_channels", <?php echo ((isset($info["pay_channels"]) && ($info["pay_channels"] !== ""))?($info["pay_channels"]):1); ?>);
		Think.setValue("status", <?php echo ((isset($info["status"]) && ($info["status"] !== ""))?($info["status"]):2); ?>);
		Think.setValue("reply_model[]", <?php echo (json_encode($info["reply_model"])); ?> || [1]);<?php endif; ?>

		$(function(){
			showTab();
			$("input[name=reply]").change(function(){
				var $reply = $(".form-item.reply");
				parseInt(this.value) ? $reply.show() : $reply.hide();
			}).filter(":checked").change();
		});
		/*导航高亮*/
		highlight_subnav('<?php echo U('Payinfo/index');?>');


			var selectAll = $('.form-all').val();

			if(selectAll == '1') {
				$('.form-select01').show().siblings('.form-select02').hide()
			} else if(selectAll == '2') {
				$('.form-select02').show().siblings('.form-select01').hide()
			}

		/*系列和课程切换*/
		$('.form-all').change(function() {

			var selectAll = $(this).val();

			if(selectAll == '1') {
				$('.form-select01').show().siblings('.form-select02').hide()
			} else if(selectAll == '2') {
				$('.form-select02').show().siblings('.form-select01').hide()
			}
		})

		/*录播，直播*/
		var selectTwo = $('.form-two').val();
			if(selectTwo == '1') {
				$('.form-two').parents('.form-item').siblings('.form-select03').show().siblings('.form-select04').hide()
			} else if(selectTwo == '2') {
				$('.form-two').parents('.form-item').siblings('.form-select04').show().siblings('.form-select03').hide()
			}


		$('.form-two').change(function() {
			var selectTwo = $(this).val();
			if(selectTwo == '1') {
				$(this).parents('.form-item').siblings('.form-select03').show().siblings('.form-select04').hide()
			} else if(selectTwo == '2') {
				$(this).parents('.form-item').siblings('.form-select04').show().siblings('.form-select03').hide()
			}
		})


		var selectSmall = $('.input-small').val();
		$('.input-small').siblings('.cash').hide();
		if(selectSmall == '6') {
				$('.input-small').siblings('.cash').show();
		}
		/*点击显示银行填写信息*/
		$('.input-small').change(function() {
			var selectSmall = $(this).children('option:selected').val();
			$(this).siblings('.cash').hide();
			if(selectSmall == '6') {
				$(this).siblings('.cash').show();
			}
		});

		/*银行信息弹窗*/
		$('.cash').on('click', function(e) {
			$('.fixed-edit').css('display', 'block');
		});
		$('#close-btn, .fix-btn p').on('click', function() {
			$('.fixed-edit').css('display', 'none');
		});



	</script>

</body>
</html>