<?php
    $this -> render('home/slider-area/slider-area');
    $this -> render('home/small-banner/small-banner');
    $this -> render('home/product-area/product-area', [ 'data' => $trending_product ]);
    $this -> render('home/midium-banner/midium-banner');
    $this -> render('home/most-popular/most-popular', [ 'data' => $new_product ]);
    $this -> render('home/shop-blog/shop-blog');
    $this -> render('block/shop-services');
    $this -> render('block/shop-newsletter');
?>