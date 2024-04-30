<?php

use Cloudinary\Asset\Image;

class Product extends Controller
{

    private $model, $product_type;

    public $data = [], $view;

    function __construct()
    {
        $this->model = $this->model('ProductModel');

        $this->view = new View();

        $this->product_type = $this->model->getProductType();
    }

    

    public function index($pagination = 1, $type = '')
    {
        if ($type == '') {
            $type = 'false';
        }

        $sort = [];

        if (isset($_POST['price'])) {
            $sort['price'] = $_POST['price'];
        }

        if (isset($_POST['name'])) {
            $sort['name_sort'] = $_POST['name'];
        }

        $recent_post = $this->model->getRecentPost($type);

        $start =  ($pagination - 1) * 9;

        $product_list = $this->model->getProductList($type, $sort, $start, 9);

        $count_product = $this->model->getProductCount($type);

        $count_product_list = ceil($count_product / 9);

        foreach ($product_list as $key => $value) {
            $id_image = $this->model->getProductImage($value['id']);

            $product_list[$key]['id_image'] = $id_image;
        }

        $prev = $pagination - 1;
        $next = $pagination + 1;

        if ($next > $count_product_list) {
            $next = $count_product_list;
        }

        if ($prev == 0) {
            $prev = 1;
        }

        if ($pagination == 1) {
            if ($count_product_list > 2) {
                $start = 1;
                $end = 3;
            } else {
                $start = 1;
                $end = 2;
            }
        } else if ($pagination == $count_product_list) {
            $end = $count_product_list;
            $start = ($end - 2) ? ($end - 2) : 1;
        } else {
            $start = $prev;
            $end = $next;
        }

        if ($type == 'false') {
            $type = '';
        } else {
            $type = $type . '-';
        }

        $this->data = array(
            'title' => 'Eshop - Shop',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'product/shop/shop',
            'page' => 'product',
            'data' => array(
                'product_type' => $this->product_type,
                'product_list' => $product_list,
                'recent_post' => $recent_post,
                'pagination' => $pagination,
                'pagination_path' => $type,
                'prev' => $prev,
                'next' => $next,
                'pagination_start' => $start,
                'pagination_end' => $end,
                'count_tab' => $count_product_list
            )
        );

        $this->render('layout/layout', $this->data);
    }

    public function search_result($pagination = 1, $path = '')
    {

        $sort = [];

        if (isset($_POST['price'])) {
            $sort['price'] = $_POST['price'];
        }

        if (isset($_POST['name'])) {
            $sort['name_sort'] = $_POST['name'];
        }

        if (isset($_POST['type'])) {
            $name = $_POST['search_name'];
            $min_price = $_POST['min_price'];
            $max_price = $_POST['max_price'];
            $type = $_POST['type'];

            if (isset($_POST['char_size'])) {
                $char_size = $_POST['char_size'];
            } else {
                $char_size = [];
            }

            $min_size = $_POST['min_size'];
            $max_size = $_POST['max_size'];

            $_SESSION['search']['search_name'] = $_POST['search_name'];
            $_SESSION['search']['min_price'] = $_POST['min_price'];
            $_SESSION['search']['max_price'] = $_POST['max_price'];
            $_SESSION['search']['type'] = $_POST['type'];

            if (isset($_POST['char_size'])) {
                $_SESSION['search']['char_size'] = $_POST['char_size'];
            }

            $_SESSION['search']['min_size'] = $_POST['min_size'];
            $_SESSION['search']['max_size'] = $_POST['max_size'];
        } else {
            $name = $_SESSION['search']['search_name'];
            $min_price = $_SESSION['search']['min_price'];
            $max_price = $_SESSION['search']['max_price'];
            $type = $_SESSION['search']['type'];

            if (isset($_SESSION['search']['char_size'])) {
                $char_size = $_SESSION['search']['char_size'];
            } else {
                $char_size = [];
            }

            $min_size = $_SESSION['search']['min_size'];
            $max_size = $_SESSION['search']['max_size'];
        }

        $start =  ($pagination - 1) * 8;

        $product_data  = $this->model->searchProduct(
            $name,
            $min_price,
            $max_price,
            $type,
            $char_size,
            $min_size,
            $max_size,
            $start,
            8,
            $sort
        );

        foreach ($product_data['product'] as $key => $value) {
            $id_image = $this->model->getProductImage($value['id']);

            $product_data['product'][$key]['id_image'] = $id_image;
        }

        $count_product_list = $product_data['count'];

        $count_product_list = ceil($count_product_list / 8);

        $prev = $pagination - 1;
        $next = $pagination + 1;

        if ($next > $count_product_list) {
            $next = $count_product_list;
        }

        if ($prev == 0) {
            $prev = 1;
        }

        if ($pagination == 1) {
            if ($count_product_list > 2) {
                $start = 1;
                $end = 3;
            } else {
                $start = 1;
                $end = 2;
            }
        } else if ($pagination == $count_product_list) {
            $end = $count_product_list;
            $start = ($end - 2) ? ($end - 2) : 1;
        } else {
            $start = $prev;
            $end = $next;
        }

        $data = array(
            'product_list' => $product_data['product'],
            'pagination' => $pagination,
            'prev' => $prev,
            'next' => $next,
            'pagination_start' => $start,
            'pagination_end' => $end,
            'count_tab' => $count_product_list,
            'path' => $path,
        );

        $_SESSION['search_data'] = $data;
        $_SESSION['search_sort'] = $sort;

        header('Location:' . _WEB_ROOT . '/product/search');

        echo '<pre>';
        print_r($product_data);
        echo '</pre>';
    }

    public function search()
    {
        $this->data = array(
            'title' => 'Eshop - Search',
            'have_breadcrumbs' => false,
            'have_catagory' => false,
            'content' => 'product/search/search',
            'page' => 'search',
            'data' => $_SESSION['search_data'],
        );

        $this->render('layout/layout', $this->data);
    }

    public function detail($params = '')
    {
        $product = $this->model->getDetailProduct($params);

        $sale_product = $this->model->getSaleProduct();

        $comment = $this->model->getComment($params);

        $can_comment = 0;

        if (isset($_SESSION['id_customer'])) {
            $can_comment = $this->model->checkCommentExisted($params, $_SESSION['id_customer']['id']);
        }

        $product_size = $product['product_size'];

        if (!is_numeric($product_size[0]['size'])) {
            $size_list = [
                'S', 'M', 'L', 'XL', 'XXL'
            ];

            $temp = [];

            foreach ($product_size as $value) {
                $temp[] = $value['size'];
            }

            $product_list = array_intersect($size_list, $temp);

            $product['product_size'] = $product_list;
        } else {
            foreach ($product_size as $key => $value) {
                $product['product_size'][$key] = $value['size'];
            }
        }

        $product['can_comment'] = $can_comment;
        $product['comment'] = $comment;

        $this->data = array(
            'title' => 'Eshop - Detail',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'product/detail/detail',
            'page' => 'detail',
            'data' => array(
                'product' => $product,
                'sale_product' => $sale_product,
            )
        );


        // echo '<pre>';
        // print_r($product);
        // echo '</pre>';

        $this->render('layout/layout', $this->data);
    }

    public function add_item($params = '')
    {

        $id_product = explode('-', $params);

        $existed_product = $this->model->checkExistedProduct(
            $_SESSION['id_customer']['id'],
            $_SESSION['id_customer']['cart'],
            $id_product[1]
        );

        if (!$existed_product) {
            $product_data = [
                'id_cart' => $_SESSION['id_customer']['cart'],
                'id_customer' => $_SESSION['id_customer']['id'],
                'id_product' => $id_product[1],
                'quantity' =>  $_POST['detail_quantity'],
                'color' => $_POST['color'],
                'size' => isset($_POST['size']) ? $_POST['size'] : ''
            ];

            $this->model->addDetailOrder($product_data);
        }

        $_SESSION['id_customer']['quantity'] += $_POST['detail_quantity'];

        header('Location:' . _WEB_ROOT . '/product');
    }

    public function handle_comment($id_product = '')
    {
        $review = $this->model->insertComment($_SESSION['id_customer']['id'], $id_product, $_POST['msg'], $_POST['rating']);

        $rate = $this->model->updateProductRating($id_product);

        $comment = $this->model->getComment($id_product);

        echo json_encode([
            'rate' => $rate,
            'comment' => $comment,
            'review' => $review
        ]);
    }

    public function check_comment_valid()
    {
        $data = $this->model->getUnvalidStrings();

        $str_find = [];
        $str_replace = [];
        $comment = " " . $_POST['msg'] . " ";

        foreach ($data as $key => $value) {
            $str_find[] = " " . $value['unvalid_string'] . " ";

            $temp = '';

            for ($i = 0; $i < strlen($value['unvalid_string']); $i++) {
                $temp .= '*';
            }

            $temp = " " . $temp . " ";

            $str_replace[] = $temp;
        }

        $comment = trim(str_replace($str_find, $str_replace, $comment), " ");

        echo json_encode($comment);
    }
}
