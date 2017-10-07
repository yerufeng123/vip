(function(globel,undefined){
    globel.repload = function(opt){

        // opt:
        // list加载图片地址,
        // base:地址前缀,
        // limit:最多同时加载数量,
        // Callback:加载回调(是否成功,进度，图片地址),
        // tryNum:加载失败重新尝试次数
        opt.list = opt.list ||[];
        //opt.limit = opt.limit ||1;
        opt.tryNum = opt.tryNum ||2;
        var max = opt.list.length;
        var index = 0;
        function imgLoad(){
            var _tryNum = 0;
            var src = opt.base + opt.list[index];
            var _img = document.createElement('img');
            
            
            
            _img.addEventListener('load',function(){
                opt.Callback({
                    type:'success',
                    msg:{
                        'src':src,
                        'index':index + 1,
                        'sum':max
                    }
                });
                index++;
                if(index < max){
                    imgLoad();
                }
            });
            _img.addEventListener('error',function(){
                if(_tryNum < opt.tryNum){
                    _tryNum++;
                    _img.src = src+'?' + Math.random();
                }else{
                    opt.Callback({
                        type:'fail',
                        msg:{
                            'src':src,
                            'index':index + 1,
                            'sum':max
                        }
                    });
                    index++;
                    if(index < max){
                        imgLoad();
                    }
                }
            });
            _img.src = src;
        }
        imgLoad();
    }
})(window,undefined)