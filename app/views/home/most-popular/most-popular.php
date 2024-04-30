<!-- <?php
	echo '<pre>';
	print_r($data);
	echo '<pre>';
?> -->

<div class="product-area most-popular section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>New Item</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="owl-carousel popular-slider">

					<?php foreach ($data as $key => $value) { ?>

						<div class="single-product">
							<div class="product-img">
								<a href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>
									<img class="default-img" src=<?php echo $value['id_image'][0] ?> alt="#">
									<img class="hover-img" src=<?php
																$index = 1;
																if (!isset($value['id_image'][1])) {
																	$index = 0;
																}
																echo $value['id_image'][$index];
																?> alt="#">
								</a>
								<div class="button-head">
									<div class="product-action">
										<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
										<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
										<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
									</div>
									<div class="product-action-2">
										<a title="Add to cart" href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>Detail product</a>
									</div>
								</div>
							</div>
							<div class="product-content">
								<h3>
									<a href=<?php echo _WEB_ROOT . '/item-' . $value['id'] ?>>
										<?php echo $this->view->name_upper($value['name']); ?>
									</a>
								</h3>
								<div class="product-price">
									<p class="price">
										<?php
										if (!empty($value['discount'])) {
											echo '<span class="discount">' .
												'$' . ($value['cost'] * (100 - $value['discount']) / 100) . '</span>';
											echo '<s>' . '$' . $value['cost'] . '</s>';
										} else {
											echo '<span>$' . $value['cost'] . '</span>';
										}
										?>
									</p>
								</div>
							</div>
						</div>

					<?php } ?>

				</div>
			</div>
		</div>
	</div>
</div>