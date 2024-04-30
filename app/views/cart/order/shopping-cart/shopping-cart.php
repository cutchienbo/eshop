<?php

$sum_of_cost = 0;
// echo '<pre>';
// print_r($data);
// echo '</pre>';
?>

<div class="shopping-cart section">
	<div class="container">
		<div class="all-order">
			<a href=<?php echo _WEB_ROOT . '/cart/orders' ?>>
				All Order
				<?php echo '(' . $data['orders']['count_order'] . ')' ?>
			</a>
		</div>
		<div class="row">
			<div class="col-12">



				<!-- Shopping Summery -->
				<table class="table shopping-summery">
					<thead>
						<tr class="main-hading">
							<th>PRODUCT</th>
							<th>NAME</th>
							<th class="text-center">COLOR</th>
							<th class="text-center">SIZE</th>
							<th class="text-center">UNIT PRICE</th>
							<th class="text-center">QUANTITY</th>
							<th class="text-center">TOTAL</th>
							<?php if ($data['orders']['status'] == '0' || $data['orders']['status'] == '') { ?>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							<?php } ?>
						</tr>
					</thead>
					<tbody>

						<?php
						if ($data['orders']['status'] == '0') {
							foreach ($data['orders']['product_list'] as $key => $value) {
						?>

								<tr>
									<td class="image" data-title="No">
										<img src=<?php echo $value['id_image'][0] ?> alt="#">
									</td>
									<td class="product-des" data-title="Description">
										<p class="product-name">
											<a href="#">
												<?php echo $this->view->name_upper($value['name']) ?>
											</a>
										</p>
									</td>
									<td class="product-color" data-title="Color">
										<div style="background-color:#<?php echo $value['color'] ?>">
										</div>
									</td>
									<td class="product-size" data-title="Size">
										<p>
											<a href="#">
												<?php echo $value['size'] ?>
											</a>
										</p>

									</td>
									<td class="price" data-title="Price">
										<p class="price">
											<?php
											if (!empty($value['discount'])) {
												echo '<span class="discount">' .
													'$' . ($value['cost'] * (100 - $value['discount']) / 100) . ' 
                                            </span>';
												echo '<s>' . '$' . $value['cost']  . '</s>';
											} else {
												echo '<span>$' . $value['cost'] . '</span>';
											}
											?>
										</p>
									</td>
									<td class="qty" data-title="Qty"><!-- Input Order -->
										<div class="cart-product-quantity">

											<a href=<?php
													$path = $data['orders']['id_cart'] . '-' . $data['orders']['id_customer'] . '-' . $value['id'] . '-' . $value['quantity'] . '-0';
													echo _WEB_ROOT . '/cart/change_quantity/' . $path;
													?>>
												<i class="ti-minus"></i>
											</a>

											<p>

												<?php echo $value['quantity'] ?>

											</p>

											<a href=<?php
													$path = $data['orders']['id_cart'] . '-' . $data['orders']['id_customer'] . '-' . $value['id'] . '-' . $value['quantity'] . '-1';
													echo _WEB_ROOT . '/cart/change_quantity/' . $path;
													?>>
												<i class="ti-plus"></i>
											</a>

										</div>
										<!--/ End Input Order -->
									</td>
									<td class="total-amount" data-title="Total">
										<span>
											<?php
											$cost = $value['quantity'] * ($value['cost'] * (100 - $value['discount']) / 100);
											$sum_of_cost += $cost;
											echo '$' . $cost
											?>
										</span>
									</td>
									<td class="action" data-title="Remove">
										<a href=<?php
												$path = $data['orders']['id_cart'] . '-' . $data['orders']['id_customer'] . '-' . $value['id'];
												echo _WEB_ROOT . '/cart/delete/' . $path;
												?>>
											<i class="ti-trash remove-icon"></i>
										</a>
									</td>
								</tr>

							<?php
							}
						} else {
							foreach ($data['orders']['product_list'] as $key => $value) {
							?>

								<tr>
									<td class="image" data-title="No">
										<img src=<?php echo $value['id_image'][0]  ?> alt="#">
									</td>
									<td class="product-des" data-title="Description">
										<p class="product-name">
											<a href="#">
												<?php echo $this->view->name_upper($value['name']) ?>
											</a>
										</p>
									</td>
									<td class="product-color" data-title="Color">
										<div style="background-color:#<?php echo $value['color'] ?>">
										</div>
									</td>
									<td class="product-size" data-title="Size">
										<p>
											<a href="#">
												<?php echo $value['size'] ?>
											</a>
										</p>

									</td>
									<td class="price" data-title="Price">
										<p class="price">
											<?php
											if (!empty($value['discount'])) {
												echo '<span class="discount">' .
													'$' . ($value['cost'] * (100 - $value['discount']) / 100) . ' 
                                            </span>';
												echo '<s>' . '$' . $value['cost']  . '</s>';
											} else {
												echo '<span>$' . $value['cost'] . '</span>';
											}
											?>
										</p>
									</td>
									<td class="qty" data-title="Qty"><!-- Input Order -->
										<div>
											<p>
												<?php echo $value['quantity'] ?>
											</p>
										</div>
										<!--/ End Input Order -->
									</td>
									<td class="total-amount" data-title="Total">
										<span>
											<?php
											$cost = $value['quantity'] * ($value['cost'] * (100 - $value['discount']) / 100);
											$sum_of_cost += $cost;
											echo '$' . $cost
											?>
										</span>
									</td>
								</tr>

						<?php }
						} ?>

					</tbody>
				</table>
				<!--/ End Shopping Summery -->
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<!-- Total Amount -->
				<div class="total-amount">

					<?php if ($data['orders']['status'] == '0') { ?>
						<div class="row">
							<div class="col-lg-8 col-md-5 col-12">
								<div class="left ">
									<div class="coupon">
										<form class="form order-info" method="post" action=
											<?php
												$path = $data['orders']['id_cart'] . '-' . $data['orders']['id_customer'] . '-' . $sum_of_cost;
												echo _WEB_ROOT . '/cart/insert_order/' . $path;
											?> 
										id="info-form">

											<div>
												<div class="form-group">
													<label>Receiver Name<span>*</span></label>
													<input value="<?php echo $_SESSION['id_customer']['name'] ?>" type="text" name="receiver_name" placeholder="" required="required">
												</div>

												<div class="form-group">
													<label>Phone number<span>*</span></label>
													<input value="<?php echo isset($_SESSION['id_customer']['phone_number'])?$_SESSION['id_customer']['phone_number']:'' ?>" type="number" name="receiver_phone_number" placeholder="" required="required">
												</div>
											</div>

											<div class="form-group">
												<label>
													Location
													<span>*</span>
													<a href=<?php echo _WEB_ROOT.'/profile/edit_address' ?>><i class="ti-pencil-alt"></i></a>
												</label>
												<textarea name="receiver_location" id="" cols="30" rows="6"><?php echo $data['orders']['address'] ?></textarea>
											</div>

										</form>
										<form action="#" target="_blank">
											<input name="Coupon" placeholder="Enter Your Coupon">
											<button class="btn">Apply</button>
										</form>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li>
											Cart Subtotal
											<span>
												<?php echo '$' . $sum_of_cost  ?>
											</span>
										</li>

										<li>Coupon<span>$0</span></li>

										<li>Shipping<span>Free</span></li>

										<li class="last">
											You Pay
											<span>
												<?php echo '$' . $sum_of_cost  ?>
											</span>
										</li>
									</ul>
									<div class="button5">
										<?php if ($_SESSION['id_customer']['verify']) { ?>
											<button class='btn' type='submit' form=<?php
																					if ($data['orders']['product_list'] != []) {
																						echo 'info-form';
																					}
																					?>>
												Pay
											</button>
										<?php } else { ?>
											<a href=<?php
													echo _WEB_ROOT . '/profile' . '/' . $_SESSION['id_customer']['id']
													?> class="btn">
												Pay
											</a>
										<?php } ?>
										<a href=<?php echo _WEB_ROOT . '/product' ?> class="btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					<?php } else if ($data['orders']['status'] < 3 && $data['orders']['status'] > 0) { ?>

						<div class="cancel-order">
							<a href=<?php echo _WEB_ROOT . '/cart/cancel_order/' . $data['orders']['id_cart'] . '-' . $data['orders']['id_customer'] ?>>Cancel</a>
						</div>

					<?php } ?>

				</div>
				<!--/ End Total Amount -->
			</div>
		</div>
	</div>
</div>