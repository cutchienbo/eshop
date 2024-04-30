<?php
$this->render('product/shop/product/product', [
   'data' =>
   array(
      'product_type' => $product_type,
      'product_list' => $product_list,
      'recent_post' => $recent_post,
      'pagination' => $pagination,
      'pagination_path' => $pagination_path,
      'prev' => $prev,
      'next' => $next,
      'pagination_start' => $pagination_start,
      'pagination_end' => $pagination_end,
      'count_product_list' => $count_tab
   )
]);
$this->render('block/shop-newsletter');
