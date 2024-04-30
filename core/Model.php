<?php
class Model extends Database
{
    protected $db;
    protected $product_type = [];

    function __construct()
    {
        $this->db = new Database();

        $this->product_type = $this->getProductType();
        $this->getPrice();
        if (isset($_COOKIE['id_customer'])) {
            $_SESSION['id_customer'] = $this->getCustomerById($_COOKIE['id_customer']);
        }
    }

    public function addAddress($id_customer = '', $address = ''){
        $this -> db -> INSERT(
            'customer_location',
            ['id_customer', 'location', 'status'],
            [$id_customer, $address, '0']
        );
    }

    public function getCustomerById($id_customer = '')
    {
        $data = $this->db->select('c.*')->table('customer c')
            -> where('id', '=', $id_customer)
            -> where('status', '=', '1', 'AND') ->get();

        if (!empty($data)) {
            $cart = $this->db->select('o.id_cart, o.id_customer')->table('orders o')
                ->where('o.status', '=', "'cart'")
                ->where('o.id_customer', '=', $data[0]['id'], 'AND')
                ->get();

            $count_product = $this->db->select('SUM(quantity)')->table('detail_order do')
                ->where('id_cart', '=', $cart[0]['id_cart'])
                ->where('id_customer', '=', $cart[0]['id_customer'], 'AND')
                ->get();

            $quantity = $count_product[0]['SUM(quantity)'];

            if (!$quantity) {
                $quantity = 0;
            }

            $data[0]['quantity'] = $quantity;
            $data[0]['cart'] = $cart[0]['id_cart'];
    
            return $data[0];
        }
        return [];
    }

    public function getPrice()
    {
        $data = $this->db->select('MAX(cost), MIN(cost)')->table('product')->get();

        $_SESSION['price'] = $data[0];
        $_SESSION['product_type'] = $this -> product_type;
    }

    private function getProductType()
    {
        $data = $this->db->select('id, name_type')
            ->table('product_type')
            ->where('status', '=', '1')
            ->get();

        return $data;
    }

    protected function convertListImage($list)
    {
        $list_size = is_array($list) ? count($list) : 0;
        if ($list_size) {
            $check = 0;
            $list[$check]['id_image'] = array($list[$check]['id_image']);

            for ($i = 1; $i < $list_size; $i++) {
                if (
                    $list[$i]['id'] == $list[$check]['id']
                    && (isset($list[$i]['size'])?($list[$i]['size'] == $list[$check]['size']?true:false):true)
                    && (isset($list[$i]['color'])?($list[$i]['color'] == $list[$check]['color']?true:false):true)
                ) {
                    array_push($list[$check]['id_image'], $list[$i]['id_image']);
                    unset($list[$i]);
                } else {
                    $check = $i;
                    $list[$check]['id_image'] = array($list[$check]['id_image']);
                }
            }
        }

        return $list;
    }

    public function searchProduct(
        $name = '',
        $min_price = '',
        $max_price = '',
        $type = '',
        $char_size = [],
        $min_size = '',
        $max_size = '',
        $start = 0,
        $limit = 10,
        $sort = []
    ) {

        if (!empty($sort)) {
            extract($sort);
        }

        if (!isset($price)) {
            $price = '';
        }

        if (!isset($name_sort)) {
            $name_sort = '';
        }

        $data = $this->db->select('p.name, p.id, p.cost, s.discount')->table('product p')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->where('p.name', 'like', "'%" . $name . "%'")
            ->where('p.id_type', 'like', "'%" . $type . "%'", 'AND')
            ->where('p.cost', 'BETWEEN', $min_price . " AND " . $max_price, 'AND')
            ->where('p.status', '=', '1', 'AND')
            ->oderBy($name_sort ? 'p.name' : '', $name_sort)
            ->oderBy($price ? 'p.cost' : '', $price)
            ->get();

        foreach ($data as $key => $value) {
            $size = $this->db->select('id_size')->table('using_size_list')
                ->where('id_product', '=', "'" . $value['id'] . "'")->get();

            foreach ($size as $i => $value) {
                $size[$i] = $value['id_size'];
            }

            if (!empty($char_size) && ($min_size != '19' || $max_size != '19')) {
                if ((int)$size[0] != 0 && $size[0] != '') {
                    $check = true;

                    foreach ($size as $i => $value) {
                        if ($value >= $min_size && $value <= $max_size) {
                            $check = false;
                            break;
                        }
                    }

                    if ($check) {
                        unset($data[$key]);
                    }
                } else if ((int)$size[0] == 0 && $size[0] != '') {
                    if (count(array_intersect($size, $char_size)) < count($char_size)) {
                        unset($data[$key]);
                    }
                } else {
                    unset($data[$key]);
                }
            } else if (!empty($char_size)) {
                if (count(array_intersect($size, $char_size)) < count($char_size)) {
                    unset($data[$key]);
                }
            } else if ($min_size != '19' || $max_size != '19') {
                $check = true;

                foreach ($size as $i => $value) {
                    if ($value >= $min_size && $value <= $max_size) {
                        $check = false;
                        break;
                    }
                }

                if ($check) {
                    unset($data[$key]);
                }
            }
        }

        $data = array_values($data);
        $product = [];

        for($i = $start; $i < $limit+$start; $i++){
            if(isset($data[$i])){
                $product[] = $data[$i];
            }
        }

        return [
            'count' => count($data),
            'product' => $product
        ];
    }

    public function getCustomerAddress($id_customer = '')
    {
        $data = $this->db->select('location')->table('customer_location')
            ->where('id_customer', '=', "'" . $id_customer . "'")
            ->where('status', '=', '1', 'AND')->get();

        if (!empty($data)) {
            return $data[0]['location'];
        } else {
            return '';
        }
    }
}
