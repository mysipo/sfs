$(function() {
	
	$(".js_changevoPPT").click(function(){
		// console.log($(".zhibo .area .video").attr("ownerid"));
		// console.log($(".zhibo .area .video").attr("authcode"));
		//判断是否是视屏在显示
		// console.log($(".zhibo .area .video .r > div").hasClass("videoDiv"));

		// if($(".zhibo .area .video .r > div").hasClass("videoDiv")){
		// 	//右边显示区域中，remove视频显示
		// 	$(".zhibo .area .video .r .videoDiv").remove();
		// 	//右边显示区域，appendPPT显示
		// 	$(".zhibo .area .video .r").append('<div class="docDiv"><!-- Doc Widget --><gs:doc class="PPTview" site="ccmtvbj.gensee.com" ctx="training" ownerid="'+$(".zhibo .area .video").attr("ownerid")+'" /></div>')
		// 	//左边小窗口切换显示
		// 	$(".zhibo .area .video .l .lt .docDiv").remove();
		// 	$(".zhibo .area .video .l .lt").append('<div class="videoDiv"><!-- Video Widget --><gs:video-live class="vedioview" site="ccmtvbj.gensee.com" ctx="training" ownerid="'+$(".zhibo .area .video").attr("ownerid")+'" authcode="'+$(".zhibo .area .video").attr("authcode")+'" name="jianyi"/></div>');
		// }else{
		// 	//右边显示区域中，removePPT显示
		// 	$(".zhibo .area .video .r .docDiv").remove();
		// 	//右边显示区域，append视频显示
		// 	$(".zhibo .area .video .r").append('<div class="videoDiv"><!-- Video Widget --><gs:video-live class="vedioview" site="ccmtvbj.gensee.com" ctx="training" ownerid="'+$(".zhibo .area .video").attr("ownerid")+'" authcode="'+$(".zhibo .area .video").attr("authcode")+'" name="jianyi"/></div>');

		// 	//左边小窗口切换显示
		// 	$(".zhibo .area .video .l .lt .videoDiv").remove();
		// 	$(".zhibo .area .video .l .lt").append('<div class="docDiv"><!-- Doc Widget --><gs:doc class="PPTview" site="ccmtvbj.gensee.com" ctx="training" ownerid="'+$(".zhibo .area .video").attr("ownerid")+'" /></div>')
		// }
        $(".zhibo .area .video .r .videoDiv").toggle();
        $("..zhibo .area .video .r .docDiv").toggle();
        $(".zhibo .area .video .l .lt .videoDiv").toggle();
        $(".zhibo .area .video .l .lt .docDiv").toggle();
    })

	/*录播信息提交页面*/
	$(".area .dc_center .lubo_shenqing").click(function(){
		var flag=true;
		$(".area .dc_center .lubo_info .lb_right .lbcourse_title").siblings("span").find("img").hide();
		$(".area .dc_center .lubo_info .lb_right .lbcourse_title").siblings("span").find("em").html("");
		$(".area .dc_center .lubo_info .lb_right textarea").siblings("span").find("img").hide();
		$(".area .dc_center .lubo_info .lb_right textarea").siblings("span").find("em").html("");
		$(this).siblings("span").find("img").hide();
		$(this).siblings("span").find("em").html("");
		//判断题目是否有选择
		$(".area .dc_center .lubo_info .lb_right .lbcourse_title :selected").each(function(){
			var str=$(this).text();
			if(str=="请选择讲课题目"){
				$(".area .dc_center .lubo_info .lb_right .lbcourse_title").siblings("span").find("img").show();
				$(".area .dc_center .lubo_info .lb_right .lbcourse_title").siblings("span").find("em").html("讲课题目不能为空");
				var flag=false;
			}
		})

		if($(".area .dc_center .lubo_info .lb_right .lbcourse_title").val()==""){
			
		}
		//判断课程简介是否为空
		if($(".area .dc_center .lubo_info .lb_right textarea").val()==""){
			$(".area .dc_center .lubo_info .lb_right textarea").siblings("span").find("img").show();
			$(".area .dc_center .lubo_info .lb_right textarea").siblings("span").find("em").html("课程简介不能为空");
			var flag=false;
		}
		if($(".area .dc_center .lubo_action .check_box").attr("checked")!="checked"){
			$(this).siblings("span").find("img").show();
			$(this).siblings("span").find("em").html("您还未同意讲者聘任电子协议");
			var flag=false;
		}
		if(flag){
			//提交信息。。。

		}
	})
	/*医生个人主页--直播--点预约*/
	$(".js_dc_yuyue").live("click",function(){
		$(".dialog-overlay").show();
		$(".dialog-overlay").css({
			"height": $("body").height()
		});
		$(".dc_clickyuyue").show();
		var scrollTop = document.body.scrollTop === 0 ? document.documentElement.scrollTop : document.body.scrollTop;
		$(".dc_clickyuyue").css({"left":($(window).width()-$(".dc_clickyuyue").width())/2});
		$(".dc_clickyuyue").css({"top":($(window).height()-$(".dc_clickyuyue").height())/2+scrollTop});
	})
	$(".dc_clickyuyue .guanbi").live("click",function(){
		$(".dialog-overlay").hide();
		$(".dc_clickyuyue").hide();
	})
	$(".dc_clickyuyue textarea").focus(function(){
		var text="您有什么问题要咨询医生，可在这里提交，直播时我们会请医生与您沟通。";
		if($(this).text()==text){
			$(this).text("");
		}
	})
	$(".dc_clickyuyue textarea").blur(function(){
		var text="您有什么问题要咨询医生，可在这里提交，直播时我们会请医生与您沟通。";
		if($(this).text()==""){
			$(this).text(text);
		}
	})

	/*医生个人中心--我的课程--录播直播切换效果*/
	$(".js_kc_tip em").live("click",function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		if($(this).index()==0){
			$(".js_kc_lubo").show();
			$(".js_kc_zhibo").hide();
		}else{
			$(".js_kc_lubo").hide();
			$(".js_kc_zhibo").show();
		}
	})
	/*助教个人中心*/
	$(".area .zj_center .title ul li").click(function(){
		$(this).addClass("cur").siblings().removeClass("cur");
		if($(this).index()==0){
			$(".js_zhujiao_kc").show();
			$(".js_zhujiao_inf").hide();
			$(".area .zj_center .kc").show();
			$("..zj_center .mymsg").hide()
		}else if($(this).index()==1){
			$(".area .zj_center .kc").hide();
			$(".js_zhujiao_kc").hide();
			$(".js_zhujiao_inf").show();
			$("..zj_center .mymsg").hide()

		}else{
			$(".area .zj_center .kc").hide();
			$(".js_zhujiao_kc").hide();
			$(".js_zhujiao_inf").hide();
			$("..zj_center .mymsg").show()

		}

	})
	/*录播页面*/
	$(".bofang .area .con .doctor .bg p").click(function(){
		$(this).css({"background":"#323337","height":"51px"});
		$(this).siblings().css({"background":"#292b2e","height":"46px"});
		if($(this).index()==0){
			$(".bofang .area .con .doctor .more").show();
			$(".bofang .area .con .doctor .dc_say").hide();
		}else{
			$(".bofang .area .con .doctor .more").hide();
			$(".bofang .area .con .doctor .dc_say").show();
		}
	})
	/*点击评分显示评分等级选项*/
	$(".bofang .area .tel img").click(function(){
		$(".lb_code .give_code").toggle();
	})
	/*点击评分等级后效果*/
	$(".lb_code .give_code img").live("click",function(){
		$(this).parent().parent().hide();
	})

	/*首页专场切换*/
	var flag = 0;
	$(".js_move").hover(function() {
		$(".js_action").show();
	})
	/*按钮点击切换*/
	$(".js_action").live("click", function() {
		if (!$(".js_zc_view").is(":animated")) {
			//状态栏切换
			if (flag == ($(".js_change ul li").length - 1)) {
				flag = 0;
			} else {
				flag = flag + 1;
			}
			$('.js_change ul li').removeClass('cur').html("●");
			$('.js_change ul li:eq(' + flag + ')').addClass('cur').html("○");
			//专场切换效果
			var addfirstdiv = $(".zc_view div:first").clone();
			$(".js_zc_view").append(addfirstdiv);
			$(".js_zc_view").animate({
				marginLeft: "-500px"
			}, 1000, function() {
				$(".js_zc_view div:first").remove();
				$(".js_zc_view").css({
					marginLeft: '0px'
				})
			});
		}

	})

	/*首页专场状态点击焦点图切换效果-----备注：未完成*/
	// $(".js_change ul li").click(function(){
	// 	$(this).html("○").addClass("cur").siblings().html("●").removeClass("cur");
	// 	if(($(this).index())!=($(".js_change ul li").length-1)){
	// 		var ds=$(this).index()*500*(-1);
	// 			ds=ds+"px";
	// 			if(!$(".js_zc_view").is(":animated")){
	// 				$(".js_zc_view").animate({left:ds},500);
	// 			}
	// 	}else{
	// 		var ds=($(this).index()-1)*500*(-1);
	// 			ds=ds+"px";
	// 			if(!$(".js_zc_view").is(":animated")){
	// 				$(".js_zc_view").animate({left:ds},500);
	// 			}

	// 	}
	// })

	/*首页点击*/
	// <div class="dialog-overlay" style="width: 100%; height: 34523px; opacity: 0.5; position: absolute; overflow: hidden; left: 0px; top: 0px; z-index: 100002; background: rgb(0, 0, 0);"></div>
	/*首页医生点击预约开课*/
	
	$(".js_sy_doctor,.sy_login .area .doc_suc button").live("click",function() {
		$(".dialog-overlay").show();
		$(".dialog-overlay").css({
			"height": $("body").height()
		});
		$(".dc_dialog").show();
		var scrollTop = document.body.scrollTop === 0 ? document.documentElement.scrollTop : document.body.scrollTop;
		$(".dc_dialog").css({"left":($(window).width()-$(".dc_dialog").width())/2});
		$(".dc_dialog").css({"top":($(window).height()-$(".dc_dialog").height())/2+scrollTop});
	})
	$(".dc_dialog input").focus(function(){
		if($(this).val()=="开新课，请输入邀请码"){
			$(this).val("");
		}
	})
	$(".dc_dialog input").blur(function(){
		if($(this).val()==""){
			$(this).val("开新课，请输入邀请码");
		}
	})
	/*医生点击专题名称*/
	$(".dc_dialog .courses .title").live("click",function(){
		$("#code_id").val($(this).attr('code'));
		$("#project_id").val($(this).attr('val'));
		$(".dc_dialog").hide();
		$(".dc_coursedg").show();
		var scrollTop = document.body.scrollTop === 0 ? document.documentElement.scrollTop : document.body.scrollTop;
		$(".dc_coursedg").css({"left":($(window).width()-$(".dc_coursedg").width())/2});
		$(".dc_coursedg").css({"top":($(window).height()-$(".dc_coursedg").height())/2+scrollTop});
	})


	
	/*点击上一步*/
	$(".dc_coursedg .up").live("click",function(){
		$(".dc_coursedg").hide();
		$(".dc_dialog").show();
		return false;
	})
	/*预约开课*/
	$(".js_yuyue").click(function(){
		$(".dialog-overlay").show();
		$(".dialog-overlay").css({
			"height": $("body").height()
		});
		$(".dc_courseyuyue").show();
		var scrollTop = document.body.scrollTop === 0 ? document.documentElement.scrollTop : document.body.scrollTop;
		$(".dc_courseyuyue").css({"left":($(window).width()-$(".dc_courseyuyue").width())/2});
		$(".dc_courseyuyue").css({"top":($(window).height()-$(".dc_courseyuyue").height())/2+scrollTop});

	})
	/*患者点击快速找医生*/
	$(".js_sy_patient").click(function() {
		$(".dialog-overlay").show();
		$(".dialog-overlay").css({
			"height": $("body").height()
		});
		$(".pt_dialog").show();
		var scrollTop = document.body.scrollTop === 0 ? document.documentElement.scrollTop : document.body.scrollTop;
		$(".pt_dialog").css({"left":($(window).width()-$(".pt_dialog").width())/2});
		$(".pt_dialog").css({"top":($(window).height()-$(".pt_dialog").height())/2+scrollTop});
	})

	/*对话框关闭按钮*/
	$(".js_syclose").live("click", function() {
		$(this).parent().parent().hide();
		$(".dialog-overlay").hide();
	})
	/*登陆页面点击 忘记密码*/
	$(".js_seekpwd").live("click",function(){
		$(".sy_login .area .login").hide();
		$(".sy_login .area .seekpwd").show();
		$(".sy_login .area .seekpwd .err img").hide();
		$(".sy_login .area .seekpwd .err span").html("");
	})
	/*首页找回密码*/
	//点击返回按钮
	$(".seekpwd .title .js_seekback").live("click",function(){
		$(".sy_login .area .seekpwd").hide();
		$(".sy_login .area .login").show();
		$(".js_seek_phone").val("请输入您的手机号");	
		$(".js_seekcode").val("请输入您的验证码");	
		$(".js_seeknewpwd").show();
		$(".js_seeknewpwd1").hide();
	})
	//手机号码输入框获取焦点失去焦点事件
	$(".js_seek_phone").live("focus",function(){
		if($(this).val()=="请输入您的手机号"){
			$(this).val("");
		}
	})
	$(".js_seek_phone").live("blur",function(){
		$(".sy_login .area .seekpwd .phoneerr img").hide();
		$(".sy_login .area .seekpwd .phoneerr span").html("");
		if($(this).val()==""){
			$(this).val("请输入您的手机号");
			$(".sy_login .area .seekpwd .phoneerr img").show();
			$(".sy_login .area .seekpwd .phoneerr span").html("手机号不能为空");
		}else{
			var phone = $(this).val();
			var re_phone = /^1\d{10}$/;
			if (!re_phone.test(phone)) {
				$(".sy_login .area .seekpwd .phoneerr img").show();
				$(".sy_login .area .seekpwd .phoneerr span").html("请输入正确的手机号");
			}else{
				$(".regright .phone span .dui").show();
			}
		}
	})
	//验证码输入框获取焦点失去焦点事件
	$(".js_seekcode").live("focus",function(){
		if($(this).val()=="请输入您的验证码"){
			$(this).val("");
		}
	})
	$(".js_seekcode").live("blur",function(){
		$(".sy_login .area .seekpwd .codeerr img").hide();
		$(".sy_login .area .seekpwd .codeerr span").html("");
		if($(this).val()==""){
			$(this).val("请输入您的验证码");
			$(".sy_login .area .seekpwd .codeerr img").show();
			$(".sy_login .area .seekpwd .codeerr span").html("验证码不能为空");
		}else{
			//验证码不正确
			if(false){
				$(".sy_login .area .seekpwd .codeerr img").show();
				$(".sy_login .area .seekpwd .codeerr span").html("验证码不正确");
			}
		}
	})
	//新密码验证
	$(".js_seeknewpwd").live("focus",function(){
		$(this).hide();
		$(".newpwd1").show();
		$(".newpwd1").val("");
		$(".newpwd1").trigger("focus");
	})
	$(".js_seeknewpwd1").live("blur",function(){
		$(".sy_login .area .seekpwd .newpwderr img").hide();
		$(".sy_login .area .seekpwd .newpwderr span").html("");
		if($(this).val()==""){
			$(this).hide();
			$(".js_seeknewpwd").show();
			$(".sy_login .area .seekpwd .newpwderr img").show();
			$(".sy_login .area .seekpwd .newpwderr span").html("新密码不能为空");
		}else{
			var name = $(this).val();
			var re_name=/[\u4e00-\u9fa5a-zA-Z0-9\-]{8,16}/;
			if (!re_name.test(name)) {
				$(".sy_login .area .seekpwd .newpwderr img").show();
				$(".sy_login .area .seekpwd .newpwderr span").html("密码格式错误,请输入8-16位，可由字母、数字组成的密码");
			}
		}
	})

	//找回密码点击确定按钮
	$(".sy_login .area .seekpwd .js_makeup").live("click",function(){
		$(".js_seek_phone").trigger("blur");
		$(".js_seekcode").trigger("blur");
		$(".js_seeknewpwd1").trigger("blur");
	})

	/*登陆页面*/
	$(".js_login_shenfen li").live("click",function() {
		$(".js_set_newpwd_err").html("");
		$(".js_name_err").html("");
		$(".js_pwd_err").html("");
		$(".js_jihuocode_err").html("");
		$(".sy_login .area .login ol li .err img").hide();
		$(this).addClass("cur").siblings().removeClass("cur");
		if ($(this).index() == 2) {
			$(".sy_login .area .login ol li.lastli .js_huanzheauto").hide();
			$("ol li:first-child").find("label").html("手机号");
			$("ol li:first-child").find("input").val("请输入手机号");
			$("ol li:first-child").find("input").addClass("js_zhujiao")
			$("#s_id").val('3');
			$(".pwd .jihuo").show();

		}else{
			if($(this).index()==0){
				$(".sy_login .area .login ol li.lastli .js_huanzheauto").hide();
				$("#s_id").val('1');
			}else if($(this).index()==1){
				$("#s_id").val('2');
				$(".sy_login .area .login ol li.lastli .js_huanzheauto").show();
			}
			$("ol li:first-child").find("label").html("账号");
			$("ol li:first-child").find("input").val("请输入手机号或用户名");
			$(".pwd").show();
			$(".pwd .jihuo").hide();
			$(".jihuocode").hide();
			$(".new_pwd").hide();

		}
		$(".js_pwd1").val("").hide();
		$(".js_pwd").show();
	})
	var index=0;
	$(".js_jihuo em").live("click",function() {
		if ($(this).index() == 0) {
			$(".js_code").val("请输入您的激活码");
			$(".set_newpwd").val("请设置您的登陆密码");
			index=0;
			$(".pwd").show();
			$(".jihuocode").hide();
			$(".pwd .jihuo").find("em").eq(0).addClass("cur").siblings().removeClass("cur");
			$(".new_pwd").hide();
			$(".js_set_newpwd_err").html("");
		} else {
			$(".js_pwd").show();
			$(".js_pwd1").val("").hide();
			$(".js_pwd_err").html("");
			$(".js_jihuocode_err").html("");
			index=1;
			$(".pwd").hide();
			$(".jihuocode").show();
			$(".jihuocode .jihuo").show();
			$(".new_pwd").show();
			

		}
	})
	//助教----未激活状态---设置密码输入框
	$(".set_newpwd").live("focus",function() {
		if ($(this).val() == "请设置您的登陆密码") {
			$(this).val(""); //获取焦点文字消失
		}
	})
	$(".set_newpwd").live("blur",function() {
		if ($(this).val() == "") {
			$(this).val("请设置您的登陆密码");
		}
	})


	/*用户名输入框获取焦点、失去焦点事件*/
	$(".js_name").focus(function() {
		if ($(this).val() == "请输入手机号或用户名") {
			$(this).val(""); //获取焦点文字消失
		}
	})
	$(".js_name").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入手机号或用户名");
		}
	})
	//助教手机号输入框获取焦点失去焦点事件
	$(".js_zhujiao").live("focus",function() {
		if ($(this).val() == "请输入手机号") {
			$(this).val(""); //获取焦点文字消失
		}
	})
	$(".js_zhujiao").live("blur",function() {
		if ($(this).val() == "") {
			$(this).val("请输入手机号");
		}
	})

	/*激活码输入框获取焦点失去焦点事件*/
	$(".js_code").focus(function() {
		if ($(this).val() == "请输入您的激活码") {
			$(this).val(""); //获取焦点文字消失
		}
	})
	$(".js_code").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入您的激活码");
		}
	})

	/*密码输入框获取焦点失去、焦点事件*/
	$(".js_pwd").focus(function() {
		$(this).hide();
		$(".js_pwd1").show();
		$(".js_pwd1").trigger("focus");
	})
	$(".js_pwd1").blur(function() {
		if ($(this).val() == "") {
			$(this).hide();
			$(".js_pwd").show();
		}
	})

	/*点击登录对输入框作非空判断*/
	$(".js_login").click(function() {
		$(".js_name_err").html("");
		$(".js_pwd_err").html("");
		$(".js_jihuocode_err").html("");
		$(".js_set_newpwd_err").html("");
		$(".sy_login .area .login ol li .err img").hide();
		var dd = 0;
		if($("#s_id").val()!=3){
			if (($(".js_name").val() == "请输入手机号或用户名")) {

				$(".js_name_err").html("用户名不能为空");
				$(".sy_login .area .login ol .name .err img").show();
				var dd = 1;
			}
			if ($(".js_pwd").is(":visible")) {
				$(".js_pwd_err").html("密码不能为空");
				$(".sy_login .area .login ol .pwd .err img").show();
				var dd = 2;
			}
		}else{
			if($(".js_name").val()=="请输入手机号"){
				$(".js_name_err").html("手机号不能为空");
				$(".sy_login .area .login ol .name .err img").show();
				var dd = 3;
			}
			if(index==0){
				if($(".js_pwd").is(":visible")){
					$(".js_pwd_err").html("密码不能为空");
					$(".sy_login .area .login ol .pwd .err img").show();
					var dd = 4;
				}
			}else{
				if ($(".js_code").val() == "请输入您的激活码") {
					$(".sy_login .area .login ol .jihuocode .err img").show();
					$(".js_jihuocode_err").html("激活码不能为空");
					var dd = 5;
				}
				if($(".set_newpwd").val() =="请设置您的登陆密码") {
					$(".js_set_newpwd_err").html("登陆密码不能为空");
					$(".sy_login .area .login ol .new_pwd .err img").show();
				}
			}
		}
		if(dd == 0){
			login();
		}
	})

	/*注册页面*/
	$(".js_zhuce_shenfen li").live("click", function() {
		$(".js_zc_phoneerr").html("");
		$(".js_zc_pwderr").html("");
		$(".js_zc_compwderr").html("");
		$(".js_codeerr").html("");
		$(".js_zc_code").html("");
		$(".js_zc_rname").html("");
		$(".zhuce_box .zhuce_dia ol li .err img").hide();
		$(this).addClass("cur").siblings().removeClass("cur");
		if ($(this).html() == "医生") {
			$(".js_doctor").css({
				"display": "block"
			});
			$(".js_huanzhe").css({
				"display": "none"
			});
		} else {
			$(".js_doctor").css({
				"display": "none"
			});
			$(".js_huanzhe").css({
				"display": "block"
			});
		}
	})
	/*医生邀请码输入框获取焦点失去焦点事件*/
	$(".js_zhuce_code").focus(function() {
		if ($(this).val() == "请输入邀请码") {
			$(this).val("");
		}
	})
	$(".js_zhuce_code").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入邀请码");
		}
	})
	/*患者验证码输入框获取焦点失去焦点事件*/
	$(".js_zhuce_yzcode").focus(function() {
		if ($(this).val() == "请输入短信验证码") {
			$(this).val("");
		}
	})
	$(".js_zhuce_yzcode").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入短信验证码");
		}
	})
	/*医生姓名输入框获取焦点失去焦点事件*/
	$(".js_zhuce_rname").focus(function() {
		if ($(this).val() == "请输入医生真实姓名") {
			$(this).val("");
		}
	})
	$(".js_zhuce_rname").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入医生真实姓名");
		}
	})


	/*手机号输入框获取焦点失去焦点事件*/
	$(".js_zhuce_phone").focus(function() {
		if ($(this).val() == "请输入手机号") {
			$(this).val("");
		}
	})
	$(".js_zhuce_phone").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入手机号");
		}
	})
	/*密码输入框获取焦点、失去焦点事件*/
	$(".js_zhuce_pwd").focus(function() {
		$(this).hide();
		$(".js_zhuce_pwd1").show();
		$(".js_zhuce_pwd1").trigger("focus");
	})
	$(".js_zhuce_pwd1").blur(function() {
		if ($(this).val() == "") {
			$(this).hide();
			$(".js_zhuce_pwd").show();
		}
	})
	/*确认密码输入框获取焦点失去焦点事件*/
	$(".js_zhuce_compwd").focus(function() {
		$(this).hide();
		$(".js_zhuce_compwd1").show();
		$(".js_zhuce_compwd1").trigger("focus");

	})
	$(".js_zhuce_compwd1").blur(function() {
		if ($(this).val() == "") {
			$(this).hide();
			$(".js_zhuce_compwd").show();
		}
	})
	/*验证码获取焦点失去焦点事件*/
	$(".js_zhuce_yanzhengcode").focus(function() {
		if ($(this).val() == "请输入短信验证码") {
			$(this).val("");
		}
	})
	$(".js_zhuce_yanzhengcode").blur(function() {
		if ($(this).val() == "") {
			$(this).val("请输入短信验证码");
		}
	})

	/*医生注册第一页：点击下一步判断输入框*/
	$(".js_zhuce").click(function() {
		$(".js_zc_phoneerr").html('');
		$(".js_zc_pwderr").html('');
		$(".js_zc_compwderr").html('');
		$(".js_codeerr").html('');
		$(".js_zc_code").html('');
		$(".js_zc_rname").html('');
		$(".zhuce_box .zhuce_dia ol li .err img").hide();

		//邀请码验证
		if ($(".js_zhuce_code").val() == "请输入邀请码") {
			$(".js_zc_code").html('邀请码不能为空');
			$(".zhuce_box .zhuce_dia ol .yq_code .err img").show();
		}

		//真实姓名验证
		var re_rname = /^\s*[\u4e00-\u9fa5]{1,15}\s*$/; //汉字正则
		var re_rpinyin = /^[a-z]+[a-z]+$/; //拼音正则 
		var rname = $(".js_zhuce_rname").val();

		var flag = (!re_rpinyin.test(rname)) & (!re_rname.test(rname));
		if ($(".js_zhuce_rname").val() == "请输入医生真实姓名") {
			$(".zhuce_box .zhuce_dia ol .doctor .err img").show();
			$(".js_zc_rname").html('真实姓名不能为空');
		} else {
			if (flag) {
				$(".js_zc_rname").html('姓名中含非法字符，请重试！');
				$(".zhuce_box .zhuce_dia ol .doctor .err img").show();
			}
		}
		/*==================患者注册验证---患者无需注册，暂不需要==================*/
		// //手机号码验证
		// var phone = $(".js_zhuce_phone").val();
		// var re_phone = /^1\d{10}$/;
		// if (phone == "请输入手机号") {
		// 	$(".js_zc_phoneerr").html('手机号码不能为空');
		// 	$(".zhuce_box .zhuce_dia .huanzhe li:first .err img").show();

		// } else {
		// 	if (!re_phone.test(phone)) {
		// 		$(".js_zc_phoneerr").html('无效的手机格式');
		// 		$(".zhuce_box .zhuce_dia .huanzhe li:first .err img").show();
		// 	}
		// }
		// //密码验证
		// var pwd = $(".js_zhuce_pwd1").val();
		// var re_pwd = /^[a-z0-9_-]{8,16}$/;
		// if ($(".js_zhuce_pwd").is(":visible")) {
		// 	$(".js_zc_pwderr").html('密码不能为空');
		// 	$(".zhuce_box .zhuce_dia .huanzhe .pwd .err img").show();
		// } else {
		// 	if (!re_pwd.test(pwd)) {
		// 		$(".js_zc_pwderr").html('无效的密码格式');
		// 		$(".zhuce_box .zhuce_dia .huanzhe .pwd .err img").show();
		// 	}
		// }
		// //确认密码验证
		// if ($(".js_zhuce_compwd").is(":visible")) {
		// 	$(".js_zc_compwderr").html('确认密码不能为空');
		// 	$(".zhuce_box .zhuce_dia .huanzhe .compwd .err img").show();

		// } else {
		// 	if (!($(".js_zhuce_pwd1").val() == $(".js_zhuce_compwd1").val())) {
		// 		$(".js_zc_compwderr").html('两次输入密码不一致');
		// 		$(".zhuce_box .zhuce_dia .huanzhe .compwd .err img").show();
		// 	}

		// }
		// /*验证码验证*/
		// if ($(".js_zhuce_yanzhengcode").val() == "请输入短信验证码") {
		// 	$(".js_codeerr").html('验证码不能为空');
		// 	$(".zhuce_box .zhuce_dia .huanzhe .ma .err img").show();
		// } else {
		// 	//判断验证码是都正确
		// }
	})

	/*患者注册2---=========患者不需要注册，此部分暂时不用=============*/
	// $(".js_hzzc_nick").focus(function() {
	// 	if ($(this).val() == "请输入用户名") {
	// 		$(this).val("");
	// 	}
	// })
	// $(".js_hzzc_nick").blur(function() {
	// 	if ($(this).val() == "") {
	// 		$(this).val("请输入用户名");
	// 	}
	// })

	// $(".js_hzzc_name").focus(function() {
	// 	if ($(this).val() == "请输入姓名") {
	// 		$(this).val("");
	// 	}
	// })
	// $(".js_hzzc_name").blur(function() {
	// 	if ($(this).val() == "") {
	// 		$(this).val("请输入姓名");
	// 	}
	// })
/*==============================医生注册2===============================================================================*/
	var click=true;
	$(".js_fb").focus(function() {
		if ($(this).val() == $(this).attr("val")) {
			$(this).val("");
		}
	})
	$(".js_fb").blur(function() {
		if ($(this).val() == "") {
			$(this).val($(this).attr("val"));
		}
	})
	var text = "擅长疾病建议不少于十个字，尽量精确到病名。例如:擅长血栓闭塞性脉管炎、动脉硬化闭塞症、脑梗后遗症、糖尿并发症、血管炎、淋巴管炎等周围血管病。"
	$(".js_textarea").focus(function() {
		if ($(this).val() == text) {
			$(this).val("");
		}
	})
	//研究领域判断
	$(".js_textarea").blur(function() {
		$(".regright .yanjiulingyu span .dui").hide();
		$(".regright .yanjiulingyu span .cuo").hide();
		$(".regright .yanjiulingyu span em").html("");
		if ($(this).val() == "") {
			$(this).val(text);
		}
		var text="擅长疾病建议不少于十个字，尽量精确到病名。例如:擅长血栓闭塞性脉管炎、动脉硬化闭塞症、脑梗后遗症、糖尿并发症、血管炎、淋巴管炎等周围血管病。"
		if(($(".regright .yanjiulingyu textarea").val()==text)||($(".regright .yanjiulingyu textarea").val()=="")){
			$(".regright .yanjiulingyu span .cuo").show();
			$(".regright .yanjiulingyu span em").html("内容不能为空");
			click=false;
		}else{
			$(".regright .yanjiulingyu span .dui").show();
			
		}
	})
	//判断手机号码
	$(".regright .phone input").blur(function() {
		$(".regright .phone span .cuo").hide();
		$(".regright .phone span .dui").hide();
		$(".regright .phone span em").html("");

		if(($(".regright .phone input").val()=="请输入手机号")||($(".regright .phone input").val()=="")){
			$(".regright .phone span .cuo").show();
			$(".regright .phone span em").html("手机号不能为空");
			click=false;
		}else{
			//手机号码正则验证
			var phone = $(".regright .phone input").val();
			var re_phone = /^1\d{10}$/;
			if (!re_phone.test(phone)) {
				$(".regright .phone span .cuo").show();
				$(".regright .phone span em").html("请输入正确的手机号");
				click=false;
			}else{
				$(".regright .phone span .dui").show();
			}
		}

	})
	//判断验证码
	$(".regright .yanzhengcode input").blur(function() {
		$(".regright .yanzhengcode em").html("");
		$(".regright .yanzhengcode span img").hide();
		if(($(".regright .yanzhengcode input").val()=="请输入验证码")||($(".regright .yanzhengcode input").val()=="")){
			$(".regright .yanzhengcode span .cuo").show();
			$(".regright .yanzhengcode span em").html("验证码不能为空");
			click=false;
		}else{
			$(".regright .yanzhengcode span .dui").show();

		}
	})
	//判断科室
	$("#.regright .dc_keshi .keshi").change(function(){
		$(".regright .dc_keshi span .cuo").hide();
		$(".regright .dc_keshi span .dui").hide();
		$(".regright .dc_keshi span em").html("");
		$(".regright .dc_keshi select :selected").each(function(){
			var str=$(this).text();
			if(str=="请选择科室类别"){
				console.log(1)
				$(".regright .dc_keshi span .cuo").show();
				$(".regright .dc_keshi span em").html("请选择科室");
				click=false;
			}
		})	
	});
	$("#.regright .dc_keshi .keshi1").change(function(){
		$(".regright .dc_keshi span .cuo").hide();
		$(".regright .dc_keshi span .dui").hide();
		$(".regright .dc_keshi span em").html("");
		$(".regright .dc_keshi select :selected").each(function(){
			var str=$(this).text();
			if(str=="请选择科室"){
				console.log(1)
				$(".regright .dc_keshi span .cuo").show();
				$(".regright .dc_keshi span em").html("请选择科室");
				click=false;
			}else{
				$(".regright .dc_keshi span .dui").show();
			}
		})	
	});	

	//判断所在城市
	$(".regright .didian #s_province").change(function(){
		$(".regright .didian span .dui").hide();
		$(".regright .didian #s_province :selected").each(function(){
			var str=$(this).text();
			if(str=="省份"){
				$(".regright .didian span .cuo").show();
				$(".regright .didian span em").html("请选择所在城市");
				click=false;
			}
		})
	});	
	$(".regright .didian #s_county").change(function(){
		$(".regright .didian span .cuo").hide();
		$(".regright .didian span .dui").hide();
		$(".regright .didian span em").html("");
		$(".regright .didian #s_county :selected").each(function(){
			var str=$(this).text();
			if(str=="市、县级市"){
				$(".regright .didian span .cuo").show();
				$(".regright .didian span em").html("请选择所在城市");
				click=false;
			}else{
				$(".regright .didian span .dui").show();
				$(".regright .didian span em").html("");
			}
		})

	});	
	//判断单位是否填写
	$(".regright .dc_danwei input").blur(function() {
		$(".regright .dc_danwei span .cuo").hide();
		$(".regright .dc_danwei span .dui").hide();
		$(".regright .dc_danwei span em").html("");
		if(($(".regright .dc_danwei input").val()=="请输入您的单位")||($(".regright .dc_danwei input").val()=="")){
			$(".regright .dc_danwei span .cuo").show();
			$(".regright .dc_danwei span em").html("请输入您的单位");
			click=false;
		}else{
			$(".regright .dc_danwei span .dui").show();

		}
	})
	
	//判断身份证号码
	$(".regright .shenfencode input").blur(function() {
		$(".regright .shenfencode span .cuo").hide();
		$(".regright .shenfencode span .dui").hide();
		$(".regright .shenfencode span em").html("");
		if(($(".regright .shenfencode input").val()=="请输入您的身份证号")||($(".regright .shenfencode input").val()=="")){
			$(".regright .shenfencode span .cuo").show();
			$(".regright .shenfencode em").html("");
			$(".regright .shenfencode span em").html("身份证号不能为空");
			click=false;
		}else{
			//身份证号码正则验证
			var shenfencode = $(".regright .shenfencode input").val();
			var re_shenfenzhengcode=/^\d{18}$|^\d{17}(\d|X|x)$/;
			if (!re_shenfenzhengcode.test(shenfencode)) {
				$(".regright .shenfencode span .cuo").show();
				$(".regright .shenfencode em").html("");
				$(".regright .shenfencode span em").html("请输入有效的身份证号码");
				click=false;
			}else{
				$(".regright .shenfencode span .dui").show();
				$(".regright .shenfencode em").html("");
			}
		}
		
	})
	//判断邮箱
	$(".regright .dc_email input").blur(function() {
		$(".regright .dc_email span .cuo").hide();
		$(".regright .dc_email span .dui").hide();
		$(".regright .dc_email span em").html("");
		if(($(".regright .dc_email input").val()=="请输入您的邮箱")||($(".regright .dc_email input").val()=="")){
			$(".regright .dc_email span .cuo").show();
			$(".regright .dc_email span em").html("邮箱不能为空");
			click=false;
		}else{
			var email = $(".regright .dc_email input").val();
			var re_email=/^[a-z\d]+(\.[a-z\d]+)*@([\da-z](-[\da-z])?)+(\.{1,2}[a-z]+)+$/;
			if (!re_email.test(email)) {
				$(".regright .dc_email span .cuo").show();
				$(".regright .dc_email span em").html("邮箱格式错误");
				click=false;
			}else{
				$(".regright .dc_email span .dui").show();
			}
		}
		
	})
	$(".regright .dc_username input").blur(function() {
		$(".regright .dc_username span .cuo").hide();
		$(".regright .dc_username span .dui").hide();
		$(".regright .dc_username span em").html("");
		$(".regright .dc_username em").html("");

		if(($(".regright .dc_username input").val()=="请输入用户名")||($(".regright .dc_username input").val()=="")){
			$(".regright .dc_username span .cuo").show();
			$(".regright .dc_username span em").html("用户名不能为空");
			click=false;
		}else{
			var name = $(".regright .dc_username input").val();
			var re_name=/[\u4e00-\u9fa5a-zA-Z0-9\-]{2,20}/;
			if (!re_name.test(name)) {
				$(".regright .dc_username span .cuo").show();
				$(".regright .dc_username span em").html("用户名已存在或格式错误");
				click=false;
			}else{
				$(".regright .dc_username span .dui").show();
			}
		}
	})
	$(".regright .dc_pwd .js_zhuce_pwd1").blur(function() {
		$(".regright .dc_pwd span .cuo").hide();
		$(".regright .dc_pwd span .dui").hide();
		$(".regright .dc_pwd span em").html("");
		$(".regright .dc_pwd em").html("");

		if($(".regright .dc_pwd .js_zhuce_pwd").is(":visible")){
			$(".regright .dc_pwd span .cuo").show();
			$(".regright .dc_pwd span em").html("密码不能为空");
			click=false;
		}else{
			var name = $(".regright .dc_pwd .js_zhuce_pwd1").val();
			var re_name=/[\u4e00-\u9fa5a-zA-Z0-9\-]{8,16}/;
			if (!re_name.test(name)) {
				$(".regright .dc_pwd span .cuo").show();
				$(".regright .dc_pwd span em").html("密码格式错误");
				click=false;
			}else{
				$(".regright .dc_pwd span .dui").show();
			}
		}
	})	
	$(".regright .compwd .js_zhuce_compwd1").blur(function() {
		$(".regright .compwd span .cuo").hide();
		$(".regright .compwd span .dui").hide();
		$(".regright .compwd span em").html("");
		$(".regright .compwd em").html("");

		if($(".regright .compwd .js_zhuce_compwd").is(":visible")){
			$(".regright .compwd span .cuo").show();
			$(".regright .compwd span em").html("确认密码不能为空");
			click=false;
		}else{
			if ($(".regright .dc_pwd .js_zhuce_pwd1").val()!=$(".regright .compwd .js_zhuce_compwd1").val()) {
				$(".regright .compwd span .cuo").show();
				$(".regright .compwd span em").html("两次密码不一致");
				click=false;
			}else{
				$(".regright .compwd span .dui").show();
			}
		}
	})
	$(".regright .shangchuan .tell input").blur(function(){
		$(".regright .shangchuan .tell img").hide()
		$(".regright .shangchuan .tell .dianhua_err em").html("");
		if($(this).val()=="科室电话:区号-电话号-分机号"){
			$(".regright .shangchuan .tell .dianhua_err .cuo").show()
			$(".regright .shangchuan .tell em").html("");
			$(".regright .shangchuan .tell .dianhua_err em").html("电话不能为空");
		}else{
			regexp=/^(0[0-9]{2,3}\-)?([2-9][0-9]{6,7})+(\-[0-9]{1,4})?$/;
			if (!regexp.test($(this).val())) {
				$(".regright .shangchuan .tell .dianhua_err .cuo").show();
				$(".regright .shangchuan .tell em").html("");
				$(".regright .shangchuan .tell .dianhua_err em").html("电话格式不正确");
				click=false;
			}else{
				$(".regright .shangchuan .tell .dianhua_err .dui").show();
			}
		}

	})


	/*=========医生注册2，点击下一步对各个输入信息进行判断===================*/
	$(".js_next_btn").click(function(){
		click=true;
		//判断地区城市有没有选择
		$(".regright .didian #s_province :selected").each(function(){
			var str=$(this).text();
			if(str=="省份"){
				$(".regright .didian span .cuo").show();
				$(".regright .didian span em").html("请选择所在城市");
				click=false;
			}else{
				$(".regright .didian #s_city :selected").each(function(){
					var str=$(this).text();
					if(str=="地级市"){
						$(".regright .didian span .cuo").show();
						$(".regright .didian span em").html("请选择所在城市");
						click=false;
					}else{
						$(".regright .didian #s_county :selected").each(function(){
							var str=$(this).text();
							if(str=="市、县级市"){
								$(".regright .didian span .cuo").show();
								$(".regright .didian span em").html("请选择所在城市");
								click=false;
							}else{
								$(".regright .didian span .dui").show();
							}
						})

					}
				})

			}
		})
		//判断手机号码
		$(".regright .phone input").trigger("blur");
		//判断验证码
		$(".regright .yanzhengcode input").trigger("blur");
		//判断单位是否填写
		$(".regright .dc_danwei input").trigger("blur");
		//判断身份证号码
		$(".regright .shenfencode input").trigger("blur");
		//判断邮箱
		$(".regright .dc_email input").trigger("blur");
		$(".regright .dc_username input").trigger("blur");
		$(".regright .dc_pwd .js_zhuce_pwd1").trigger("blur");
		$(".regright .compwd .js_zhuce_compwd1").trigger("blur");
		$(".js_textarea").trigger("blur");
		$(".regright .shangchuan .tell input").trigger("blur");

		//判断有没有上传证件
		$(".regt .regright .shangchuan .err .cuo").hide();
		$(".regt .regright .shangchuan .err em").html("");
		$(".regt .regright .shangchuan .err .dui").hide();
		if(($(".regt .regright .shangchuan dl .ok").val()=="")&&($(".regt .regright .shangchuan dl .ok1").val()=="")){
			$(".regt .regright .shangchuan .err .cuo").show();
			$(".regt .regright .shangchuan .err em").html("请上传证件");
			click=false;
		}else{
			$(".regt .regright .shangchuan .err .dui").show();
		}
	
		//判断科室
		$(".regright .dc_keshi span .cuo").hide();
		$(".regright .dc_keshi span .dui").hide();
		$(".regright .dc_keshi span em").html("");
		$(".regright .dc_keshi .keshi :selected").each(function(){
			var str=$(this).text();
			if(str=="请选择科室类别"){
				$(".regright .dc_keshi span .cuo").show();
				$(".regright .dc_keshi span em").html("请选择科室");
				click=false;
			}else{
				$(".regright .dc_keshi .keshi1 :selected").each(function(){
					var str=$(this).text();
					if(str=="请选择科室"){
						$(".regright .dc_keshi span .cuo").show();
						$(".regright .dc_keshi span em").html("请选择科室");
						click=false;
					}else{
						$(".regright .dc_keshi span .dui").show();
					}
				})
			}
		})

		//协议是否勾选判断
		if($(".regt_xieyi .check_box").attr("checked")!="checked"){
			click=false;
			$(".next span .cuo").show()
			$(".next span em").html("您还未接受直播平台使用协议");

		}else{
			$(".next span .cuo").hide()
			$(".next span em").html("");

		}
		if(click){
			$("#form1").submit();
		}	
	})




	/*=======================协议页面关闭功能=======================================*/
	$(".js_close").click(function() {
		window.close();
	})
	/*倒计时功能*/
	var wait = 6;

	function time() {
		if (wait != 0) {
			setTimeout(function() {
					time();
				},
				1000);
			wait--;
			$(".js_time").html(wait);
		}
	}
	time();



	/*******医生个人中心********/

	/*1.课程类型*/
	$('.doc_per_tbox .sub_menu span').click(function() {
		$(this).addClass('cur').siblings('span').removeClass('cur');
		var i = $(this).index();
		$(this).parent('.sub_menu').siblings('.mysub_type_js').eq(i).show().siblings('.mysub_type_js').hide();
	})

	/*我的课程-直播  预约*/
	$('.mysub_type .reserve_js').click(function() {
		var reserve_val = $(this).html();
		var cur_num = $(this).parent().parent('tr');
		var box_date = $(this).parent().parent('tr').find('td').eq(0).html();
		var box_time = $(this).parent().parent('tr').find('td').eq(1).html();
		var box_title = $(this).parent().parent('tr').find('td').eq(2).find('div').html();

		$(this).parents('section').parent('.area').siblings('.mask_js').show();
		$('.reverse_can_box').show();
		$('.reverse_can_box h2.tit').find('span.date').html(box_date);
		$('.reverse_can_box h2.tit').find('span.time').html(box_time);
		$('.reverse_can_box h2.tit').find('p.title').html('《' + box_title + '》');


		if (reserve_val == '取消预约') {
			/*点击确定*/
			$('.reverse_can_box .determined_js').live("click", function() {
				$(this).parent().parent('.reverse_can_box').hide();
				$(this).parent().parent('.reverse_can_box').siblings('.mask').hide();

				cur_num.remove();
			})

			/*点击返回*/
			$('.reverse_can_box .return_js').live("click", function() {
				$(this).parent().parent('.reverse_can_box').hide();
				$(this).parent().parent('.reverse_can_box').siblings('.mask').hide();
			})
		}
	})



	$(".reverse_text_js").blur(function() {
		if ($(this).val() == "") {
			$(this).val("xxx医生7月1日6：00-6：20，主题为《IABP心源性休克患者应用及评价》由于本人其他紧急事情已经取消，下次开课时间请关注xxx医生的个人主页，给您造成的不便敬请谅解，谢谢！（此内容可点击修改）");
		}
	})


	/*课程展示页面*/
	$(".js_type em").click(function() {
		$(this).addClass("cur").siblings().removeClass("cur");
		if ($(this).index() == 0) {
			$(".lb_list").show();
			$(".zb_list").hide();
		} else {
			$(".lb_list").hide();
			$(".zb_list").show();
		}
	})

	/*预约直播室*/
	/*搜索提交*/
	// $(".js_search_but").click(function(){
	// 	$(".js_date").val($(".js_select_yy_day span").html());
	// 	$(".js_time").val($(".js_select_yy_time span").html());
	// })
	/*日期变化，时间段联动*/

	/*1.时间联动*/
	$('.reserve_zbroom .select_date_js span').live('click', function() {
		$(this).parent().find('ul').toggle();
	})


	$('.reserve_zbroom .js_select_yy_day li').live("click",function() {
		
		var cur_text = $(this).html();
		$(this).parent('ul').siblings('span').html(cur_text);
		$(this).parent().hide();
		console.log($(this).attr("val"));
		$(".js_date").val($(this).attr("val"));
		if($(this).attr("val")==1){
			$(".js_select_yy_time_all").show();
			$(".js_select_yy_time_all span").html("6:00-6:20");
			$(".js_select_yy_time").hide();
			$(".js_stime").val("1");
			$(".js_text").attr("value","6:00-6:20");
		}else{
			$(".js_select_yy_time_all").hide();
			$(".js_select_yy_time").show();
			$(".js_select_yy_time span").html("6:00-10:00");
			$(".js_select_yy_time span").attr("val","1,2,3,4,5,6,7,8");
			$(".js_stime").val("1,2,3,4,5,6,7,8");
			$(".js_text").attr("value","6:00-10:00");
		}
	})
	

	$('.reserve_zbroom .select_yy_time_js li').live('click', function() {
		var cur_text2 = $(this).html();
		$(this).parent('ul').siblings('span').html(cur_text2);
		$(this).parent().hide();
		console.log($(this).html());
		$(".js_stime").val($(this).attr("val"));
		$(".js_select_yy_time span").attr("val",$(this).attr("val"));
		$(".js_text").attr("value",$(this).html());
	})

	/*搜索后显示直播室的查询 日期 和 时间段*/
	// $('.reserve_zbroom button.search_js').click(function() {
	// 	var date_text = $('.reserve_zbroom .select_yy_day span').html();
	// 	var time_text = $('.reserve_zbroom .select_yy_time span').html();
	// 	if ($('.reserve_zbroom .select_yy_day span').html() == '全部7天') {
	// 		$(this).parent().siblings('.reserve_zbroom_box').eq(0).show().siblings('.reserve_zbroom_box').hide();
	// 		$('.reserve_zbroom_box h3.tit span.date').html('7月18日 至 7月24日');
	// 		$('.reserve_zbroom_box h3.tit span.time').html(time_text);
	// 	} else {
	// 		$(this).parent().siblings('.reserve_zbroom_box').eq(1).show().siblings('.reserve_zbroom_box').hide();
	// 		$('.reserve_zbroom_box h3.tit span.date').html(date_text);
	// 		$('.reserve_zbroom_box h3.tit span.time').html(time_text);
	// 	}
	// })

	/*直播预约，显示预定信息提交页面*/
	$('.reserve_zbroom_box .yd_live_type_js').click(function() {
		if ($("#date_stauts").val()=='1') {
			var date_text = $(this).parent().parent().parent().siblings('dt').html();
			var time_text = $(this).parent().parent().parent().parent('').siblings('h3.tit').find('span.time').html();
			var num = $(this).parent().siblings('label.live_name').html().replace(/[^0-9]/ig, "");
			$("#dtime").val($("#title_time").attr('val'));
			$("#zb_id").val($(this).attr('val'));
			$("#time").val($(this).parent().parent().parent().siblings('dt').attr('val'));

			$('.doc_per_cbox .reserve_liveRoom1').hide();
			$('.doc_per_cbox .reserve_liveRoom2').show();

			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip span.date').html(date_text);
			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip span.time').html(time_text);
			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip i').html(num);

		} else {
			var date_text = $(this).parent().parent().parent().parent('').siblings('h3.tit').find('span.date').html();
			var fir_num = $(this).parent().index();
			var time_text = $(this).parent().parent().parent('tbody').siblings('thead').find('th').eq(fir_num).html();
			var num = $(this).parent().parent().find('td').eq(0).html().replace(/[^0-9]/ig, "");
			$("#zb_id").val($(this).attr('val'));
			$("#dtime").val($(this).parent().parent().parent('tbody').siblings('thead').find('th').eq(fir_num).attr('val'));
			$("#time").val($("#once_title_time").attr('val'));

			$('.doc_per_cbox .reserve_liveRoom1').hide();
			$('.doc_per_cbox .reserve_liveRoom2').show();

			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip span.date').html(date_text);
			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip span.time').html(time_text);
			$('.doc_per_cbox .reserve_liveRoom2').find('p.tip i').html(num);
		}

	})


	/*医生个人中心-我的课程  个人信息*/
	$('.doc_per_bbox ul.per_infor_js li').click(function() {
		$(this).addClass('cur').siblings('li').removeClass('cur');
		$(this).append('<i></i>');
		$(this).siblings('li').find('i').remove();
		var c = $(this).index();
		$(this).parent('.person_infor_l').siblings('.person_infor_r').find('.person_infor_box').eq(c).show().siblings('.person_infor_box').hide();
	})

	/*预约页面*/
	$('.reserve_content .cont_box .reverse_text').focus(function() {
		if ($(this).val() != "") {
			$(this).val('');
		}
	})
	$('.reserve_content .cont_box .reverse_text').blur(function() {
		if ($(this).val() == "") {
			$(this).val('您有什么问题要咨询医生，可在这里提交，直播时我们会请医生与您沟通。');
		}
	})


})

window.onload = function(){
	/**=========================医生个人中心&&助教个人中心头部=====================================*/
	/*头部个人中心*/
	// $("header .area .selfcenter p .new").hide();
	var flag = $("header .area .selfcenter p .new").is(":visible");	
	$("header .area .selfcenter").hover(function(){
		if(flag){
			$("header .area .selfcenter p .new").hide();
			$("header .area .selfcenter p .new1").show();
		}else{
			$("header .area .selfcenter p .new").hide();
			$("header .area .selfcenter p .new1").hide();
		}
	},function(){
		if(flag){
			$("header .area .selfcenter p .new").show();
			$("header .area .selfcenter p .new1").hide();
		}else{
			$("header .area .selfcenter p .new").hide();
			$("header .area .selfcenter p .new1").hide();
		}

	})


	//医生&助教个人中心 我的课程 日期选着后的第三个输入框
	/*状态输入框点击效果*/
	$(".js_status").click(function(){
		$(".select_status").toggle()
	})
	$(".js_select_status li").live("click",function(){
		console.log($(this).html())
		$(".dc_center .kc_lubo .search p.status").html($(this).html())
		$(".dc_center .kc_zhibo .search p.status").html($(this).html())
		$(".js_select_status").hide();
	})
/**====================首页专题底部圆点个数设置===============================**/
	//圆点数默认是两个
	var number=$(".js_zc_view .no").size();
	var width=30*number;
	$(".js_change ul").css({"width":width});
	for(var k = 0;k < number-2;k++){
		$(".js_change ul").append('<li>●</li>')
	}
	$(".js_change").css({"left":(1000-width)/2});




	// /*===================医生个人中心--预约直播室==========================*/
	// //设置日期，当前日期
	// var myDate = new Date(); //获取今天日期
	// myDate.setDate(myDate.getDate());
	// var dateArray = []; 
	// var dateTemp; 
	// var flag = 1; 
	// for (var i = 0; i < 7; i++) {
	//     dateTemp = (myDate.getMonth()+1)+"月"+myDate.getDate()+"日";
	//     dateArray.push(dateTemp);
	//     myDate.setDate(myDate.getDate() + flag);
	// }
	// for(var j=0;j<7;j++){
	// 	$(".js_select_yy_day ul").append('<li>'+dateArray[j]+'</li>');
		
	// }
	if($("#date_stauts").val()==1){
		$(".js_select_yy_time_all").show();
		$(".js_select_yy_time").hide();
	}else{
		$(".js_select_yy_time_all").hide();
		$(".js_select_yy_time").show();
	}
}