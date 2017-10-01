// JavaScript Document
//移动端头像裁剪插件
(function($){
	$.fn.crop = function(options){
		var v = {
			w:320,
			h:320,
			r:120,
			res:'',
			barBgColor:'#000',
			touchBgColor:'#58d82c',
			opacity:0.5,
			isCircle:true,
			callback:function(base64Data){}
		}
		var o = $.extend(v,options);
		//重加载时移除
		$(this).html('');
		$('#scale-bar').remove();
		//图片资源文件为空时提醒
		if(o.res==''){
			alert('base64图片资源为空！');
			return false;
		}
		//如果盒子高度少于宽度提醒设置错误
//		if(o.h<o.w){
//			alert('容器区域高度须大于等于宽度！');
//			return false;
//		}
//		//如果半径大于盒子宽度的一半，则提醒
//		if(o.r>o.w*0.5){
//			alert('裁剪半径超出盒子宽度一半，请修改！');
//			return false;
//		}
		var box = $(this);
		if(!box.attr('id')){
			id = 'curbox'+Date.parse(new Date());
			box.attr('id',id);
		}else{
			id = box.attr('id');
		}
		//获取图片信息
		var image = new Image();
		image.src = o.res;
		image.onload = function(){
			//添加盒子内元素
			box.append('\
				<div id="cut-mask" style="width:'+o.w+'px;height:'+o.h+'px;position:relative;left:0px;top:0px;z-index:10;"><canvas id="canvas-mask"></canvas></div>\
				<div id="cut-img" style="width:'+o.w+'px;height:'+o.h+'px;position:relative;top:'+(-o.h)+'px;left:0px;background-image:url('+image.src+');background-size:'+image.width+'px '+image.height+'px;background-position:0px 0px;background-repeat:no-repeat;"></div>\
			');
			//设置盒子样式
			box.css({
				"width":o.w+"px",
				"height":o.h+"px",
				"position":"relative",
				"left":"0px",
				"top":"0px",
				"overflow":"hidden"
			});
			//设置放大缩小
			box.after('<div id="scale-bar" style="width:'+o.w+'px;height:60px;background-image:url(data:image/png;base64,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);background-color:'+o.barBgColor+';filter:alpha(opacity='+o.opacity*100+');-moz-opacity:'+o.opacity+';-khtml-opacity: '+o.opacity+';opacity: '+o.opacity+';background-repeat:no-repeat;background-position:center center;clear:both;position:absolute;bottom:0px;z-index:999"></div>');
			
			//初始化设置遮罩
			var mask = document.getElementById('canvas-mask');
			
			var msk = mask.getContext('2d');
			mask.width = o.w;
			mask.height = o.h;
			//画矩形
			msk.beginPath();
			msk.rect(0,0,o.w,o.h);
			msk.globalAlpha = 0.1;
			msk.fill();//画实心圆
			msk.closePath();
			
			//画一个实心圆
//			msk.globalCompositeOperation = 'destination-out';
//			msk.beginPath();
//			msk.arc(o.w*0.5,o.h*0.5,o.r,0,(Math.PI/180)*360,false);
//			//msk.rect((o.w-o.r*2)*0.5,(o.h-o.r*2)*0.5,o.r*2,o.r*2);
//			msk.fill();
//			msk.closePath();
			
//			//画一个矩形框
//			msk.beginPath();
//			msk.rect(0,0,o.w,o.h);
//			msk.globalAlpha = 0.7;
//			msk.fill();//画实心圆
//			msk.closePath();
			
			//全局变量
			var x = 0,
				y = 0,
				_x = 0,
				scale,
				gx = 0,
				gy = 0,
				gw = image.width,
				gh = image.height,
				base64Data = '',
				t,touchX,touchY;
			
			//获取触控区域及移动盒子对象
			var element = document.getElementById(id);
			var img = document.getElementById('cut-img');
			var bar = document.getElementById('scale-bar');
			
			//触控移动
			element.addEventListener('touchstart',start);
			function start(event){
				event.preventDefault();
				element.lastMouseX = event.touches[0].screenX;
				element.lastMouseY = event.touches[0].screenY;
				
				element.addEventListener('touchmove',move);
				element.addEventListener('touchend',end);
			}
			function move(event){
				event.preventDefault();
				element.NewMouseX = event.touches[0].screenX;
				element.NewMouseY = event.touches[0].screenY;
				
				$('#cut-img').css({
					'background-position':(gx+(element.NewMouseX - element.lastMouseX))+'px '+(gy+(element.NewMouseY - element.lastMouseY))+'px',
					'background-repeat':'no-repeat'
				});
			}
			function end(event){
				gx = gx + element.NewMouseX - element.lastMouseX;
				gy = gy + element.NewMouseY - element.lastMouseY;
				
				element.removeEventListener('touchmove');
				element.removeEventListener('touchend');
			}
			
			//触控缩放
			bar.addEventListener('touchstart',startscale);
			function startscale(event){
				event.preventDefault();
				bar.lastMouseX = event.touches[0].screenX;
				bar.addEventListener('touchmove',movescale);
				bar.addEventListener('touchend',endscale);
				
				$('#scale-bar').css({
					'background-color':o.touchBgColor,
					'-webkit-transition':'all .3s linear'
				});
				
				touchX = event.touches[0].screenX;
				touchY = event.touches[0].screenY;
				
				window.clearTimeout(t);
				t = setTimeout(function(){
					if(touchX != -1){
						submitBase64();
					}
					window.clearTimeout(t);
				},1000);
			}
			function movescale(event){
				event.preventDefault();
				bar.NewMouseX = event.touches[0].screenX;
				_x = bar.NewMouseX - bar.lastMouseX;
				if(_x>0){
					scale = Math.abs(_x)/o.w + 1;
				}else{
					scale = 1 - Math.abs(_x)/o.w;
				}

				$('#cut-img').css({
					'background-size':(gw*scale)+'px '+(gh*scale)+'px',
					'background-position':(gx*scale)+'px '+(gy*scale)+'px',
					'background-repeat':'no-repeat'
				});
				
				touchX = -1;
				touchY = -1;
			}
			function endscale(event){
				var xy = $(img).css('background-size');
				var arr = xy.split(' ');
				gx = parseInt($(img).css('background-position-x'));//原图左上角x坐标
				gy = parseInt($(img).css('background-position-y'));//原图右上角y坐标
				gw = parseInt(arr[0]);//原图片宽度
				gh = parseInt(arr[1]);//原图片高度
				
				$('#scale-bar').css({
					'background-color':o.barBgColor,
					'-webkit-transition':'all .3s linear'
				});
				
				touchX = -1;
				touchY = -1;
				
				bar.removeEventListener('touchmove');
				bar.removeEventListener('touchend');
			}
			//保存提交图片Base64数据
			
			function submitBase64(){
				var canvas = $("<canvas />").attr({
					width: o.w,
					height: o.h
				}).get(0);
				canvasContext = canvas.getContext("2d");
				canvasContext.fillStyle = "#eee";
				canvasContext.fillRect(0, 0, canvas.width, canvas.height);
				var cx = -gx*image.width/gw,
					cy = -gy*image.height/gh,
					cw = o.w*image.width/gw,
					ch = o.h*image.height/gh;
					
				var nx = ny = nw = nh = 0;
				var dx = dy = dw = dh = 0;
				if(cx<0){
					nx = 0;
					if(cx+cw<image.width){
						nw = cx+cw;
					}else{
						nw = image.width;
					}
				}else{
					nx = cx;
					if(cx+cw<image.width){
						nw = cw;
					}else{
						nw = image.width-cx;
					}
				}
				
				if(cy<0){
					ny = 0;
					if(cy+ch<image.height){
						nh = cy+ch;
					}else{
						nh = image.height;
					}
				}else{
					ny = cy;
					if(cy+ch<image.height){
						nh = ch;
					}else{
						nh = image.height-cy;
					}
				}
				//alert(nx +'>'+ ny  +'>'+ nw+'>'+ nh);
				dx = (cx<0?-cx:0)*gw/image.width;
				dy = (cy<0?-cy:0)*gh/image.height;
				dw = (nw*gw/image.width<o.w?nw*gw/image.width:o.w);
				dh = (nh*gh/image.height<o.h?nh*gh/image.height:o.h);
				
				canvasContext.drawImage(
					image,
					nx,
					ny,
					nw,
					nh,
					dx,
					dy,
					dw,
					dh
				);
				o.callback(canvas.toDataURL());
			}
		}
	}
})(jQuery);