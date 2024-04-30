<?php

class About extends Controller
{
    private $model;

    public $data = [];

    function __construct()
    {
        $this->model = $this->model('AboutModel');
    }

    public function index($params = [])
    {
        $this->data = array(
            'title' => 'Eshop - About',
            'have_breadcrumbs' => true,
            'have_catagory' => false,
            'content' => 'about/about',
            'page' => 'about'
        );

        $this->render('layout/layout', $this->data);
    }
}
