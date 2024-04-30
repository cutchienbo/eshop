<?php
    class Blog extends Controller{

        private $model;

        public $data = [];

        function __construct(){
            $this -> model = $this -> model('BlogModel');
        }

        public function index($params = []){
            $this -> data = array(
                'title' => 'Eshop - Blog',
                'have_breadcrumbs' => true,
                'have_catagory' => false,
                'content' => 'blog/blog',
                'page' => 'blog'
            );

            $this -> render('layout/layout', $this -> data);
        }

    }
?>