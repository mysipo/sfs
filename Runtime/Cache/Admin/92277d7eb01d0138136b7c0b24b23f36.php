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
		<h2>系列课程</h2>
	</div>
	<div class="tab-wrap">

		<div class="tab-content">
			<form action="<?php echo U();?>" method="post" class="form-horizontal">
				<div id="tab1" class="tab-pane in tab1">
					<div class="form-item cf">
						<input type="hidden" value="<?php echo ($series["ser_id"]); ?>" name="ser_id">
						<label class="item-label">系列标题<span class="check-tips"><?php echo ($series["ser_title"]); ?></span></label>
						<div class="controls">
						    <div class="select-lesson" style>
						    	<span>选择课程&nbsp;&nbsp;</span>
						    	<select name="live_type" class="input-small" id="live_type">
						    			<option value="1">直播</option>
						    			<option value="2">录播</option>
						    	</select>
						    </div>
						    <div class="search-inp">
								<input type="text" name="live_title" class="text input-5x" value="" placeholder="输入课程标题" id="o" onkeyup="autoComplete.start(event)" autocomplete="off">
								<button type="submit" id="submit" class="btn ajax-post" target-form="form-horizontal">确 定</button>
							</div>
					    	<div class="auto_hidden" id="auto"><!--自动完成 DIV--></div>
						</div>
					</div>
				</div>
			</form>
		</div>
		<div class="data-table table-striped" style="width:60%;">
		<table>
			<thead>
				<tr>
					<th>ID</th>
					<th>名称</th>
					<th>类型</th>
                    <th>创建者</th>
                    <th>创建时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
				<?php if(!empty($live)): if(is_array($live)): $i = 0; $__LIST__ = $live;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$live): $mod = ($i % 2 );++$i;?><tr>
						<td><?php echo ($live["live_id"]); ?></td>
						<td class="td-lesson01">
                            <div class="limit-cur" style=""><?php echo ($live["live_title"]); ?></div>
                            <div class="limit-all" style="display: none;position: absolute;background: rgba(78,78,78,.9);z-index: 9;border: 1px solid #eee;padding: 3px 5px;border-radius: 4px;color: #fff;font-size: 12px;"><p><?php echo ($live["sub_title"]); ?><p/></div>
                        </td>
						<td>
							<?php if($live['live_type'] == 1): ?>直播
							<?php else: ?>
								录播<?php endif; ?>
						</td>
						<td><?php echo ($live["username"]); ?></td>
                        <td><?php echo (substr($live["sc_time"],0,10)); ?></td>
						<td>
							<a class="confirm ajax-get" title="删除" href="<?php echo U('del_live?id='.$live['sc_id']);?>">删除</a>
						</td>
					</tr><?php endforeach; endif; else: echo "" ;endif; ?>
				<?php else: ?>
				<td colspan="6" class="text-center"> aOh! 暂时还没有内容! </td><?php endif; ?>
			</tbody>
		</table>
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
		//导航高亮
		highlight_subnav('<?php echo U('Playlive1/index');?>');
	</script>
	<script src="/adminmanager/Public/Admin/json/datas.js"></script>
	<script language="javascript">
	//<!--
	var $$ = function (id) {
	    return "string" == typeof id ? document.getElementById(id) : id;
	}
	var Bind = function(object, fun) {
	    return function() {
	        return fun.apply(object, arguments);
	    }
	}
	function AutoComplete(obj,autoObj,arr){
	    this.obj=$$(obj);        //输入框
	    this.autoObj=$$(autoObj);//DIV的根节点
	    this.value_arr=arr;        //不要包含重复值
	    this.index=-1;          //当前选中的DIV的索引
	    this.search_value="";   //保存当前搜索的字符
	}
	AutoComplete.prototype={
	    //初始化DIV的位置
	    init: function(){
	        this.autoObj.style.left = this.obj.offsetLeft + "px";
	        this.autoObj.style.top  = this.obj.offsetTop + this.obj.offsetHeight + "px";
	        this.autoObj.style.width= this.obj.offsetWidth - 2 + "px";//减去边框的长度2px
	    },
	    //删除自动完成需要的所有DIV
	    deleteDIV: function(){
	        while(this.autoObj.hasChildNodes()){
	            this.autoObj.removeChild(this.autoObj.firstChild);
	        }
	        this.autoObj.className="auto_hidden";
	    },
	    //设置值
	    setValue: function(_this){
	        return function(){
	            _this.obj.value=this.seq;
	            _this.autoObj.className="auto_hidden";
	        }
	    },
	    //模拟鼠标移动至DIV时，DIV高亮
	    autoOnmouseover: function(_this,_div_index){
	        return function(){
	            _this.index=_div_index;
	            var length = _this.autoObj.children.length;
	            for(var j=0;j<length;j++){
	                if(j!=_this.index ){
	                    _this.autoObj.childNodes[j].className='auto_onmouseout';
	                }else{
	                    _this.autoObj.childNodes[j].className='auto_onmouseover';
	                }
	            }
	        }
	    },
	    //更改classname
	    changeClassname: function(length){
	        for(var i=0;i<length;i++){
	            if(i!=this.index ){
	                this.autoObj.childNodes[i].className='auto_onmouseout';
	            }else{
	                this.autoObj.childNodes[i].className='auto_onmouseover';
	                this.obj.value=this.autoObj.childNodes[i].seq;
	            }
	        }
	    }
	    ,
	    //响应键盘
	    pressKey: function(event){
	        var length = this.autoObj.children.length;
	        //光标键"↓"
	        if(event.keyCode==40){
	            ++this.index;
	            if(this.index>length){
	                this.index=0;
	            }else if(this.index==length){
	                this.obj.value=this.search_value;
	            }
	            this.changeClassname(length);
	        }
	        //光标键"↑"
	        else if(event.keyCode==38){
	            this.index--;
	            if(this.index<-1){
	                this.index=length - 1;
	            }else if(this.index==-1){
	                this.obj.value=this.search_value;
	            }
	            this.changeClassname(length);
	        }
	        //回车键
	        else if(event.keyCode==13){
	            this.autoObj.className="auto_hidden";
	            this.index=-1;
	        }else{
	            this.index=-1;
	        }
	    },
    //程序入口
    start: function(event){
        if(event.keyCode!=13&&event.keyCode!=38&&event.keyCode!=40){
            this.init();
            this.deleteDIV();
            this.search_value=this.obj.value;
            var valueArr=this.value_arr;
            if(this.obj.value.replace(/(^\s*)|(\s*$)/g,'') == ""){ return; }//值为空，退出
            try{ var reg = new RegExp("(" + this.obj.value + ")","i");}
            catch (e){ return; }
            var div_index=0;//记录创建的DIV的索引
            for(var i = 0; i < valueArr.length; i++){
                if( reg.test(valueArr[i].live_title) ){
                    var div = document.createElement("div");
                    div.className="auto_onmouseout";
                    div.seq=valueArr[i].live_title;
                    div.onclick=this.setValue(this);
                    div.onmouseover=this.autoOnmouseover(this,div_index);
                    div.innerHTML=valueArr[i].live_title.replace(reg,"<strong>$1</strong>");//搜索到的字符粗体显示
                    this.autoObj.appendChild(div);
                    this.autoObj.className="auto_show";
                    div_index++;

                }
                if(div_index > 4) return;
            }
        }
        this.pressKey(event);
        window.onresize=Bind(this,function(){this.init();});
    }
}
//-->
</script>
<script>
	var autoComplete;
	$('#live_type').on('change', function(){
		if($(this).val() == '2')
		    autoComplete = new AutoComplete('o','auto', video);
		else if($(this).val() == '1')
		    autoComplete = new AutoComplete('o','auto', live);

	})
	autoComplete = new AutoComplete('o','auto', live);
	!(function($){
        $('.td-lesson01, .td-lesson02').on('mouseenter', function(e) {
            if($(this).children('.limit-cur').text().length > 15) {
                $(this).children('.limit-all').stop().show('fast');
            }
        }).on('mouseleave', function(e) {
            $(this).children('.limit-all').stop().hide('fast');
        });
    })(jQuery);
</script>

</body>
</html>