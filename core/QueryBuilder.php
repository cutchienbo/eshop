<?php
    trait QueryBuilder {

        private $table = '';
        private $select = '';
        private $where = '';
        private $operator = '';
        private $join = '';
        private $limit = '';
        private $oder_by ='';
  
        public function table($table = ''){
            $this -> table = ' FROM '.$table." ";

            return $this;
        }

        public function select($field = '*'){
            $this -> select = ' SELECT '.$field." ";

            return $this;
        }

        public function where($field = '', $compare = '', $value = '', $operator = ''){
            $this -> operator($operator);

            $this -> where .= " ".$this -> operator." ". $field." ". $compare." ". $value;

            return $this;
        }

        public function oderBy($column = '', $sort_type = ''){
            if($column){
                $this -> oder_by .= (!empty($this -> oder_by)?',':' ORDER BY ').$column." ".$sort_type." ";
            }

            return $this;
        }

        public function limit($start = '0', $limit = '0'){
            $this -> limit = ' LIMIT '.$start.",".$limit;

            return $this;
        }

        public function operator($operator = ''){
            $this -> operator = $operator;

            return $this;
        }

        public function innerJoin($table = '', $field = '', $compare = '', $value = ''){
            $this -> join .= ' INNER JOIN '.$table.' ON '.$field.$compare.$value.' ';

            return $this;
        }

        public function rightJoin($table = '', $field = '', $compare = '', $value = ''){
            $this -> join .= ' RIGHT JOIN '.$table.' ON '.$field.$compare.$value.' ';

            return $this;
        }

        public function leftJoin($table = '', $field = '', $compare = '', $value = ''){
            $this -> join .= ' LEFT JOIN '.$table.' ON '.$field.$compare.$value.' ';

            return $this;
        }

        public function get(){
            if(!empty($this -> where)){
                $this -> where = ' WHERE'.$this -> where." ";
            }

            $sql = $this -> select . $this -> table . $this 
                         -> join . $this -> where . $this 
                         -> oder_by . $this -> limit;

            $result = $this -> query($sql);

            $this -> where = '';
            $this -> table = '';
            $this -> select = '';
            $this -> operator = '';
            $this -> join = '';
            $this -> limit = '';
            $this -> oder_by = '';

            if($result){
                return $result;
            }
            return [];
        }
    }
?>