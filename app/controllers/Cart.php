<?php
class Cart extends Controller
{

    private $model;

    public $data = [], $view;

    function __construct()
    {
        $this->model = $this->model('CartModel');

        $this->view = new View();
    }

    public function index($params = [])
    {
        if (!$params) {
            if (isset($_SESSION['id_customer'])) {
                $orders = $this->model->getCartList(
                    $_SESSION['id_customer']['id'],
                    $_SESSION['id_customer']['cart']
                );
            } else {
                header('Location:'._WEB_ROOT.'/home');
            }
        } 
        else {
            if (isset($_SESSION['id_customer'])) {
                $orders = $this->model->getCartList(
                    $_SESSION['id_customer']['id'],
                    $params
                );
            } else {
                header('Location:'._WEB_ROOT.'/home');
            }
        }

        $orders['count_order'] = $this -> model -> countOrder($_SESSION['id_customer']['id']);

        $customer_address = $this -> model -> getCustomerAddress($_SESSION['id_customer']['id']);

        $orders['address'] = $customer_address;

        $_SESSION['cart_product'] = $orders['product_list'];

        $this->data = array(
            'title' => 'Eshop - Cart',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'cart/order/order',
            'page' => 'cart',
            'data' => [
                'orders' => $orders,
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function orders($params = [])
    {
        if(isset($_SESSION['id_customer'])){
            $order_list = $this->model->getOrderList($_SESSION['id_customer']['id']);
        }
        else{
            $order_list = [];
        }

        $this->data = array(
            'title' => 'Eshop - Cart',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'cart/shipping/shipping',
            'page' => 'orders',
            'data' => [
                'order_list' => $order_list
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function delete($params = '')
    {
        $params = explode('-', $params);

        $data_key = [
            'id_cart',
            'id_customer',
            'id_product'
        ];

        $data = array_combine($data_key, $params);

        $this->model->deleteProduct($data);

        header('Location:' . _WEB_ROOT . '/cart');
    }

    public function change_quantity($params = '')
    {
        $params = explode('-', $params);

        $data_key = [
            'id_cart',
            'id_customer',
            'id_product',
            'quantity',
            'compare'
        ];

        $data = array_combine($data_key, $params);

        $new_quantity = $this->model->updateQuantity($data);

        header('Location:' . _WEB_ROOT . '/cart');
    }

    public function insert_order($params = '')
    {
        $params = explode('-', $params);

        $params_key = [
            'id_cart',
            'id_customer',
            'cost'
        ];

        $params = array_combine($params_key, $params);

        $orders_data = [
            'receiver' => $_POST['receiver_name'],
            'phone_number' => $_POST['receiver_phone_number'],
            'location' => $_POST['receiver_location'],
            'cost' => $params['cost'],
            'status' => '1'
        ];

        $this -> model -> updateLocation($params['id_customer'], $_POST['receiver_location']);

        $this->model->updateCountOrder($params['id_customer'], 1);

        $this->model->insertOrder($orders_data, $params, $_POST['receiver_location']);

        $_SESSION['id_customer']['quantity'] = 0;

        header('Location:' . _WEB_ROOT . '/cart');
    }

    public function cancel_order($params = ''){
        $params = explode('-', $params);
        $this -> model -> deleteOrder($params[0], $params[1]);

        $this -> model -> updateCountOrder($params[1], -1);

        header('Location:' . _WEB_ROOT . '/cart/orders');
    }

    public function edit_order($id_cart = '', $id_customer = ''){
        $order = $this -> model -> getOrder($id_cart, $id_customer);

        $this->data = array(
            'title' => 'Eshop - Cart',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'cart/edit_order',
            'page' => 'orders',
            'data' => [
                'order' => $order
            ]
        );

        $this->render('layout/layout', $this->data);
    }

    public function handle_edit_order($id_cart = '', $id_customer = ''){
        $data_update = [];

        foreach($_POST as $key => $value){
            if($value != ''){
                $data_update[$key] = $value;
            }
        }

        if(isset($_POST['location'])){
            $is_new_location = $this -> model -> checkLocation($_POST['location'], $id_customer);

            if($is_new_location){
                $this -> model -> addAddress($id_customer, $_POST['location']);
            }
        }

        $this -> model -> updateOrder($data_update, $id_cart, $id_customer);

        header('Location:'._WEB_ROOT.'/cart/orders');
    }
}
