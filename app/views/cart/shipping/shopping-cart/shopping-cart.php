<div class="shopping-cart section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<!-- Shopping Summery -->
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>RECEIVER</th>
							<th>PHONE</th>
							<th class="text-center">LOCATION</th>
							<th class="text-center">COST</th>
							<th class="text-center">STATUS</th>
							<th class="text-center">DETAIL</th>
							<th class="text-center">EDIT</th>
						</tr>
					</thead>
					<tbody>

						<?php foreach ($data['order_list'] as $key => $value) { ?>

							<tr>
								<td class="" data-title="Receiver">
									<?php echo $value['receiver'] ?>
								</td>
								<td class="" data-title="Phone">
									<?php echo $value['phone_number'] ?>
								</td>
								<td class="" data-title="Location">
									<?php echo $value['location'] ?>
								</td>
								<td class="" data-title="Total">
									<?php echo '$' . $value['cost'] ?>
								</td>
								<td class="" data-title="Status">
									<?php 
										switch($value['status']){
											case 1:echo 'pending'; break;
											case 2:echo 'preparing';break;
											case 3:echo 'delivering';break;
											case 4:echo 'delivered';
										}
									?>
								</td>
								<td class="detail-order" data-title="Detail">
									<a href=<?php echo _WEB_ROOT.'/cart'.'/'.$value['id_cart'] ?>>
										<i class="ti-info-alt"></i>
									</a>
								</td>
								<td class="detail-order" data-title="Detail">
									<a href=<?php echo _WEB_ROOT.'/cart'.'/edit_order'.'/'.$value['id_cart'].'/'.$_SESSION['id_customer']['id'] ?>>
										<i class="ti-pencil-alt"></i>
									</a>
								</td>
							</tr>

						<?php } ?>

					</tbody>
				</table>
				<!--/ End Shopping Summery -->
			</div>
		</div>
		
	</div>
</div>