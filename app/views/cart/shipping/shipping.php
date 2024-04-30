<?php
    $this -> render('cart/shipping/shopping-cart/shopping-cart', [
        'data' => [
            'order_list' => $order_list
        ]
    ]);
    $this -> render('block/shop-services');
    $this -> render('block/shop-newsletter');
?>