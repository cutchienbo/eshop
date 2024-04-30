<?php 
   $this -> render('product/detail/shop-single/shop-single', [ 
      'data' => $product,
   ]);
   $this -> render('product/detail/product/product', [ 'data' => $sale_product ]);
?>