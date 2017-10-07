$(document).ready(function(){
    //静态资源地址前缀
    var _baseUrl = './';
    var _baseImgUrl = _baseUrl + 'img/';
    var _baseMusicUrl = _baseUrl + 'music/';
    //请求地址前缀
    var _ajaxUrl = 'http://vip.jellyideas.net/guanzhi/guanzhi';

    var _loadText = $('.load_text');
    var load = window.repload({
        list:[
            'index_bg.jpg','page1_bg.jpg','page2_bg.jpg','page3_bg.jpg','load_bg.jpg',
            'car1.png','car2.png','car3.png','car4.png','car5.png','carMask.png',
            'close.png','index_t1.png','index_t2.png',
            'l1.png','l2.png','l3.png','l4.png','r1.png','r2.png','r3.png','r4.png','r5.png','r6.png',
            'index_r1.png','index_r2.png','index_r3.png','index_r4.png','index_l1.png','index_l2.png','index_l3.png','index_l4.png',
            'logo.png','music.png','route.jpg','share.png'
        ],
        base:_baseImgUrl,
        Callback:function(e){
            var deg = e.msg.index / e.msg.sum * 100;
            _loadText.html(Math.ceil(deg)+"%");
            if(deg === 100){
                $('#load').hide();
                $('#main').show();
                var createPage = new page();
            }
        },
        tryNum:2,
    });
    var page = function(){
        var self = this;
        this.info = {
            level:1,
            answer:0,
            score:0,
            state:null,
            questions:{
                1: [
                  {
                    "id": "2",
                    "question": "观致汽车的英文品牌名称为？",
                    "options": [
                      "GuanZhi",
                      "GZQC",
                      "Qoros",
                      "GZAUTO"
                    ],
                    "answer": "3",
                    "type": "1",
                    "created_at": "1507078183",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "6",
                    "question": "歌手刀郎出道时有一首很红的歌曲，歌词是形容哪一年的第一场雪？",
                    "options": [
                      "2000年",
                      "2001年",
                      "2002年",
                      "2004年"
                    ],
                    "answer": "3",
                    "type": "1",
                    "created_at": "1507078183",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "7",
                    "question": "歌曲《敢问路在何方》，在影视剧中，是以哪一个角色的口吻演唱的?",
                    "options": [
                      "唐三藏",
                      "猪八戒",
                      "白龙马",
                      "沙和尚"
                    ],
                    "answer": "2",
                    "type": "1",
                    "created_at": "1507078183",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  }
                ],
                2: [
                  {
                    "id": "24",
                    "question": "在汽车设计方面，出于环保和健康角度考虑，观致5SUV上没有以下哪个装置？",
                    "options": [
                      "雨刮器",
                      "点烟器",
                      "充电口",
                      "空调"
                    ],
                    "answer": "2",
                    "type": "2",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "25",
                    "question": "现在生活中常看到车尾贴壁虎的意义是什么？",
                    "options": [
                      "谐音“避祸”",
                      "谐音“必火”",
                      "好车的标志",
                      "提示后车别追尾"
                    ],
                    "answer": "1",
                    "type": "2",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "31",
                    "question": "下列哪个不属于北宋颁布的《武经七书》？",
                    "options": [
                      "《孙子兵法》",
                      "《孙膑兵法》",
                      "《六韬》",
                      "《三略》"
                    ],
                    "answer": "2",
                    "type": "2",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "33",
                    "question": "人生“四大喜事”不包含下列哪一项？",
                    "options": [
                      "洞房花烛夜",
                      ".孩子出生时",
                      "久旱逢甘霖",
                      "他乡遇故知"
                    ],
                    "answer": "2",
                    "type": "2",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  }
                ],
                3: [
                  {
                    "id": "38",
                    "question": "观致3曾经获得过的设计界大奖是？",
                    "options": [
                      "红点",
                      "绿点",
                      "蓝点",
                      "紫点"
                    ],
                    "answer": "1",
                    "type": "3",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "45",
                    "question": "北半球一年中白天最短、夜晚最长的一天，是24节气中的哪个节气？",
                    "options": [
                      "春分",
                      "夏至",
                      "秋分",
                      "冬至"
                    ],
                    "answer": "4",
                    "type": "3",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "48",
                    "question": "游戏《王者荣耀》开局时队友经常发的“猥琐发育”的下半句是什么？",
                    "options": [
                      "浪里个浪",
                      "我们能赢",
                      "撤退",
                      "别浪"
                    ],
                    "answer": "4",
                    "type": "3",
                    "created_at": "1507079989",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "56",
                    "question": "在CBA联赛中，以东北虎命名的是我国哪个城市的篮球俱乐部?",
                    "options": [
                      "哈尔滨",
                      "吉林",
                      "上海",
                      "北京"
                    ],
                    "answer": "2",
                    "type": "3",
                    "created_at": "1507084355",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  },
                  {
                    "id": "60",
                    "question": "在NBA中，被称为“篮板破坏王”的是？",
                    "options": [
                      "姚明",
                      "杜兰特",
                      "奥尼尔",
                      "哈登"
                    ],
                    "answer": "3",
                    "type": "3",
                    "created_at": "1507084355",
                    "created_by": "1",
                    "updated_at": "0",
                    "updated_by": "0"
                  }
                ]
              },
            phone:"",
            goods:{
                0:'腾讯视频会员',
                1:'JBL音响',
                2:'iPhone8',
            }
        };
        this.getQuestion(0,function(e){
            if(e.code === '10000'){
                self.info.questions = e.data;
                self.init();
            }
        });
    };
    page.prototype = {
        init:function(){
            this.render('index');
            this.bindEvent();
            this.loadMusic();
        },
        //获取问题
        getQuestion:function(lv,callback){
            var data = {};
            if(lv){
                data.level = lv;
            }
            $.ajax({
                url:_ajaxUrl+'/questions',
                dataType:'jsonp',
                type:'GET',
                data:data,
                error:callback,
                success:callback
            });
        },
        render:function(type,msg){
            var _temp = '',self = this;
            switch(type){
                case 'question':{
                    _temp = this.renderQuestion();
                }break;
                case 'index':{
                    _temp = this.renderIndex();
                    $('#index').show().html(_temp);
                    return false;
                }break;
                case 'success':{
                    _temp = this.renderResult('success');
                }break;
                case 'fail':{
                    _temp = this.renderResult('fail');
                }break;
                case 'lottery':{
                    _temp = this.renderLottery('success',msg);
                }break;
                case 'none':{
                    _temp = this.renderLottery('fail',msg);
                }break;
                case 'setInfo':{
                    _temp = this.renderSetInfo(this.info.state);
                }break;
                default :{
                    _temp = this.renderLoad();
                    $('.question_lights').hide();
                    $('.question_cars').hide();
                    $('.qusetion_bg').attr('src',_baseImgUrl + 'page'+this.info.level+'_bg.jpg');
                    setTimeout(function(){
                        $('.question_lights').show();
                        $('.question_cars').show();
                        self.render('question');
                    },4000);
                }break;
            }
            $('#cnt').html(_temp);
        },
        //绑定页面事件
        bindEvent:function(){
            var self = this;
            $('#main').on('click','.index_close',function(){
                $('.index_rule').hide();
            }).on('click','[data-js=start]',function(){
                $('#index').remove();
                $('#question').show();
                self.info.score = 0;
                self.info.level = 1;
                self.info.answer = 0;
                self.render('load');
            }).on('click','[data-js=rule]',function(){
                $('.index_rule').show();
            }).on('click','.question_item',function(){
                var _index = $(this).index();
                self.answer(_index);
            }).on('click','[ date-js=option]',function(){
                if(!$(this).hasClass('select')){
                    $(this).addClass('select').siblings('.select').removeClass('select');
                    $('.question_select_head .question_select_cnt').html($(this).find('.question_select_cnt').html());
                }
            }).on('click','[data-js=code]',function(){
                var _html = $(this).html(),that = this;
                var _phone = $('#phone').val();
                if(!self.isPhone(_phone)){
                    self.tips('请输入正确的手机号');
                    return false;
                }
                if(_html === "获取验证码"){
                    var _time = 60,timer = null;
                    $.ajax({
                        url:_ajaxUrl + '/sendcode',
                        dataType:'jsonp',
                        type:'GET',
                        data:{
                            phone:_phone
                        },
                        error:callback,
                        success:callback
                    });
                }
                function callback(e){
                    if(e.code === '10000'){
                        $(that).html(_time+'秒');
                        timer = setInterval(function(){
                            _time--;
                            if(_time === 0){
                                $(that).html('获取验证码');
                                clearInterval(timer);
                            }else{
                                $(that).html(_time+'秒');
                            }
                        },1000);
                    }else{
                        self.tips(e.msg);
                    }
                    
                }
            }).on('click','[date-js=submit_info]',function(){
                var data = {};
                data.name = $('#name').val();
                data.phone = $('#phone').val();
                data.code = $('#code').val();
                data.city = $('#city').val();
                data.intention = $('.question_form_option.select').index()-1;
                data.level = self.info.level||1;
                data.score = self.info.score||0;
                if(!data.name){
                    self.tips('请输入姓名');
                    return false;
                }else if(!(data.phone&&self.isPhone(data.phone))){
                    self.tips('请输入正确的手机号');
                    return false;
                }else if(!data.code){
                    self.tips('请输入正确的验证码');
                    return false;
                }else if(!data.city){
                    self.tips('请输入你所在的城市');
                    return false;
                }else if(!data.intention){
                    self.tips('请选择试驾意愿');
                    return false;
                }
                $.ajax({
                    url:_ajaxUrl + '/register',
                    dataType:'jsonp',
                    type:'GET',
                    data:data,
                    error:callback,
                    success:callback
                });
                function callback(e){
                    if(e.code === '10000'){
                        if(self.info.state === 'success'){
                            $.ajax({
                                url:_ajaxUrl + '/lottery',
                                dataType:'jsonp',
                                type:'GET',
                                data:{
                                    level:self.info.level + 1,
                                    phone:data.phone,
                                },
                                error:callbackLottery,
                                success:callbackLottery
                            });
                        }else{
                            window.location.reload();
                        }
                    }else{
                        self.tips(e.msg);
                    }
                    function callbackLottery(e){
                        if(e.code === '10000'){
                            self.render('lottery',e);
                        }else{
                            self.render('none',e);
                        }
                    }
                }
            }).on('click','[data-question]',function(){
                var _type = $(this).attr('data-question');
                self.info.answer = 0;
                self.info.state = null;
                if(_type === 'again'){
                    self.info.level = 1;
                    self.info.score = 0;
                    self.getQuestion(0,function(e){
                        if(e.code === '10000'){
                            self.info.questions = e.data;
                            self.render('load');
                        }
                    });
                }else if(_type === 'continue'){
                    self.info.level++;
                    self.render('load');
                }
                
            }).on('click','[data-info]',function(){
                var _type = $(this).attr('data-info');
                self.info.state = _type;
                self.render('setInfo');
            }).on('click','[data-js=share]',function(){
                $('.question_share').show();
            }).on('click','.question_share',function(){
                $(this).hide();
            }).on('click','.question_select_head',function(){
                $(this).parent('.question_selection').toggleClass('show');
            });
        },
        //回答
        answer:function(_index){
            _index++;
            var _info = this.info;
            var _questions = _info.questions[_info.level - 1];
            if(_questions[_info.answer].answer == _index){
                //回答正确
                this.info.score += 10;
                if(_info.answer >= _questions.length - 1){
                    //闯关成功
                    _info.answer++;
                    this.info.state = 'success';
                    this.render('success');
                }else{
                    //继续答题
                    _info.answer++;
                    this.info.state = null;
                    this.render('question');
                }
            }else{
                //回答错误
                this.info.state = 'fail';
                this.render('fail');
            }
        },
        //加载音乐
        loadMusic:function(){
            var _music = document.createElement('audio');
            _music.autoplay = 'autoplay';
            _music.src = _baseMusicUrl + 'bg.mp3';
            _music.loop = 'loop';
            var $music = $('#music');
            _music.addEventListener('load',function(){
                _music.play();
                //没有自动播放，点击页面播放音乐
                if(_music.paused){
                    $(document).one('click',function(){
                        _music.play();
                    });
                }
            });
            _music.addEventListener('playing',function(){
                $('#music').addClass('playing');
            });
            _music.addEventListener('pause',function(){
                $('#music').removeClass('playing');
            });
            $('#music').on('click',function(){
                if(_music.paused){
                    _music.play();
                }else{
                    _music.pause();
                }
            });
        },
        renderIndex:function(){
            var _temp = '<div id="index" class="page">\
                            <div class="index_page" style="background-image:url('+_baseImgUrl+'index_bg.jpg)">\
                                <div class="index_route"></div>\
                                <div class="index_lights lights">\
                                    <img class="light18" src="'+_baseImgUrl+'index_r4.png">\
                                    <img class="light17" src="'+_baseImgUrl+'index_r3.png">\
                                    <img class="light16" src="'+_baseImgUrl+'index_r2.png">\
                                    <img class="light15" src="'+_baseImgUrl+'index_r1.png">\
                                    <img class="light14" src="'+_baseImgUrl+'index_l4.png">\
                                    <img class="light13" src="'+_baseImgUrl+'index_l3.png">\
                                    <img class="light12" src="'+_baseImgUrl+'index_l2.png">\
                                    <img class="light11" src="'+_baseImgUrl+'index_l1.png">\
                                </div>\
                                <div class="index_cars cars">\
                                    <img class="car5" src="'+_baseImgUrl+'car5.png">\
                                    <img class="car4" src="'+_baseImgUrl+'car4.png">\
                                    <img class="car3" src="'+_baseImgUrl+'car3.png">\
                                    <img class="car2" src="'+_baseImgUrl+'car2.png">\
                                    <img class="car1" src="'+_baseImgUrl+'car1.png">\
                                </div>\
                                <img class="index_t1" src="'+_baseImgUrl+'index_t1.png">\
                                <img class="index_t2" src="'+_baseImgUrl+'index_t2.png">\
                                <div class="index_btns">\
                                    <div class="index_btn" data-js="start">开始挑战</div><div class="index_btn" data-js="rule">游戏规则</div>\
                                </div>\
                            </div>\
                            <div class="index_rule">\
                                <img class="index_close" src="'+_baseImgUrl+'close.png">\
                                <h3>《疯狂大爬梯》是一档全家总动员汽车益智挑战真人秀节目，节目因购观致汽车答题有机会开走百万豪车的亮点而备受关注。想知道你与百万豪车的缘分吗？快来挑战测试一下吧！</h3>\
                                <dl class="index_list">\
                                    <dt>游戏规则:</dt>\
                                    <dd class="index_li">游戏共三道关卡，第一关3题，第二关4题，第三关5 题。每闯过一关，可选择抽奖或继续答题。</dd>\
                                    <dd class="index_li">选择抽奖则无法进入下一关，或不抽奖可以继续答题并有机会冲击大奖。</dd>\
                                    <dd class="index_li">抽奖后可重复玩游戏答题，但每个用户只有一次抽奖机会。</dd>\
                                </dl>\
                                <dl>\
                                    <dt>奖品设置:</dt>\
                                    <dd>一等奖iphone8；</dd>\
                                    <dd>二等奖JBL音响；</dd>\
                                    <dd>三等奖腾讯视频18天会员。</dd>\
                                </dl>\
                                <dl>\
                                    <dt>活动时间：</dt>\
                                    <dd>截止到2017年10月13日</dd>\
                                </dl>\
                                <div class="rule_tips">本活动最终解释权归观致汽车所有</div>\
                            </div>\
                        </div>';
            return _temp;
        },
        renderLoad:function(){
            var _tit = '';
            var _num = '';
            switch(this.info.level){
                case 1:{_tit = '小试身手';_num = 3;}break;
                case 2:{_tit = '进击之战';_num = 4;}break;
                default:{_tit = '登封一役';_num = 5;}
            }
            var _temp = '<img src="'+_baseImgUrl+'load_bg.jpg" class="qusetion_bg_load">\
                            <img src="'+_baseImgUrl+'carMask.png" class="car_mask">\
                            <div class="question_tit">\
                                Round <span>'+ this.info.level +'</span>\
                                <p>'+ _tit +'</p>\
                            </div>\
                            <div class="question_des">\
                                答对'+ _num +'题即为闯关成功<br/>\
                                有机会抽取'+ this.info.goods[this.info.level - 1]  +'\
                            </div>\
                            <div class="question_wait">\
                                题库生成中……<br/>\
                                百万豪车已就位……\
                            </div>';
            return _temp;
        },
        renderQuestion:function(){
            var _info = this.info;
            var _question = _info.questions[_info.level - 1][_info.answer];
            var _answer = _info.answer + 1;
            var _temp =    '<div class="question_subject">'+ _answer + '、' + _question.question +'</div>\
                            <ul class="question_option">\
                                <li class="question_item">A '+_question.options[0]+'</li>\
                                <li class="question_item">B '+_question.options[1]+'</li>\
                                <li class="question_item">C '+_question.options[2]+'</li>\
                                <li class="question_item">D '+_question.options[3]+'</li>\
                            </ul>';
            return _temp;
        },
        renderResult:function(sign){
            var _score = this.info.score, _tit = "", _btns = "", _tip =  "", _lev = "二";
            if(this.info.level == 2){
                _lev = "三";
            }
            if(sign !== 'fail'){
                if(this.info.level == 3){
                    _tit = '<h2>闯关成功!</h2>\
                        你得了'+_score+'分\
                        <div>你就是下一个百万豪车车主!</div>';
                    _btns = '<li class="question_btn" data-info="success">抽大奖~</li>';
                }else{
                    _tit = '<h2>闯关成功!</h2>\
                        你得了'+_score+'分\
                        <div>继续前进离百万豪车很接近哦</div>';
                    _btns = '<li class="question_btn" data-question="continue">跳转第'+ _lev +'关进击大奖！</li>\
                        <li class="question_btn" data-info="success">放弃挑战 马上领奖~</li>';
                }
                
            }else{
                _tit = '你得了'+ _score +'分<p>今晚骑骑共享单车也不错</p>';
                _btns = '<li class="question_btn" data-question="again">不服再战</li>\
                        <li class="question_btn" data-js="share">测试朋友的智商</li>\
                        <li class="question_btn" data-info="fail">领安慰奖</li>';
                _tip = '<p class="question_over">GAME OVER</p>';
            }

            var _temp = '<div class="question_info">\
                            <div class="question_result">'+ _tit +'</div>\
                            <ul class="question_btns">'+ _btns +'</ul>\
                        </div>'+ _tip +'\
                        <div class="question_tip">购买观致汽车<br/>去《疯狂大爬梯》现场放手一搏吧！</div>';
            return _temp;
        },
        renderSetInfo:function(sign){
            var _tit ='<div class="question_form_tit">填写信息，即可开始抽奖</div>',_btn = '提交去抽奖';
            if(sign === 'fail'){
                _tit = '<div class="question_form_tit" style="font-size:28px">填写信息，前往就近的观致4S店<br/>试驾可领取礼品一份</div>';
                _btn = '提交';
            }
            var _temp = '<div class="question_form">'+ _tit +'\
                            <div class="question_form_item">\
                                <label class="question_form_lab" for="name">姓 名</label>\
                                <input class="question_form_input" placeholder="请输入姓名" type="text" id="name">\
                            </div>\
                            <div class="question_form_item">\
                                <label class="question_form_lab" for="phone">手 机</label>\
                                <input class="question_form_input" placeholder="请填写有效手机号码" type="text" id="phone">\
                            </div>\
                            <div class="question_form_test">\
                                <input class="question_form_labArea" placeholder="输入验证码" type="text" id="code">\
                                <div class="question_form_inputArea" data-js="code" for="code">获取验证码</div>\
                            </div>\
                            <div class="question_form_item">\
                                <label class="question_form_lab" for="city">城 市</label>\
                                <input class="question_form_input" placeholder="请填写你所在地"  type="text" id="city">\
                            </div>\
                            <div class="question_selection">\
                                <div class="question_select_head">\
                                    <div class="question_select_cnt">下拉菜单选项：有无试驾意愿？</div>\
                                </div>\
                                <div class="question_select_body">\
                                <div class="question_form_option" date-js="option">\
                                    <div class="question_select_cnt">本月内有意向</div>\
                                </div>\
                                <div class="question_form_option" date-js="option">\
                                    <div class="question_select_cnt">3个月内有意向</div>\
                                </div>\
                                <div class="question_form_option select" date-js="option">\
                                    <div class="question_select_cnt">半年内无购车意向</div>\
                                </div>\
                                </div>\
                            </div>\
                            <p class="question_form_tip">活动期间，购买观致汽车可享受最高降幅达2-3万元的惊喜特惠价，更有机会参加《疯狂大爬梯》答题闯关开走百万豪车！购车承诺区域交车、售后服务“零忧虑”。</p>\
                            <div class="question_form_submit" date-js="submit_info">'+ _btn +'</div>\
                        </div>';
            return _temp;
        },
        renderLottery:function(type,info){
            var _temp = '';
            if(type === 'success'){
                var lotteryInfo = "";
                if(e.data.ranking == 3){
                    lotteryInfo = '你抽中了人人都想要的<br/>腾讯视频18天会员！<br/>兑换码:<br/>'+e.data.coupon;
                }else if(e.data.ranking == 2){
                    lotteryInfo = '你抽中了bigger不一般的<br/>JBL音响一枚！<br/>奖品即将寄出，<br/>=请耐心等待工作人员与你联系！';
                }else{
                    lotteryInfo = '你抽中了iphone8！<br/>奖品即将寄出，<br/>请耐心等待工作人员与你联系！';
                }
                _temp = '<h3 class="question_lottery_tit">恭喜</h3>\
                            <div class="question_lottery_cnt">'+ lotteryInfo +'</div>\
                            <ul class="question_btns">\
                                <li class="question_btn" data-js="share">叫小伙伴来试试</li>\
                            </ul>';
            }else{
                _temp = '<h3 class="question_lottery_tit">很遗憾</h3>\
                        <div class="question_lottery_cnt question_lottery_fail">\
                            差一点就能抽中了！\
                        </div>\
                        <ul class="question_btns">\
                            <li class="question_btn" data-js="share">叫小伙伴来试试</li>\
                        </ul>';
            }
            _temp = '<div class="question_lottery">'+ _temp +'</div>\
                    <div class="question_tip">购买观致汽车<br/>去《疯狂大爬梯》现场放手一搏吧！</div>';
            return _temp;
        },
        isPhone:function(str){
            var reg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/; 
            if(str&&reg.test(str)){
                return true;
            }else{
                return false;
            }
        },
        tips:function(str){
            var _temp = $('<div class="tips">'+ str +'</div>');
            $('#tips').html(_temp);
            setTimeout(function(){
                _temp.remove();
            },2000)
        }
    };


    
})