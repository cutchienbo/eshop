<?php
    class View{
        public function name_upper($str){
            for($i = 0; $i < strlen($str); $i++){
                if($str[$i] === ' '){
                    $str[$i + 1] = strtoupper($str[$i + 1]);
                    $i++;
                }
            }

            return ucfirst($str);
        }
    }
?>