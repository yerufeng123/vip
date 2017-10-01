$(document).ready(function(){
	init();
	var slide = new Slide("#wrap");
	slide.swipe = function(x_dir,y_dir,points){ 
		if(y_dir){ 
			photo_move(y_dir);
		}
	}
})
function init(){
	var _max = $(".page").length;
	for( var i = 0;i < _max; i++){
		var _li = document.createElement("li"); 
		$( "#line ul" ).append( _li );
	};
	$( "#line ul li" ).eq(0).addClass("on");
	$(".page").eq(0).addClass("show");
}

function photo_move(_num){ 
	var _max = $(".page").length;
	var _index = $(".page.show").index(); 
	_index = (_index+_max + _num)%_max;
	$(".page").removeClass("show").eq(_index).addClass("show");
	$("#line ul li").eq( _index ).addClass("on").siblings().removeClass( "on" );
}