<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>
<div class="cont_right">
					<div class="cont_right_page1">
						<span><img src="<?php echo _STATIC_ . 'vip/jinganshun/admin1/'; ?>img/icon_place.png" />您当前位置：<span>数据统计</span></span>
					</div>
					<div class="cont_right_page2">
					</div>
					<div class="cont_right_page3">
					<!--20151029 jia add-->
						  <div class="cont_main">
                                <div class="cont_main_ps">
                                	<div class="main_one">
                                    	<h3>邀请函</h3>
                                        <ul>
                                            <li><span class="one_left">浏览量：</span><span class="one_right"><?php echo $h5viewednum;?></span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right"><?php echo $h5sharenum;?></span></li>
                                            <li><span class="one_left">传播率：</span><span class="one_right"><?php echo $h5chuanbopercent;?>%</span></li>
                                            <li><span class="one_left">留资量：</span><span class="one_right"><?php echo $h5registernum;?></span></li>
                                            <li><span class="one_left">核销量：</span><span class="one_right"><?php echo $h5hexiaonum;?></span></li>
                                        </ul>
                                        <ul>
                                           <li><span class="one_left">转化率：</span><span class="one_right"><?php echo $h5percent;?>%</span></li>
                                        </ul>
                                    </div>
                                    
                                    <div class="main_one">
                                    	<h3>集铭牌游戏</h3>
                                        <ul>
                                            <li><span class="one_left">发起量：</span><span class="one_right"><?php echo $tagsharenum;?></span></li>
                                            <li><span class="one_left">传播量：</span><span class="one_right"><?php echo $tagchuanbonum;?></span></li>
                                            <li><span class="one_left">核销量：</span><span class="one_right"><?php echo $taghexiaonum;?></span></li>
                                            <li><span class="one_left">转化率：</span><span class="one_right"><?php echo $tagpercent;?>%</span></li>
                                        </ul>
                                        <ul>
                                        </ul>
                                    </div>
                                    
                                    <!-- <div class="main_one">
                                    	<h3>竞拍游戏</h3>
                                        <ul>
                                            <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                        <ul>
                                           <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                    </div>
                                    
                                    
                                     <div class="main_one">
                                    	<h3>团购游戏</h3>
                                        <ul>
                                            <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                        <ul>
                                           <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                    </div>
                                    
                                     <div class="main_one">
                                    	<h3>秒拍游戏</h3>
                                        <ul>
                                            <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                        <ul>
                                           <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                    </div>
                                    
                                     <div class="main_one">
                                    	<h3>接圣诞礼物游戏</h3>
                                        <ul>
                                            <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                        <ul>
                                           <li><span class="one_left">浏览量浏量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">转发量：</span><span class="one_right">123301</span></li>
                                            <li><span class="one_left">转化率率：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                            <li><span class="one_left">浏览量览量：</span><span class="one_right">123</span></li>
                                        </ul>
                                    </div> -->
                                    
                                    

                                </div>
                          </div>

                        
                     <div class="cont_right_page4" style="float:right;">
				     </div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->renderPartial("/public/buttom") ?> 
