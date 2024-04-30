<?php
// echo '<pre>';
// print_r($data);
// echo '</pre>';
?>


<!DOCTYPE html>
<html lang="zxx">

<head>

	<?php require_once(LIB_PATH . 'metadata.php'); ?>

	<title>
		<?php echo $title ?>
	</title>

	<?php require_once(LIB_PATH . 'css.php'); ?>

</head>

<body class="js">

	<?php
	$nav = array(
		'page' => $page,
		'have_catagory' => $have_catagory
	);

	$this->render('block/header', $nav);

	if ($have_breadcrumbs) {
		$this->render('block/breadcrumbs', $nav);
	}

	$this->render($content, $data);

	$this->render('block/footer');
	?>

	<?php include(LIB_PATH . 'script.php'); ?>
</body>

</html>