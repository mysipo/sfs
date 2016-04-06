// JavaScript Document
$(document).ready(
function(){
	/*右侧tab切换*/
	$(".Hot_lists li").hover(function(){ // .click 为点击事件  .hover为鼠标经过事件
	$(this).addClass("on").siblings().removeClass("on");
	var index = $(".Hot_lists>li").index($(this));
	$(".Hot_boxs>div:eq("+index+")").show().siblings().hide();
	});
	
	
		/*下拉菜单*/
var qcloud={};
	$('[_t_nav]').hover(function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').each(function(){
		$(this)[ _nav == $(this).attr('_t_nav') ? 'addClass':'removeClass' ]('nav-up-selected');
		});
		$('#'+_nav).stop(true,true).slideDown(200);
		}, 150);
	},function(){
		var _nav = $(this).attr('_t_nav');
		clearTimeout( qcloud[ _nav + '_timer' ] );
		qcloud[ _nav + '_timer' ] = setTimeout(function(){
		$('[_t_nav]').removeClass('nav-up-selected');
		$('#'+_nav).stop(true,true).slideUp(200);
		}, 150);
	});
	
	}
	
   


	
)