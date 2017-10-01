
/**
 * JS 模糊查询
 * @author tugenhua
 * @date 2013-11-19
 * @param 1.当前的input add targetCls 
 * 2. 隐藏域里面统一增加同类名 叫 hiddenCls
 * 3. 在各个父级元素上 添加类名 parentCls
 */

 function AutoComplete (options) {
	 this.config = {
		targetCls          : '.inputElem',          // 输入框目标元素
		parentCls          : '.parentCls',          // 父级类
		hiddenCls          : '.hiddenCls',          // 隐藏域input
	    searchForm         :'.jqtransformdone',     //form表单
		hoverBg            : 'hoverBg',             // 鼠标移上去的背景
		outBg              : 'outBg',               // 鼠标移下拉的背景
		isSelectHide       : true,                 // 点击下拉框 是否隐藏
		url                : '/dspicture/ajaxgetcity',                    // url接口
		height             : 0,                     // 默认为0 不设置的话 那么高度自适应
		manySelect         : false,                 // 输入框是否多选 默认false 单选
		renderHTMLCallback : null,                  // keyup时 渲染数据后的回调函数
		callback           : null,                  // 点击某一项 提供回调
		closedCallback     : null                   // 点击输入框某一项x按钮时 回调函数
	 };

	 this.cache = {
		currentIndex        : -1,
		oldIndex            : -1,
		inputArrs           : []                 // 多选时候 输入框值放到数组里面去
	 };
	 this.init(options);
 }
 
 AutoComplete.prototype = {
	
	constructor: AutoComplete,
	init: function(options) {
        
		this.config = $.extend(this.config, options || {});
		var self = this,
			_config = self.config,
			_cache = self.cache;

		 // 鼠标点击输入框时候 
		  $(_config.targetCls).each(function(index,item) {
		   
			  /*
			   *  禁止 ctrl+v 和 黏贴事件
			   */
			  $(item).unbind('paste');
              $(item).bind('paste',function(e){
				  e.preventDefault();
				  var target = e.target,
					  targetParent = $(target).closest(_config.parentCls);
				  $(this).val('');
				  $(_config.hiddenCls,targetParent) && $(_config.hiddenCls,targetParent).val('');
			  });
             
			  $(item).keyup(function(e){
				  _cache.inputArrs = [];
				  var targetVal = $.trim($(this).val()),
					  keyCode = e.keyCode,
					  elemHeight = $(this).outerHeight(),
					  elemWidth = $(this).outerWidth();
					  
			      // 如果输入框值为空的话 那么隐藏域的value清空掉
			      if(targetVal == '') {
			           var curParents = $(this).closest(_config.parentCls);
			           $(_config.hiddenCls,curParents).val('');
			      }
				  var targetParent = $(this).parent();
				  $(targetParent).css({'position':'relative'});
				  
				  if($('.auto-tips',targetParent).length == 0) {
					  // 初始化时候 动态创建下拉框容器
					 $(targetParent).append($('<div class="auto-tips hidden"></div>'));
					 $('.auto-tips',targetParent).css({'position':'absolute','top':elemHeight,'left':'0px','z-index':999,'width':elemWidth,'border':'1px solid #ccc'});
				  }
				 
				  
				  var curIndex = self._keyCode(keyCode);
				  if(curIndex > -1){
						  self._keyUpAndDown(targetVal,e,targetParent);
					}else {
						 if(targetVal != '') {
							self._doPostAction(targetVal,targetParent);
						 }
						 
					}
			  });
			
			  // 失去焦点时 如果没有点击 或者上下移时候 直接输入 那么当前输入框值情况 隐藏域值情况
			  $(item).blur(function(e){
				  var target = e.target,
					  targetParent = $(target).closest(_config.parentCls);
				  if($(this).attr('up') || $(this).attr('down')) {
					 return;
				  }else {
					 //$(this).val('');
					 $(_config.hiddenCls,targetParent).val($(this).val());
				  }
			  });
			  
		  });

		  // 阻止form表单默认enter键提交
		  $(_config.searchForm).each(function(index,item) {
		       $(item).keydown(function(e){
				    var keyCode = e.keyCode;
				    if(keyCode == 13) {
					    return false;
				    }
			   });
		  });

		  // 点击文档
		  $(document).click(function(e){
			 e.stopPropagation();
			 var target = e.target,
				 tagParent = $(target).parent(),
				 attr = $(target,tagParent).closest('.auto-tips');

			 var tagCls = _config.targetCls.replace(/^\./,'');

			 if(attr.length > 0 || $(target,tagParent).hasClass(tagCls)) {
				return;
			 }else {
				$('.auto-tips').each(function(index,item){
					!$(item,tagParent).hasClass('hidden') && $(item,tagParent).addClass('hidden');
				});
				
			 }
		  });
		  
		  var stylesheet = '.auto-tips { margin: 0 1px; list-style: none;max-height:140px!important;padding: 0px;position:absolute; border:1px solid #ccc; top:27px; left:70px!important; z-index:999; width:100%;background:#fff !important;overflow:auto!important;}' + 
                           '.auto-tips p {overflow: hidden;margin: 1px 0;padding: 5px 5px;border-bottom: 1px solid #e7e7e7;color: #666;text-decoration: none;line-height: 23px;white-space: nowrap;cursor: pointer;zoom: 1;}' + 
                           '.auto-tips p img{ vertical-align:middle;float:left;}' + 
						   '.create-input{line-height:26px,padding-left:3px;}' + 
						   '.create-input span{margin-top:1px;height:24px;float:left;}' +
						   '.create-input span i,.auto-tips span a{font-style:normal;float:left;cursor:default;}' +
						   '.create-input span a{padding:0 8px 0 3px;cursor:pointer;}' +
                           '.auto-tips p.hoverBg {background-color: #669cb6;color: #fff;cursor: pointer;}' + 
                           '.hidden {display:none;}';
          
          this._addStyleSheet(stylesheet);
          
	},
	/**
     * 键盘上下键操作
     */
	_keyUpAndDown: function(targetVal,e,targetParent) {
		var self = this,
			_cache = self.cache,
			_config = self.config;

		// 如果请求成功后 返回了数据(根据元素的长度来判断) 执行以下操作
		if($('.auto-tips p',targetParent) && $('.auto-tips p',targetParent).length > 0) {

			var plen = $('.auto-tips p',targetParent).length,
				keyCode = e.keyCode;
				_cache.oldIndex = _cache.currentIndex;

			// 上移操作
			if(keyCode == 38) {
				if(_cache.currentIndex == -1) {
					_cache.currentIndex = plen - 1;
				}else {
					_cache.currentIndex = _cache.currentIndex - 1;
					if(_cache.currentIndex < 0) {
						_cache.currentIndex = plen - 1;
					}
				}
				if(_cache.currentIndex !== -1) {
					
					!$('.auto-tips .p-index'+_cache.currentIndex,targetParent).hasClass(_config.hoverBg) &&
					$('.auto-tips .p-index'+_cache.currentIndex,targetParent).addClass(_config.hoverBg).siblings().removeClass(_config.hoverBg);
					var curAttr = $('.auto-tips .p-index'+_cache.currentIndex,targetParent).attr('data-html'),
					    embId = $('.auto-tips .p-index'+_cache.currentIndex,targetParent).attr('embId');
                    
					// 判断是否是多选操作 多选操作 暂留接口
					if(_config.manySelect) {
						_cache.inputArrs.push(curAttr);
						_cache.inputArrs = self._unique(_cache.inputArrs);
						self._manySelect(targetParent);
					}else {
						$(_config.targetCls,targetParent).val(curAttr);
						// 上移操作增加一个属性 当失去焦点时候 判断有没有这个属性
						if(!$(_config.targetCls,targetParent).attr('up')){
							$(_config.targetCls,targetParent).attr('up','true');
						}
						

						var pCls = $(_config.targetCls,targetParent).closest(_config.parentCls);
						$(_config.hiddenCls,pCls).val(embId);

						self._createDiv(targetParent,curAttr);
						self._closed(targetParent);
						// hover
						self._hover(targetParent);
					}
					
				}

			}else if(keyCode == 40) { //下移操作
				if(_cache.currentIndex == plen - 1) {
					_cache.currentIndex = 0;
				}else {
					_cache.currentIndex++;
					if(_cache.currentIndex > plen - 1) {
						_cache.currentIndex = 0;
					}
				}
				if(_cache.currentIndex !== -1) {

					!$('.auto-tips .p-index'+_cache.currentIndex,targetParent).hasClass(_config.hoverBg) &&
					$('.auto-tips .p-index'+_cache.currentIndex,targetParent).addClass(_config.hoverBg).siblings().removeClass(_config.hoverBg);
					var curAttr = $('.auto-tips .p-index'+_cache.currentIndex,targetParent).attr('data-html'),
					    embId = $('.auto-tips .p-index'+_cache.currentIndex,targetParent).attr('embId');
					
					
					// 判断是否是多选操作 多选操作 暂留接口
					if(_config.manySelect) {
						_cache.inputArrs.push(curAttr);
						_cache.inputArrs = self._unique(_cache.inputArrs);
						self._manySelect(targetParent);
					}else {
						$(_config.targetCls,targetParent).val(curAttr);
						
						// 下移操作增加一个属性 当失去焦点时候 判断有没有这个属性
						if(!$(_config.targetCls,targetParent).attr('down')){
							$(_config.targetCls,targetParent).attr('down','true');
						}

						var pCls = $(_config.targetCls,targetParent).closest(_config.parentCls);
                        $(_config.hiddenCls,pCls).val(embId);
						self._createDiv(targetParent,curAttr);
						self._closed(targetParent);
						// hover
						self._hover(targetParent);
					}
					
				}
			}else if(keyCode == 13) { //回车操作
				var curVal = $('.auto-tips .p-index'+_cache.oldIndex,targetParent).attr('data-html');
				$(_config.targetCls,targetParent).val(curVal);
				if(_config.isSelectHide) {
					!$(".auto-tips",targetParent).hasClass('hidden') && $(".auto-tips",targetParent).addClass('hidden');
				}
				
				_cache.currentIndex = -1;
				_cache.oldIndex = -1;
				
			}
		}
	},
	// 键码判断
	_keyCode: function(code) {
		var arrs = ['17','18','38','40','37','39','33','34','35','46','36','13','45','44','145','19','20','9'];
		for(var i = 0, ilen = arrs.length; i < ilen; i++) {
			if(code == arrs[i]) {
				return i;
			}
		}
		return -1;
	},
	_doPostAction: function(targetVal,targetParent) {
	    
		var  self = this,
			 _cache = self.cache,
			 _config = self.config,
			 url = _config.url;

		// 假如返回的数据如下：
//		var results = [{lastName:'tugenhua',emplId:'E0987',image:''},{lastName:'tugenhua',emplId:'E0988',image:''},{lastName:'tugenhua',emplId:'E0989',image:''}];
//		self._renderHTML(results,targetParent);
//        self._executeClick(results,targetParent);
	   $.get(url+"?keyword="+targetVal+"&timestamp="+new Date().getTime(),function(data){
	        var ret = $.parseJSON(data),
	            results = ret.results;
            if(results.length > 0) {
                self._renderHTML(results,targetParent);
                self._executeClick(results,targetParent);
            }else {
                !$('.auto-tips',targetParent).hasClass('hidden') && $('.auto-tips',targetParent).addClass("hidden");
                $('.auto-tips',targetParent).html('');
                
            }
	    });
		
	},
	_renderHTML: function(ret,targetParent) {
		var self = this,
			_config = self.config,
			_cache = self.cache,
			html = '';

		for(var i = 0, ilen = ret.length; i < ilen; i+=1) {
			html += '<p  data-html = "'+ret[i].city_name+'" embId="'+ret[i].city_name+'" class="p-index'+i+'">' + 
					   '<span>'+ret[i].city_name+'</span>' + 
					'</p>';
		}
		// 渲染值到下拉框里面去
		$('.auto-tips',targetParent).html(html);
		 $('.auto-tips',targetParent).hasClass('hidden') && $('.auto-tips',targetParent).removeClass('hidden');
		$('.auto-tips p:last',targetParent).css({"border-bottom":'none'});

		_config.renderHTMLCallback && $.isFunction(_config.renderHTMLCallback) && _config.renderHTMLCallback();

		// 出现滚动条 计算p的长度 * 一项p的高度 是否大于 设置的高度 如是的话 出现滚动条 反之
		var plen = $('.auto-tips p',targetParent).length,
			pheight = $('.auto-tips p',targetParent).height();

		if(_config.height > 0) {
			if(plen*pheight > _config.height) {
				$('.auto-tips',targetParent).css({'height':_config.height,'overflow':'auto'});
			}else {
				$('.auto-tips',targetParent).css({'height':'auto','overflow':'auto'});
			}
		}
	},
	/**
	  * 当数据相同的时 点击对应的项时 返回数据
	  */
	_executeClick: function(ret,targetParent) {
		var self = this,
            _config = self.config,
			_cache = self.cache;
		 $('.auto-tips p',targetParent).unbind('click');
		 $('.auto-tips p',targetParent).bind('click',function(e){
			  var dataAttr = $(this).attr('data-html'),
			      embId = $(this).attr('embId');
              
			  // 判断是否多选
			  if(_config.manySelect) {
				  _cache.inputArrs.push(dataAttr);
				  _cache.inputArrs = self._unique(_cache.inputArrs);
				  self._manySelect(targetParent);
			  }else {
			     $(_config.targetCls,targetParent).val(dataAttr);
			     var parentCls = $(_config.targetCls,targetParent).closest(_config.parentCls),
			         hiddenCls = $(_config.hiddenCls,parentCls);
			     $(hiddenCls).val(embId);
			     //self._createDiv(targetParent,dataAttr);

			     // hover
			     self._hover(targetParent);

				 //!$(_config.targetCls,targetParent).hasClass('hidden') && $(_config.targetCls,targetParent).addClass('hidden');
			  }
			  self._closed(targetParent);
			  if(_config.isSelectHide) {
				  !$('.auto-tips',targetParent).hasClass('hidden') && $('.auto-tips',targetParent).addClass('hidden');
			  }
			  _config.callback && $.isFunction(_config.callback) && _config.callback();
		 });

		 // 鼠标移上效果
		 $('.auto-tips p',targetParent).hover(function(e){
			 !$(this,targetParent).hasClass(_config.hoverBg) &&
			 $(this,targetParent).addClass(_config.hoverBg).siblings().removeClass(_config.hoverBg);
		 });
	},
	_hover: function(targetParent){
		$('.create-input span',targetParent).hover(function(){
			$(this).css({"background":'#ccc','padding-left':'0px'}); 
		},function(){
			 $(this).css({"background":''});
		});
	},
	// 动态的创建div标签 遮住input输入框
	_createDiv: function(targetParent,dataAttr){
		 var self = this,
			 _config = self.config;
	     var iscreate = $('.create-input',targetParent);
		 
		 // 确保只创建一次div
		 if(iscreate.length > 0) {
			$('.create-input',targetParent).remove();
		 }
		 $(targetParent).prepend($('<div class="create-input"><span><i></i></span></div>'));
		 $('.create-input span i',targetParent).html(dataAttr);
		 $(_config.targetCls,targetParent).val(dataAttr);
		 $('.create-input span',targetParent).append('<a class="alink">X</a>');
		 $('.alink',targetParent).css({'float':'left','background':'none'});
	},
	// X 关闭事件
	_closed: function(targetParent){
		 var self = this,
			 _config = self.config;
		 /*
		  * 点击X 关闭按钮
		  * 判断当前输入框有没有up和down属性 有的话 删除掉 否则 什么都不做
		  */
		  $('.alink',targetParent).click(function(){
			 $('.create-input',targetParent) && $('.create-input',targetParent).remove();
			 $(_config.targetCls,targetParent) && $(_config.targetCls,targetParent).hasClass('hidden') &&
			 $(_config.targetCls,targetParent).removeClass('hidden');
			 $(_config.targetCls,targetParent).val('');
			 //清空隐藏域的值
			 var curParent = $(_config.targetCls,targetParent).closest(_config.parentCls);
			 $(_config.hiddenCls,curParent).val('');

			 var targetInput = $(_config.targetCls,targetParent);
			 if($(targetInput).attr('up') || $(targetInput).attr('down')) {
				 $(targetInput).attr('up') && $(targetInput).removeAttr('up');
				 $(targetInput).attr('down') && $(targetInput).removeAttr('down');
			 }
			 _config.closedCallback && $.isFunction(_config.closedCallback) && _config.closedCallback();
		  });
	},
	/*
	 * 数组去重复
	 */
	_unique: function(arrs) {
		var obj = {},
			newArrs = [];
		for(var i = 0, ilen = arrs.length; i < ilen; i++) {
			if(obj[arrs[i]] != 1) {
				newArrs.push(arrs[i]);
				obj[arrs[i]] = 1;
			}
		}
		return newArrs;
	},
	/*
	 * 输入框多选操作
	 */
	_manySelect: function(targetParent) {
		var self = this,
			_config = self.config,
			_cache = self.cache;
		if(_cache.inputArrs.length > 0) {
			$(_config.targetCls,targetParent).val(_cache.inputArrs.join(','));
		}
	},
	/*
     * 判断是否是string
     */
     _isString: function(str) {
        return Object.prototype.toString.apply(str) === '[object String]';
     },
    /*
     * JS 动态添加css样式
     */
    _addStyleSheet: function(refWin, cssText, id){
       
        var self = this;
        if(self._isString(refWin)) {
            id = cssText;
            cssText = refWin;
            refWin = window;
        }
        refWin = $(refWin);
        var doc = document;
        var elem;

        if (id && (id = id.replace('#', ''))) {
            elem = $('#' + id, doc);
        }

        // 仅添加一次，不重复添加
        if (elem) {
            return;
        }
       //elem = $('<style></style>'); 不能这样创建 IE8有bug
        elem =  document.createElement("style");
        // 先添加到 DOM 树中，再给 cssText 赋值，否则 css hack 会失效
        $('head', doc).append(elem);
		
        if (elem.styleSheet) { // IE
            elem.styleSheet.cssText = cssText;
        } else { // W3C
            elem.appendChild(doc.createTextNode(cssText));
        }
    },
	/*
	 * 销毁操作 释放内存
	 */
	destory: function() {
		var self = this,
			_config = self.config,
			_cache = self.cache;
		_cache.ret  = [];
		_cache.currentIndex = 0;
		_cache.oldIndex = 0;
		_cache.inputArrs = [];
		_config.targetCls = null;
	}
 };
 // 初始化
 $(function(){
    var auto = new AutoComplete({
       // url: '/rocky/commonservice/user/find.json'
    }); 
 });
