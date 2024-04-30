<?php
    $this -> render('cart/order/shopping-cart/shopping-cart',[
        'data' => [
            'orders' => $orders
        ]
    ]);
    $this -> render('block/shop-services');
    $this -> render('block/shop-newsletter');
    $this -> render('cart/order/modal-fade/modal-fade');
?>