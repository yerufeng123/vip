<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>
<div class="cont_right">
					<div class="cont_right_page1">
						<span><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_place.png" />您当前位置：<span>渠道管理</span></span>
					</div>
					<div class="cont_right_page2">
						<form action="/bairong/admin/style_add?model=1" method="POST">
                                            <input type="submit" value="添加"/>
                            </form>
					</div>
					<div class="cont_right_page3">
						<table cellspacing="0" cellpadding="0" >
							<thead>
								<th>序号</th>
								<th>渠道名称</th>
                                                                <th>操作</th>
							</thead>
							 <?php if (isset($list) && is_array($list)): ?>
                                    <?php foreach ($list as $key => $value): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $value['name'] ?></td>
								
								<td>
									<div>
										<span class="compile"><a href="/bairong/admin/style_editor?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_compile.png" /></a></span>
										<span class="del"><a href="/bairong/admin/style_delete?id=<?php echo $value['id'];?>&model=1"><img src="<?php echo _STATIC_ . 'vip/bairong/admin1/'; ?>img/icon_error.png" /></a></span>
									</div>
								</td>
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
