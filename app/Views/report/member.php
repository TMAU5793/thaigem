<?php
	header("Content-Type: application/xls");
	header("Content-Disposition: attachment; filename=".$type.".xls");
	header("Pragma: no-cache");
	header("Expires: 0");
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-5">
					<br /><br /><br />
					<?php if($type=='member'){ ?>
						<h4>รายงานข้อมูลสมาชิกเว็บไซต์</h4>
					<?php }else{ ?>
						<h4>รายงานข้อมูลสมาชิกสมาคมฯ</h4>
					<?php } ?>
					
					<table border="1" class="table table-hover">
						<?php if($type=='member'){ ?>
							<thead>
								<tr class="info">
									<th>ชื่อ นามสกุล</th>
									<th>อีเมล</th>
									<th>สมัครผ่าน</th>
									<th>วันที่</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($info as $list){ ?>
									<tr>
										<td><?= $list['name'].' '.$list['lastname']; ?></td>
										<td><?= ($list['email']!=''?$list['email']:'-'); ?></td>
										<td><?= ($list['social_type']!=''?$list['social_type']:'เว็บไซต์') ?></td>
										<td><?= $list['created_at']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						<?php }else{ ?>
							<thead>
								<tr>
									<th>ชื่อบริษัท</th>
									<th>รหัส</th>
									<th>อีเมล</th>
									<th>เบอร์โทร</th>
									<th>การอนุมัติ</th>
									<th>วันที่</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($info as $list){ ?>
									<tr>
										<td><?= ($list['company']!=''?$list['company']:'-') ?></td>
										<td><?= ($list['dealer_code']!=''?$list['dealer_code']:'-') ?></td>
										<td style="word-break: break-word;"><?= $list['email'] ?></td>
										<td><?= ($list['phone']!=""?$list['phone']:'-') ?></td>
										<td align="center">
											<?php
												if($list['type']=='dealer' && $list['status']=='2'){
											?>
												อนุมัติ
											<?php }elseif($list['type']=='dealer' && $list['status']=='1'){ ?>
												รอดำเนินการ
											<?php }else{ ?>
												ไม่อนุมัติ
											<?php } ?>
										</td>
										<td><?= $list['created_at']; ?></td>
									</tr>
								<?php } ?>
							</tbody>
						<?php } ?>
					</table>
				</div>
			</div>
		</div>
	</body>
</html>