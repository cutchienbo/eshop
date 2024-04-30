<?php
    class ProfileModel extends Model{
        function __construct(){
            parent::__construct();
        }

        public function changePassword($id_customer = '', $new_password = ''){
            $this -> db -> UPDATE(
                'customer',
                ['password' => $new_password],
                'id = '.$id_customer
            );
        }

        public function getIdImage($id_customer = ''){
            $data = $this -> db -> select('c.image') -> table('customer c')
            -> where('c.id', '=', $id_customer)
            -> where('status', '=', '1', 'AND') -> get();

            return $data[0]['image'];
        }

        public function updateAvatar($id_customer, $id_image, $current_image){
            $this -> db -> INSERT(
                'image_store',
                ['id'],
                [$id_image]
            );

            $this -> db -> UPDATE(
                'customer',
                ['image' => $id_image],
                'id = '.$id_customer
            );

            if($current_image != 'user.png'){
                $this -> db -> DELETE(
                    'image_store',
                    "id='".$current_image."'"
                );
            }
        }

        public function updateName($id_customer, $name){
            $this -> db -> UPDATE(
                'customer',
                ['name' => $name],
                'id = '.$id_customer
            );
        }

        public function checkExistEmail($email = '123'){
            
            $check = $this -> db -> select('*') -> table('customer c')
            -> where('c.email', '=', "'".$email."'")
            -> where('status', '=', '1', 'AND') -> get();

            if(empty($check)){
                return false;
            }
            return true;
        }

        public function deleteCode($email){
            $this -> db -> DELETE(
                'verify_code',
                "email = '".$email."'"
            );
        }

        public function addCode($email, $code){
            $this -> db -> INSERT(
                'verify_code',
                ['code', 'email'],
                [$code, $email]
            );
        }

        public function getCode($email){
            $data = $this -> db -> select('code') -> table('verify_code')
            -> where('email', '=', "'".$email."'")
            -> get();

            return $data[0]['code'];
        }

        public function addEmail($email, $id_customer){
            $this -> db -> UPDATE(
                'customer c',
                ['email' => $email],
                "id='".$id_customer."'"
            );
        }

        public function updateVerifyStatus($id_customer, $verify){
            $this -> db -> UPDATE(
                'customer c',
                ['verify' => $verify],
                "id='".$id_customer."'"
            );
        }

        public function getCustomerByEmail($email = ''){
            $data = $this -> db -> select('c.*') -> table('customer c')
            -> where('email', '=', "'".$email."'")
            -> where('status', '=', '1', 'AND') -> get();

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
    
                return $data[0];
            }

            return [];
        }

        public function getAddress($id_customer = ''){
            $data = $this -> db -> select() -> table('customer_location cl')
            -> where('id_customer', '=', "'".$id_customer."'") -> get();

            return $data;
        }

        public function updateAddress($id_customer = '', $id_address = '', $address = ''){
            $condition = "id_customer ='".$id_customer."' AND id='".$id_address."'";

            $this -> db -> UPDATE(
                'customer_location',
                ['location' => $address],
                $condition
            );
        }

        public function deleteAddress($id_customer = '', $id_address = ''){
            $condition = "id_customer ='".$id_customer."' AND id='".$id_address."'";

            $this -> db -> DELETE(
                'customer_location',
                $condition
            );
        }

        public function updateAddressStatus($id_customer = '', $id_address = ''){
            $condition1 = "id_customer ='".$id_customer."' AND id='".$id_address."'";
            $condition2 = "id_customer ='".$id_customer."' AND id!='".$id_address."'";

            $this -> db -> UPDATE(
                'customer_location',
                ['status' => '0'],
                $condition2
            );

            $this -> db -> UPDATE(
                'customer_location',
                ['status' => '1'],
                $condition1
            );
        }
    }
