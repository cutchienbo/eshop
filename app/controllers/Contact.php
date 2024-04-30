<?php
class Contact extends Controller
{

    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('ContactModel');
    }

    public function index($params = [])
    {
        $this->data = array(
            'title' => 'Eshop - Contact',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'contact/contact',
            'page' => 'contact'
        );

        $this->render('layout/layout', $this->data);
    }
}
