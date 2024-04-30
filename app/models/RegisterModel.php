<?php
     class RegisterModel extends Model{
        function __construct(){
            parent::__construct();
        }

        public function checkAccount($acc){
            $data = $this -> db -> select('c.id') -> table('customer c')
            -> where('account', '=', "'".$acc."'") -> get();

            return empty($data)?true:false;
        }

        public function addCustomer($data = []){

            extract($data);

            $id = $this -> db -> INSERT(
                'customer', 
                ['name', 'account', 'password', 'status', 'verify', 'image', 'email'], 
                [$name, $account, $pass, '1', $verify, $image, $email]
            );

            $this -> db -> INSERT(
                'cart',
                ['id_customer', 'quantity'],
                [$id, 1]
            );

            $this -> db -> INSERT(
                'orders',
                ['id_cart', 'id_customer', 'status'],
                ['1', $id, '0']
            );

            return [
                'id' => $id,
                'name' => $name,
                'quantity' => 0,
                'status' => 'unlock',
                'cart' => '1',
                'verify' => 0
            ];
        }
    }
?>