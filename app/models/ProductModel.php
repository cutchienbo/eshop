<?php
class ProductModel extends Model
{
    function __construct()
    {
        parent::__construct();
    }

    public function getProductType()
    {
        return $this->product_type;
    }

    public function getProductList($type, $sort, $start, $limit)
    {
        if (!empty($sort)) {
            extract($sort);
        }

        if (!isset($price)) {
            $price = '';
        }

        if (!isset($name_sort)) {
            $name_sort = '';
        }

        $data = $this->db->select('p.id, p.name, p.cost, s.discount')->table('product p')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->where($type != 'false' ? 'id_type' : "'" . 'false' . "'", 'like', "'" . $type . "'")
            -> where('p.status', '=', '1', 'AND')
            ->oderBy($name_sort ? 'p.name' : '', $name_sort)
            ->oderBy($price ? 'p.cost' : '', $price)
            ->limit($start, $limit)->get();

        return $data;
    }

    // public function getProductListByName($search_name, $sort, $start, $limit)
    // {
    //     if (!empty($sort)) {
    //         extract($sort);
    //     }

    //     if (!isset($price)) {
    //         $price = '';
    //     }

    //     if (!isset($name)) {
    //         $name = '';
    //     }

    //     $data = $this->db->select('p.id, p.name, p.cost, s.discount')->table('product p')
    //         ->leftJoin('sale s', 's.id_product', '=', 'p.id')
    //         ->where('p.name', 'like', "'%".$search_name."%'")
    //         -> where('p.status', '=', '1', 'AND')
    //         ->oderBy($name ? 'p.name' : '', $name)
    //         ->oderBy($price ? 'p.cost' : '', $price)
    //         ->limit($start, $limit)->get();

    //     return $data;
    // }

    public function countProductByName($search_name){
        $data = $this->db->select('COUNT(p.id)')->table('product p')
            ->where('p.name', 'like', "'%".$search_name."%'")
            -> where('p.status', '=', '1', 'AND')
            ->get();

        if($data){
            return $data[0]['COUNT(p.id)'];
        }
        return 0;
    }

    public function getProductImage($id_product)
    {
        $data = $this->db->select('ist.url as id_image')->table('using_image_product uip')
            ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            ->where('uip.id_product', '=', $id_product)->get();

        return $data;
    }

    public function getRecentPost($type)
    {
        $data = $this->db->select('p.*, ist.url as id_image, s.discount')->table('product p')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('using_image_product uip', 'p.id', '=', 'uip.id_product')
            ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            ->where($type != 'false' ? 'id_type' : "'" . 'false' . "'", 'like', "'" . $type . "'")
            ->where('p.star', '>', '3', 'AND')
            -> where('p.status', '=', '1', 'AND')
            ->limit(0, 10)->get();

        $data = $this->convertListImage($data);

        return $data;
    }

    public function getDetailProduct($id_product)
    {
        $product = $this->db->select('p.*, pt.name_type')->table('product p')
            ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
            ->where('p.id', '=', $id_product)
             ->get();

        $product_image = $this->db->select('i.url as id_image, i.color')->table('using_image_product uip')
            ->innerJoin('image_store i', 'i.id_image', '=', 'uip.id_image')
            ->where('id_product', '=', $id_product)->get();

        $product_size = $this->db->select('sl.size')->table('using_size_list usl')
            ->innerJoin('size_list sl', 'sl.size', '=', 'usl.id_size')
            ->where('id_product', '=', $id_product)->get();

        $product_sale = $this->db->select('discount')->table('product')
            ->innerJoin('sale', 'id_product', '=', 'id')
            ->where('id_product', '=', $id_product)->get();

        if (empty($product_sale)) {
            $product_sale = [[]];
        }

        $data = array(
            'product' => $product[0],
            'product_image' => $product_image,
            'product_size' => $product_size,
            'product_sale' => $product_sale[0]
        );

        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';

        return $data;
    }

    public function getSaleProduct()
    {
        $data = $this->db->select('p.name, p.id, p.cost, ist.url as id_image, s.discount')->table('product p')
            ->innerJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('using_image_product uip', 'p.id', '=', 'uip.id_product')
            ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            -> where('p.status', '=', '1')->get();

        $data = $this->convertListImage($data);

        return $data;
    }

    public function addDetailOrder($product_data)
    {
        $value = array_values($product_data);

        $this->db->INSERT(
            'detail_order',
            ['id_cart', 'id_customer', 'id_product', 'quantity', 'color', 'size'],
            $value
        );
    }

    public function  reduceProductQuantity($id_product, $sell_count, $old_quantity)
    {
        $new_quantity = $old_quantity - $sell_count;

        $this->db->UPDATE(
            'product',
            ['quantity' => $new_quantity],
            'id = ' . $id_product
        );
    }

    public function getProductCount($type)
    {
        $data = $this->db->select('COUNT(id)')->table('product p')
            ->where($type != 'false' ? 'id_type' : "'" . 'false' . "'", 'like', "'" . $type . "'")
            -> where('p.status', '=', '1', 'AND')
            ->get();

        return $data[0]['COUNT(id)'];
    }

    public function checkExistedProduct($id_customer = '', $id_cart = '', $id_product = ''){
        $data = $this -> db -> select('do.id, do.quantity') -> table('detail_order do') 
        -> where('id_customer', '=', $id_customer)
        -> where('id_cart', '=', $id_cart, 'AND')
        -> where('id_product', '=', $id_product, 'AND')
        -> get();

        if($data){
            $condition = "id_customer = ".$id_customer." AND id_cart = ".$id_cart." AND id_product = ".$id_product;

            $this -> db -> UPDATE(
                'detail_order',
                ['quantity' => (int)$data[0]['quantity'] + 1],
                $condition
            );

            return true;
        }

        return false;
    }

    public function insertComment($id_customer = '', $id_product = '', $message = '', $rating = 5){
        $id = $this -> db -> INSERT(
            'comment',
            ['id_customer', 'id_product', 'content', 'rate', 'status'],
            [$id_customer, $id_product, $message, $rating, '1']
        );

        $condition = "id=".$id." AND id_customer =".$id_customer." AND id_product=".$id_product."";

        $this -> db -> query("UPDATE comment SET create_date = CURRENT_TIMESTAMP WHERE ".$condition);

        $review = $this -> db -> query("UPDATE product SET review = review + 1 WHERE id=".$id_product);

        return $review;
    }

    public function getComment($id_product = ''){
        $data = $this -> db -> select('cmt.*, c.name, c.image') -> table('comment cmt')
        -> innerJoin('customer c', 'c.id', '=', 'cmt.id_customer')
        -> where('cmt.id_product', '=', "'".$id_product."'")
        -> where('cmt.status', '=', '1', 'AND') -> get();

        return $data;
    }

    public function checkCommentExisted($id_product = '', $id_customer = ''){
        $data = $this -> db -> select() -> table('comment')
        -> where('id_product', '=', "'".$id_product."'")
        -> where('id_customer', '=', "'".$id_customer."'", 'AND')
        -> get();

        return empty($data)?1:0;
    }

    public function updateProductRating($id_product = ''){
        $rate = $this -> db -> select('AVG(rate)') -> table('comment c')
        -> where('id_product', '=', $id_product) -> get();

        if(!empty($rate)){
            $rate_data = round($rate[0]['AVG(rate)']*10)/10;
            $this -> db -> UPDATE(
                'product',
                ['star' => $rate_data],
                'id='.$id_product
            );

            return $rate_data;
        }

        return false;
    }

    public function getUnvalidStrings(){
        $data = $this -> db -> select('unvalid_string') -> table('language_filter')
        -> get();

        return $data;
    }
}
