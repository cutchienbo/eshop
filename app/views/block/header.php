<header class="header shop">
	<!-- Topbar -->
	<div class="topbar">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-12 col-12">
					<!-- Top Left -->
					<div class="top-left">
						<ul class="list-main">
							<li><i class="ti-headphone-alt"></i> +060 (800) 801-582</li>
							<li><i class="ti-email"></i> support@shophub.com</li>
						</ul>
					</div>
					<!--/ End Top Left -->
				</div>
				<div class="col-lg-7 col-md-12 col-12">
					<!-- Top Right -->
					<div class="right-content">
						<ul class="list-main">
							<li><i class="ti-location-pin"></i> Store location</li>
							<li><i class="ti-alarm-clock"></i> <a href="#">Daily deal</a></li>

							<?php
							if (isset($_SESSION['id_customer'])) {
							?>

								<li>
									<a class="header-user-avatar" href=<?php echo _WEB_ROOT . '/profile' . '/' . $_SESSION['id_customer']['id'] ?>>
										<img src=<?php
													if (substr($_SESSION['id_customer']['image'], 0, 4) != 'http') {
														echo _WEB_ROOT . IMG_PATH . 'customer/' . $_SESSION['id_customer']['image'];
													} else {
														echo $_SESSION['id_customer']['image'];
													}
													?> alt="">
										<?php
										echo $_SESSION['id_customer']['name'];
										if (!$_SESSION['id_customer']['verify']) {
										?>
											<i class="ti-alert" style="color:red" title="Verify your account"></i>
										<?php } ?>
									</a>
								</li>
								<li>
									<a href=<?php

											if (isset($_SERVER['PATH_INFO'])) {
												echo _WEB_ROOT . "/login" . "/log_out" . "/" . $_SERVER['PATH_INFO'];
											} else {
												echo _WEB_ROOT . "/login" . "/log_out/home";
											}

											?>>
										<i class="ti-shift-right"></i>
										Log out
									</a>
								</li>

							<?php
							} else {
							?>
								<li>
									<i class="ti-power-off"></i>
									<a href=<?php

											if (isset($_SERVER['PATH_INFO'])) {
												if (strpos($_SERVER['PATH_INFO'], 'login')) {
													echo _WEB_ROOT . $_SERVER['PATH_INFO'];
												} else {
													echo _WEB_ROOT . $_SERVER['PATH_INFO'] . "/login";
												}
											} else {
												echo _WEB_ROOT . "/home/login";
											}

											?>>
										Login
									</a>
								</li>
							<?php
							}
							?>



						</ul>
					</div>
					<!-- End Top Right -->
				</div>
			</div>
		</div>
	</div>
	<!-- End Topbar -->
	<div class="middle-inner">
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-md-2 col-12">
					<!-- Logo -->
					<div class="logo">
						<a href=<?php echo _WEB_ROOT .  '/home' ?>><img src=<?php echo _WEB_ROOT . IMG_PATH . 'logo.png' ?> alt="logo"></a>
					</div>
					<!--/ End Logo -->
					<!-- Search Form -->
					<div class="search-top">
						<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
						<!-- Search Form -->
						<div class="search-top">
							<form class="search-form">
								<input type="text" placeholder="Search here..." name="search">
								<button value="search" type="submit"><i class="ti-search"></i></button>
							</form>
						</div>
						<!--/ End Search Form -->
					</div>
					<!--/ End Search Form -->
					<div class="mobile-nav"></div>
				</div>
				<div class="col-lg-8 col-md-7 col-12">
					<div class="search-bar-top">
						<div class="search-bar">

							<form method="post" action=<?php echo _WEB_ROOT . '/product/search_result/1' ?>>


								<input autocomplete="off" id="search-name" name="search_name" placeholder="Search Products Here....." type="search">
								<button class="btnn search-btn" disabled type="submit"><i class="ti-search"></i></button>

								<div class="search-menu hide">
									<ul class="search-list">
										None
									</ul>

									<div class="search-condition">

										<div class="card">

											<div class="price-content">
												<p>Price:</p>
												<p id="min-value"></p>
												<p>-</p>
												<p id="max-value"></p>

											</div>

											<div class="range-slider">
												<input name="min_price" class="price-filter min-price" type="range" value=<?php echo $_SESSION['price']['MIN(cost)'] ?> min=<?php echo $_SESSION['price']['MIN(cost)'] ?> max=<?php echo $_SESSION['price']['MAX(cost)'] ?> step="5">
												<input name="max_price" class="price-filter max-price" type="range" value=<?php echo $_SESSION['price']['MAX(cost)'] ?> min=<?php echo $_SESSION['price']['MIN(cost)'] ?> max=<?php echo $_SESSION['price']['MAX(cost)'] ?> step="5">
											</div>
										</div>

										<div class="type-list option">
											<div>
												<select name="type">
													<option value="">All Category</option>

													<?php foreach ($_SESSION['product_type'] as $key => $value) { ?>
														<option value="<?php echo $value['id'] ?>">
															<?php echo $value['name_type'] ?>
														</option>
													<?php } ?>

												</select>
											</div>
										</div>

										<div class="char-size option">
											<div>
												<div>
													<p>S</p>
													<input type="checkbox" class="char-size-input" name="char_size[]" value="S">
												</div>
												<div>
													<p>M</p>
													<input type="checkbox" class="char-size-input" name="char_size[]" value="M">
												</div>
												<div>
													<p>L</p>
													<input type="checkbox" class="char-size-input" name="char_size[]" value="L">
												</div>
												<div>
													<p>XL</p>
													<input type="checkbox" class="char-size-input" name="char_size[]" value="XL">
												</div>
												<div>
													<p>XXL</p>
													<input type="checkbox" class="char-size-input" name="char_size[]" value="XXL">
												</div>
											</div>
										</div>

										<div class="card number-size">

											<div class="size-content">

												<p>Number size:</p>
												<p id="min-size">0</p>
												<p>-</p>
												<p id="max-size">0</p>

											</div>

											<div class="range-slider">
												<input name="min_size" class="size-filter min-size" type="range" value="0" min="19" max="45" step="1">
												<input name="max_size" class="size-filter max-size" type="range" value="0" min="19" max="45" step="1">
											</div>
										</div>

									</div>
								</div>
							</form>
						</div>

					</div>

					<div class="search-overlay hide">
					</div>

				</div>
				<div class="col-lg-2 col-md-3 col-12">
					<div class="right-bar">
						<!-- Search Form -->
						<div class="sinlge-bar">
							<a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i></a>
						</div>
						<!-- <div class="sinlge-bar">
							<a href="#" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
						</div> -->
						<div class="sinlge-bar shopping">
							<a href=<?php
									if (isset($_SESSION['id_customer'])) {
										echo _WEB_ROOT . '/cart';
									} else {
										echo _WEB_ROOT . '/cart/login';
									}
									?> class="single-icon">
								<i class="ti-bag"></i>
								<span class="total-count">
									<?php
									if (isset($_SESSION['id_customer'])) {
										if ($_SESSION['id_customer']['quantity'] < 100) {
											echo $_SESSION['id_customer']['quantity'];
										} else {
											echo '99+';
										}
									} else {
										echo '0';
									}
									?>
								</span>
							</a>

						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Header Inner -->
	<div class="header-inner">
		<div class="container">
			<div class="cat-nav-head">
				<div class="row">

					<?php
					if ($have_catagory) {
					?><div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>CATEGORIES</h3>
								<ul class="main-category">
									<li><a href="#">New Arrivals <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="sub-category">
											<li><a href="#">accessories</a></li>
											<li><a href="#">best selling</a></li>
											<li><a href="#">top 100 offer</a></li>
											<li><a href="#">sunglass</a></li>
											<li><a href="#">watch</a></li>
											<li><a href="#">man’s product</a></li>
											<li><a href="#">ladies</a></li>
											<li><a href="#">westrn dress</a></li>
											<li><a href="#">denim </a></li>
										</ul>
									</li>
									<li class="main-mega"><a href="#">best selling <i class="fa fa-angle-right" aria-hidden="true"></i></a>
										<ul class="mega-menu">
											<li class="single-menu">
												<a href="#" class="title-link">Shop Kid's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Kids Toys</a>
													<a href="#">Kids Travel Car</a>
													<a href="#">Kids Color Shape</a>
													<a href="#">Kids Tent</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Shop Men's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Watch</a>
													<a href="#">T-shirt</a>
													<a href="#">Hoodies</a>
													<a href="#">Formal Pant</a>
												</div>
											</li>
											<li class="single-menu">
												<a href="#" class="title-link">Shop Women's</a>
												<div class="image">
													<img src="https://via.placeholder.com/225x155" alt="#">
												</div>
												<div class="inner-link">
													<a href="#">Ladies Shirt</a>
													<a href="#">Ladies Frog</a>
													<a href="#">Ladies Sun Glass</a>
													<a href="#">Ladies Watch</a>
												</div>
											</li>
										</ul>
									</li>
									<li><a href="#">accessories</a></li>
									<li><a href="#">top 100 offer</a></li>
									<li><a href="#">sunglass</a></li>
									<li><a href="#">watch</a></li>
									<li><a href="#">man’s product</a></li>
									<li><a href="#">ladies</a></li>
									<li><a href="#">westrn dress</a></li>
									<li><a href="#">denim </a></li>
								</ul>
							</div>
						</div>
					<?php } ?>

					<div class="col-lg-9 col-12">
						<div class="menu-area">
							<!-- Main Menu -->
							<nav class="navbar navbar-expand-lg">
								<div class="navbar-collapse">
									<div class="nav-inner">
										<ul class="nav main-menu menu navbar-nav">
											<li class=<?php echo $page == 'home' ? 'active' : '' ?>><a href=<?php echo _WEB_ROOT . '/home' ?>>Home</a></li>
											<li class=<?php echo $page == 'product' ? 'active' : '' ?>><a href=<?php echo _WEB_ROOT . "/product" ?>>Shop<span class="new">New</span></a>

											</li>
											<!-- <li class=<?php echo $page == 'about' ? 'active' : '' ?>><a href=<?php echo _WEB_ROOT . "/about" ?>>About</a></li>
											<li class=<?php echo $page == 'blog' ? 'active' : '' ?>><a href=<?php echo _WEB_ROOT . "/blog" ?>>Blog</a>
											</li>
											<li class=<?php echo $page == 'contact' ? 'active' : '' ?>><a href=<?php echo _WEB_ROOT . "/contact" ?>>Contact Us</a></li> -->
										</ul>
									</div>
								</div>
							</nav>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Header Inner -->
</header>
<script>
	var searchInput = document.querySelector('#search-name');
	var minPrice = document.querySelector('.min-price');
	var typeProduct = document.querySelector('.type-list select');
	var sizeInputs = document.querySelectorAll('.char-size-input');
	var searchMenu = document.querySelector('.search-menu');
	var searchOverlay = document.querySelector('.search-overlay');
	var searchButton = document.querySelector('.search-btn');

	searchInput.onclick = () => {
		searchMenu.classList.toggle('hide');
		searchOverlay.classList.toggle('hide');
		searchButton.removeAttribute('disabled');
	}

	searchOverlay.onclick = () => {
		searchMenu.classList.toggle('hide');
		searchOverlay.classList.toggle('hide');
		searchButton.addAttribute('disabled');
	}

	sizeInputs.forEach((item) => {
		item.onchange = () => {
			handleInputData();
		}
	})

	typeProduct.onchange = () => {
		handleInputData();
	}

	searchInput.oninput = () => {
		handleInputData();
	}

	function handleInputData() {
		let searchName = $('#search-name').val();
		let minPrice = $('.min-price').val();
		let maxPrice = $('.max-price').val();
		let type = $('.type-list select').val();
		let charSizeInputs = $('.char-size-input');
		let minSize = $('.min-size').val();
		let maxSize = $('.max-size').val();

		let charSizeList = charSizeInputs.map((key, item) => {
			if (item.checked) {
				return item.value
			}
		}).toArray()

		$.ajax({
			url: '<?php echo _WEB_ROOT . '/home' . '/search' ?>',
			method: 'POST',
			data: {
				search_name: searchName,
				min_price: minPrice,
				max_price: maxPrice,
				type: type,
				char_size: charSizeList,
				min_size: minSize,
				max_size: maxSize
			},
			dataType: 'json',
			success: function(data) {
				var result = '';

				$.each(data, function(index, item) {
					result += '<a href="' + '<?php echo _WEB_ROOT . '/item-' ?>' + item['id'] + '">' + item['name'] + '</a>';
				})

				if (searchName == '' && type == '' && charSizeList == '' && minSize == '19' && maxSize == '19') {
					$('.search-list').html('None');
				} else {
					$('.search-list').html(result);
				}
			}
		});
	}






	let minValue = document.getElementById("min-value");
	let maxValue = document.getElementById("max-value");

	let minSize = document.getElementById("min-size");
	let maxSize = document.getElementById("max-size");

	function validateRange(minPrice, maxPrice) {
		if (minPrice >= maxPrice) {

			// Swap to Values
			let tempValue = maxPrice;
			maxPrice = minPrice;
			minPrice = tempValue;
		}

		minValue.innerHTML = "$" + minPrice;
		maxValue.innerHTML = "$" + maxPrice;
	}

	function validateRangeSize(minPrice, maxPrice) {
		if (minPrice > maxPrice) {

			// Swap to Values
			let tempValue = maxPrice;
			maxPrice = minPrice;
			minPrice = tempValue;
		}

		if (minPrice == 19) {
			minPrice = 0;
		}

		if (maxPrice == 19) {
			maxPrice = 0;
		}

		minSize.innerHTML = minPrice;
		maxSize.innerHTML = maxPrice;
	}

	const inputElements = document.querySelectorAll(".price-filter");
	const inputSize = document.querySelectorAll(".size-filter");

	inputSize.forEach((element) => {
		element.addEventListener("change", (e) => {
			let minPrice = parseInt(inputSize[0].value);
			let maxPrice = parseInt(inputSize[1].value);

			validateRangeSize(minPrice, maxPrice);
			handleInputData()
		});
	});

	inputElements.forEach((element) => {
		element.addEventListener("change", (e) => {
			let minPrice = parseInt(inputElements[0].value);
			let maxPrice = parseInt(inputElements[1].value);

			validateRange(minPrice, maxPrice);
			handleInputData();
		});
	});

	validateRange(inputElements[0].value, inputElements[1].value);
</script>