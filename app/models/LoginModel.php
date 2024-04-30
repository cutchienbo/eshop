<?php
     class LoginModel extends Model{
        function __construct(){
            parent::__construct();
        }

        public function getCustomer($acc = '', $pass = ''){
            $data = $this -> db -> select('c.id, c.name, c.status, c.verify, c.image, c.email, c.phone_number') -> table('customer c')
            -> where('account', '=', "'".$acc."'") 
            -> where('password', '=', "'".$pass."'", 'AND')
            -> where('status', '=', '1', 'AND')
            -> get();

            if(!empty($data)){
                $cart = $this -> db -> select('o.id_cart, o.id_customer') -> table('orders o')
                -> where('o.status', '=', "'cart'") 
                -> where('o.id_customer', '=', $data[0]['id'], 'AND')
                ->get();
                
                $count_product = $this -> db -> select('SUM(quantity)') -> table('detail_order do')
                -> where('id_cart', '=', $cart[0]['id_cart'])
                -> where('id_customer', '=', $cart[0]['id_customer'], 'AND')
                -> get();
    
                $quantity = $count_product[0]['SUM(quantity)'];
    
                if(!$quantity){
                    $quantity = 0;
                }
    
                $data[0]['quantity'] = $quantity;
                $data[0]['cart'] = $cart[0]['id_cart'];
    
                return $data;
            }
            return [];
        }
    }
