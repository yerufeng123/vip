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
								<th>用户游戏关数</th>
								<th>用户分数</th>
								<th>奖品等级</th>
								<th>优惠券code</th>
								<th>验证码code</th>
								<th>创建时间</th>
								<th>更新时间</th>
							</thead>
							 <?php if (isset($list) && is_array($list)): ?>
                                    <?php foreach ($list as $key => $value): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $value['name'] ?></td>
								<td><?php echo $value['phone']?></td>
								<td><?php echo $value['level']?></td>
								<td><?php echo $value['score']?></td>
								<td><?php echo $value['ranking']?></td>
								<td><?php echo $value['couponCode']?></td>
								<td><?php echo $value['code']?></td>
								<td><?php echo date('Y-m-d',$value['created_at']);?></td>
								<td><?php echo date('Y-m-d',$value['updated_at'])?></td>
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
