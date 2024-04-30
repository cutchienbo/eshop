<?php
class Home extends Controller
{

    private $model;
    public $view;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('HomeModel');

        $this->view = new View();
    }

    public function search()
    {
        $name = $_POST['search_name'];
        $min_price = $_POST['min_price'];
        $max_price = $_POST['max_price'];
        $type = $_POST['type'];

        if(isset($_POST['char_size'])){
            $char_size = $_POST['char_size'];
        }
        else{
            $char_size = [];
        }

        $min_size = $_POST['min_size'];
        $max_size = $_POST['max_size'];

        $result = $this->model->searchProduct(
            $name,
            $min_price,
            $max_price,
            $type,
            $char_size,
            $min_size,
            $max_size,
        );

        echo json_encode($result['product']);
    }

    public function index($params = [])
    {

        $trending_product = $this->model->getTrendingProduct();

        $new_product = $this->model->getNewProduct();

        $this->data = array(
            'title' => 'Eshop',
            'have_breadcrumbs' => false,
            'have_catagory' => true,
            'content' => 'home/home',
            'page' => 'home',
            'data' => array(
                'trending_product' => $trending_product,
                'new_product' => $new_product,
            )
        );

        $this->render('layout/layout', $this->data);
    }
}
