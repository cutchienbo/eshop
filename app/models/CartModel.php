<?php
class CartModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getCartList($id_customer = '', $id_cart = '')
    {
        $data_order = $this->db->select('o.*')->table('customer c')
            ->innerJoin('orders o', 'o.id_customer', '=', 'c.id')
            ->where('c.id', '=', $id_customer)
            ->where('o.id_cart', '=', "'".$id_cart."'", 'AND')
            ->get();

        if (isset($data_order[0]['id_cart'])) {

            $data_product = $this->db->select('p.id, p.name, p.cost, do.quantity, ist.url as id_image, s.discount, do.color, do.size')
                ->table('detail_order do')
                ->innerJoin('product p', 'p.id', '=', 'do.id_product')
                ->innerJoin('using_image_product uip', 'p.id', '=', 'uip.id_product')
                ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
                ->leftJoin('sale s', 's.id_product', '=', 'p.id')
                ->where('do.id_cart', '=', $data_order[0]['id_cart'])
                ->where('do.id_customer', '=', $id_customer, 'AND')
                ->get();

            $data_product = $this->convertListImage($data_product);

            $data_order = $data_order[0];
        } else {
            $data_product = [];
            $data_order['status'] = '';
        }

        $data_order['product_list'] = $data_product;

        // echo '<pre>';
        // print_r($data_order);
        // echo '</pre>';

        return $data_order;
    }

    public function getOrderList($id_customer){
        $order_list = $this -> db -> select() -> table('orders o')
        -> where('id_customer', '=', $id_customer) 
        -> where('o.status', '!=', '0', 'AND')
        -> where('o.status', '!=', '5', 'AND') -> get();

        return $order_list;
    }

    public function updateQuantity($data = [])
    {
        if ($data['compare'] == 0) {
            $new_quantity = $data['quantity'] - 1;
        } else {
            $new_quantity = $data['quantity'] + 1;
        }

        if ($new_quantity > 0) {
            $condition = "id_product='" . $data["id_product"] . "' AND id_cart='" . $data["id_cart"] . "' AND id_customer='" . $data["id_customer"] . "'";

            $this->db->UPDATE(
                'detail_order',
                ['quantity' => $new_quantity],
                $condition,
            );
        }

        return $new_quantity;
    }

    public function deleteProduct($data = [])
    {
        $condition = "id_product='" . $data["id_product"] . "' AND id_cart='" . $data["id_cart"] . "' AND id_customer='" . $data["id_customer"] . "'";

        $this -> db -> DELETE('detail_order', $condition);
    }

    public function getNewIdCart($id_customer){
        $data = $this -> db -> select('MAX(id_cart)') -> table('orders o')
        -> where('id_customer', '=', $id_customer) -> get();

        return $data[0]['MAX(id_cart)'] + 1;
    }

    public function insertOrder($data_order, $condition_params, $receiver_location = ''){

        $condition = 'id_cart = '.$condition_params['id_cart']
                    .' AND id_customer = '.$condition_params['id_customer'];

        $this -> db -> UPDATE(
            'orders',
            $data_order,
            $condition
        );

        $check_location_existed = $this -> db -> select() -> table('customer_location cl')
        -> where('cl.id_customer', '=', $condition_params['id_customer'])
        -> where('cl.location', 'like', "'%".$receiver_location."%'", 'AND')
        -> get();

        if(empty($check_location_existed)){
            $this -> db -> INSERT(
                'customer_location',
                ['id_customer', 'location', 'status'],
                [$condition_params['id_customer'], $receiver_location, '0']
            );
        }

        $this -> db -> query("UPDATE orders SET create_date = CURRENT_DATE() WHERE ".$condition);

        $new_id_cart = $this -> getNewIdCart($condition_params['id_customer']);

        $this -> db -> INSERT(
            'orders',
            ['id_cart', 'id_customer', 'status'],
            [$new_id_cart, $condition_params['id_customer'], '0']
        );

        $_SESSION['id_customer']['cart'] = $new_id_cart;

    }

    public function updateCountOrder($id_customer, $index){
        $count_order = $this -> db -> select('c.quantity') -> table('cart c')
        -> where('c.id_customer', '=', "'".$id_customer."'") -> get();

        $count_order = $count_order[0]['quantity'] + $index;

        $this -> db -> UPDATE(
            'cart',
            ['quantity ' => $count_order],
            'id_customer = '.$id_customer
        );
    }

    public function deleteOrder($id_cart, $id_customer){
        $condition = "id_cart = '".$id_cart."' AND id_customer = '".$id_customer."'";
    
        // delete product in detail order list
        $this -> db -> UPDATE(
            'orders',
            ['status' => '5'],
            $condition
        );
    }

    public function countOrder($id_customer = ''){
        $data = $this -> db -> select('COUNT(id_cart)') -> table('orders o')
        -> where('id_customer', '=', $id_customer)
        -> where('status', '!=', '5', 'AND') -> get();

        return $data[0]['COUNT(id_cart)'] - 1;
    }

    public function updateLocation($id_customer = '', $location = ''){
        $check_location_existed = $this -> db -> select('cl.id') 
        -> table('customer_location cl')
        -> where('id_customer', '=', $id_customer)
        -> where('location', '!=', "'".$location."'")
        -> get();

        if(!empty($check_location_existed)){
            $this -> db -> INSERT(
                'customer_location',
                ['id_customer', 'location', 'status'],
                [$id_customer, $location, '0']
            );
        }
    }

    public function getOrder($id_cart = '', $id_customer = ''){
        $data = $this -> db -> select() -> table('orders o')
        -> where('id_cart', '=', $id_cart) 
        -> where('id_customer', '=', $id_customer, 'AND')
        -> get();

        return $data[0];
    } 

    public function updateOrder($data_update = '', $id_cart = '', $id_customer = ''){
        $this -> db -> UPDATE(
            'orders',
            $data_update,
            'id_cart='.$id_cart.' AND id_customer='.$id_customer
        );
    }

    public function checkLocation($location = '', $id_customer = ''){
        $data = $this -> db -> select() -> table('customer_location cl')
        -> where('id_customer', '=', $id_customer)
        ->where('location', '=', "'".$location."'") -> get();

        return empty($data)?true:false;
    }
}
