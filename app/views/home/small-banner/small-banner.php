<?php
$data = array(
	array(
		'title' => "Man's Collectons",
		'content' => 'Summer travel <br> collection',
		'link' => 'Discover Now',
		'img_name' => 'summer_collection.jpg'
	),
	array(
		'title' => 'Bag Collectons',
		'content' => 'Awesome Bag <br> 2020',
		'link' => 'Shop Now',
		'img_name' => 'awesome_bag.jpg'
	),
	array(
		'title' => 'Flash Sale',
		'content' => 'Mid Season <br> Up to <span>40%</span> Off',
		'link' => 'Discover Now',
		'img_name' => 'mid_season.webp'
	)
)
?>

<section class="small-banner section">
	<div class="container-fluid">
		<div class="row">

			<?php foreach ($data as $key => $value) { ?>

				<div class="col-lg-4 col-md-6 col-12">
					<div class="single-banner">
						<img src=<?php echo _WEB_ROOT.IMG_PATH.'home/'.$value['img_name'] ?> alt="#">
						<div class="content">
							<p>
								<?php echo $value['title'] ?>
							</p>
							<h3>
								<?php echo $value['content'] ?>
							</h3>
							<a href="#">
								<?php echo $value['link'] ?>
							</a>
						</div>
					</div>
				</div>

			<?php } ?>

		</div>
	</div>
</section>