<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>
<div class="cont_right">
					<div class="cont_right_page1">
						<span><img src="<?php echo _STATIC_ . 'vip/guanzhi/admin1/'; ?>img/icon_place.png" />您当前位置：<span>管理员管理</span></span>
					</div>
					<div class="cont_right_page2">
					</div>
					<div class="cont_right_page3">
						<table cellspacing="0" cellpadding="0" >
							<thead>
								<th>序号</th>
								<th>姓名</th>
								<th>手机</th>
								<th>城市</th>
								<th>用户游戏关数</th>
								<th>用户分数</th>
								<th>奖品等级</th>
								<th>购车意愿</th>
								<th>优惠券code</th>
								<!-- <th>验证码code</th> -->
							</thead>
							 <?php if (isset($list) && is_array($list)): ?>
                                    <?php foreach ($list as $key => $value): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $value['name'] ?></td>
								<td><?php echo $value['phone']?></td>
								<td><?php echo $value['city']?></td>
								<td><?php echo $value['level']?></td>
								<td><?php echo $value['score']?></td>
								<td>
									<?php 
										if($value['ranking'] == '1'){
											echo '一等奖';
										}elseif ($value['ranking']  == '2') {
											echo '<font color="red">二等奖</font>';
										}elseif ($value['ranking'] == '3') {
											echo '<font color="green">三等奖</font>';
										}elseif ($value['ranking'] == '5') {
											echo '未中奖';
										}else{
											echo '未抽奖';
										}
									?>
								</td>
								<td>
									<?php 
										if($value['intention'] == '1'){
											echo '本月内有意向';
										}elseif ($value['intention']  == '2') {
											echo '3个月内有意向';
										}elseif ($value['intention'] == '3') {
											echo '半年内无购车意向';
										}else{
											echo '未知';
										}
									?>
								</td> 
								<td><?php echo $value['couponCode']?></td>
								<!-- <td><?php echo $value['code']?></td> -->
							</tr>
                                                        <?php endforeach; ?>
                                <?php endif; ?>
						</table>
                                            <div class="cont_right_page4" style="float:right;">
							<?php echo $page; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

<?php $this->renderPartial("/public/buttom") ?> 
