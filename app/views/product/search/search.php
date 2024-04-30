<?php
$this->render('product/search/search_result/search_result', [
   'data' => array(
      'product_list' => $product_list,
      'pagination' => $pagination,
      'prev' => $prev,
      'next' => $next,
      'pagination_start' => $pagination_start,
      'pagination_end' => $pagination_end,
      'count_product_list' => $count_tab,
      'path' => $path
   )
]);

