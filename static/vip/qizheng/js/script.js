$( function(){
	var timer,
		index = 1,
		liWidth = $( "#center li:first" ).width(),
		max = $( "#center li" ).length,
		lis = $( "#center li");
	var zuobX,zuobY,direction,outtime;
	if( max == 1 ){
		return false;
	}
	for( var i = 0;i < max;i++ ){
		var _li = document.createElement( "li" );
		$( "#line ul" ).append( _li );
	}
	$( "#line li" ).eq(0).addClass("on");
	lis.first().clone().appendTo($( "#center ul" ));	
	lis.last().clone().prependTo($( "#center ul" ));	
	$( "#center ul" ).css({marginLeft:-liWidth});
	
	function play( nums ){
		var dir = nums > index ? -1 : 1,
			n = Math.abs( nums - index );
		$("#center ul").not(":animated").animate({ marginLeft :'+=' + dir * liWidth * n },1500,function(){
			if( nums > max ){
				$('#center ul').css({ marginLeft : -liWidth });
				nums = 1;
			}else if( nums <= 0){
				$( '#center ul' ).css({ marginLeft : -liWidth * max });
				nums = max;
			}
			index = nums;
			$( "#line li" ).eq( index -1 ).addClass( "on" ).siblings().removeClass( "on" );
		})
	}
	timer = setInterval( function(){
		play( index + 1 );
	},1500)
	function xunhuan(){
		clearTimeout( outtime );
		timer = setInterval( function(){
			play( index + 1 );
		},1500)
	}
	var obj = document.getElementById('center'); 
	obj.addEventListener('touchmove', function(event) { 
		clearInterval( timer );
		var touch = event.targetTouches[0];
		if( touch.pageX - zuobX > 0 ){
			play( index - 1 );
		}
		if( touch.pageX - zuobX < 0 ){
			play( index + 1 );
		}
	});
	
	obj.addEventListener('touchstart', function(event) { 
		outtime = setTimeout( function(){
			xunhuan();
			//play( index + 1 );
		},1500)
	});
	obj.addEventListener('touchstart',function(){
		clearInterval( timer );
		var touch = event.targetTouches[0]; 
		zuobX = touch.pageX;
		zuobY = touch.pageY; 
	},1000,function(){
		clearTimeout( timer );
		timer = setInterval( function(){
			play( index + 1 );
		},1500)
	})
})	
