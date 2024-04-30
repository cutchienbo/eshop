<?php
class HomeModel extends Model
{

    function __construct()
    {
        parent::__construct();
    }

    public function getNewProduct()
    {
        $data = $this->db->select('p.*, ist.url as id_image, s.discount')->table('product p')
            ->leftJoin('sale s', 's.id_product', '=', 'p.id')
            ->innerJoin('new_product np', 'p.id', '=', 'np.id_product')
            ->innerJoin('using_image_product uip', 'p.id', '=', 'uip.id_product')
            ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
            ->where('p.status', '=', '1')
            ->get();

        $data = $this->convertListImage($data);

        return $data;
    }

    public function getTrendingProduct()
    {
        $data = $this->product_type;

        foreach ($data as $key => $value) {

            $list = $this->db->select('p.*, ist.url as id_image, s.discount')->table('product p')
                ->leftJoin('sale s', 's.id_product', '=', 'p.id')
                ->innerJoin('trending_product tp', 'p.id', '=', 'tp.id_product')
                ->innerJoin('product_type pt', 'pt.id', '=', 'p.id_type')
                ->innerJoin('using_image_product uip', 'p.id', '=', 'uip.id_product')
                ->innerJoin('image_store ist', 'ist.id_image', '=', 'uip.id_image')
                ->where('id_type', 'like', "'" . $value['id'] . "'")
                ->where('p.status', '=', '1', 'AND')->get();

            $data[$key]['list'] = $this->convertListImage($list);
        }

        return $data;
    }

   
}
