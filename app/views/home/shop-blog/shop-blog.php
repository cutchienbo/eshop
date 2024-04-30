<?php
$data = array(
	array(
		'date' => '20 July , 2020. Monday',
		'title' => 'Start Up Fashion.',
		'action' => 'Continue Reading',
		'img' => 'blog_1.jpg'
	),
	array(
		'date' => '19 July , 2022. Monday',
		'title' => "Man’s Fashion Sale",
		'action' => 'Continue Reading',
		'img' => 'blog_2.jpg'
	),
	array(
		'date' => '23 July , 2021. Monday',
		'title' => 'Women Fashion Festive.',
		'action' => 'Continue Reading',
		'img' => 'blog_3.webp'
	),
)
?>

<section class="shop-blog section">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="section-title">
					<h2>From Our Blog</h2>
				</div>
			</div>
		</div>
		<div class="row">

			<?php foreach ($data as $key => $value) { ?>

				<div class="col-lg-4 col-md-6 col-12">
					<div class="shop-single-blog">
						<img src=<?php echo _WEB_ROOT.IMG_PATH.'home/'.$value['img'] ?> alt="#">
						<div class="content">
							<p class="date">
								<?php echo $value['date'] ?>
							</p>
							<a href="#" class="title">
								<?php echo $value['title'] ?>
							</a>
							<a href="#" class="more-btn">
								<?php echo $value['action'] ?>
							</a>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
</section>