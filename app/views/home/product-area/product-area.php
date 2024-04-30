<?php
	// echo '<pre>';
	// print_r($data);
	// echo '</pre>';
?>

<div class="product-area section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>Trending Item</h2>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="product-info">
					<div class="nav-main">
						<!-- Tab Nav -->
						<ul class="nav nav-tabs" id="myTab" role="tablist">

							<?php foreach ($data as $key => $value) { ?>

								<li class="nav-item">
									<a class="nav-link <?php echo $key == 0 ? 'active' : '' ?>" data-toggle="tab" href="#<?php echo $value['name_type'] ?>" role="tab">
										<?php echo $value['name_type'] ?>
									</a>
								</li>

							<?php } ?>

						</ul>
						<!--/ End Tab Nav -->
					</div>
					<div class="tab-content" id="myTabContent">

						<?php foreach ($data as $key => $value) { ?>

							<div class="tab-pane fade <?php echo $key == 0 ? 'show active' : '' ?>" id="<?php echo $value['name_type'] ?>" role="tabpanel">
								<div class="tab-single">
									<div class="row">

										<?php if (!empty($value['list'])) {
											foreach ($value['list'] as $key => $item) { ?>

												<div class="col-xl-3 col-lg-4 col-md-4 col-12">
													<div class="single-product">
														<div class="product-img">
															<a href=<?php echo _WEB_ROOT . '/item-' . $item['id'] ?>>
																<img class="default-img" src=<?php echo $item['id_image'][0] ?> alt="#">
																<img class="hover-img" src=<?php
																							$index = 1;
																							if (!isset($item['id_image'][1])) {
																								$index = 0;
																							}
																							echo $item['id_image'][$index];
																							?> alt="#">
															</a>
															<div class="button-head">
																<div class="product-action">
																	<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="#"><i class=" ti-eye"></i><span>Quick Shop</span></a>
																	<a title="Wishlist" href="#"><i class=" ti-heart "></i><span>Add to Wishlist</span></a>
																	<a title="Compare" href="#"><i class="ti-bar-chart-alt"></i><span>Add to Compare</span></a>
																</div>
																<div class="product-action-2">
																	<a title="Add to cart" href=<?php echo _WEB_ROOT . '/item-' . $item['id'] ?>>Detail product</a>
																</div>
															</div>
														</div>
														<div class="product-content">
															<h3>
																<a href=<?php echo _WEB_ROOT . '/item-' . $item['id'] ?>>
																	<?php
																	echo $this->view->name_upper($item['name']);
																	?>
																</a>
															</h3>
															<div class="product-price">
																<p class="price">
																	<?php
																	if (!empty($item['discount'])) {
																		echo '<span class="discount">' .
																			'$' . ($item['cost'] * (100 - $item['discount']) / 100) . '</span>';
																		echo '<s>' . '$' . $item['cost'] . '</s>';
																	} else {
																		echo '<span>$' . $item['cost'] . '</span>';
																	}
																	?>
																</p>
															</div>
														</div>
													</div>
												</div>

										<?php }
										} ?>

									</div>
								</div>
							</div>

						<?php } ?>

					</div>
				</div>
			</div>
		</div>
	</div>
</div>