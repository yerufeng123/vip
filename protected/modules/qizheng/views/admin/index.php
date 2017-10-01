<?php $this->renderPartial("/public/head") ?>
<?php $this->renderPartial("/public/lefter") ?>
<div class="cont_right">
					<div class="cont_right_page1">
						<span><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_place.png" />您当前位置：<span>管理员管理</span></span>
					</div>
					<div class="cont_right_page2">
						<form action="/qizheng/admin/admin_add?model=1" method="POST">
                                            <input type="submit" value="添加"/>
                            </form>
					</div>
					<div class="cont_right_page3">
						<table cellspacing="0" cellpadding="0" >
							<thead>
								<th>序号</th>
								<th>姓名</th>
								<th>角色</th>
								<th>性别</th>
								<th>QQ</th>
								<th>手机</th>
								<th>住址</th>
								<th>创建时间</th>
                                                                <th>启用状态</th>
                                                                <th>操作</th>
							</thead>
							 <?php if (isset($list) && is_array($list)): ?>
                                    <?php foreach ($list as $key => $value): ?>
							<tr>
								<td><?php echo $key + 1; ?></td>
								<td><?php echo $value['name'] ?></td>
								<td><?php
                                                            if ($value['role'] == '1') {
                                                                echo '超级管理员';
                                                            } elseif ($value['role'] == '2') {
                                                                echo '普通管理员';
                                                            } else {
                                                                echo '未知';
                                                            }
                                                            ?></td>
								<td><?php if($value['sex'] == '1'){echo '男';}elseif($value['sex'] == '2'){echo '女';}else{echo '未知';}?></td>
								<td><?php echo $value['qq'];?></td>
								<td><?php echo $value['phone']?></td>
								<td><?php if(mb_strlen($value['address']) > 20){echo msubstr($value['address'],0,20);}else{echo $value['address'];};?></td>
                                                                <td><?php echo date('Y-m-d H:i:s',$value['ctime'])?></td>
                                                                <td><?php if($value['enable'] == 0){echo '<font color="red">未启用</font>';}else{echo '<font color="green">启用</font>';}?></td>
								<td>
									<div>
										<span class="compile"><a href="/qizheng/admin/admin_editor?id=<?php echo $value['id']; ?>&model=1"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_compile.png" /></a></span>
										<span class="del"><a href="/qizheng/admin/admin_delete?id=<?php echo $value['id'];?>&model=1"><img src="<?php echo _STATIC_ . 'vip/qizheng/admin1/'; ?>img/icon_error.png" /></a></span>
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
