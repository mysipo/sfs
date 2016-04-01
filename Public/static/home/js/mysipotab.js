// JavaScript Document
$(document).ready(function(){
	//选项卡切换
	tab_even("type_class2","down","demoList");

	function tab_even(class_name,class_hover,class_con){
        $("#"+class_name+" a").eq(0).addClass(class_hover);
        $("#"+class_name+" a").mousemove(function(){
        $("."+class_con).hide();
        $("#"+class_name+" a").removeClass(class_hover);
        $(this).addClass(class_hover);
        var index=$("#"+class_name+" a").index($(this));
        //找到class_name中索引值为当前元素索引值的a元素
        $("."+class_con+":eq("+index+")").show();      
      });
    }
});