<?php
    class Controller{
        public function model($model){
            if(!empty($model)){
                if(file_exists(_DIR_ROOT_.'/app/models/'.$model.'.php')){
                    require_once(_DIR_ROOT_.'/app/models/'.$model.'.php');
                    if(class_exists($model)){
                        return new $model;
                    }
                }
            }
        }

        public function render($view, $data = []){
            extract($data);

            if(!empty($view)){
                if(file_exists(_DIR_ROOT_.'/app/views/'.$view.'.php')){
                    require_once(_DIR_ROOT_.'/app/views/'.$view.'.php');
                }
            }
        }
    }
?>