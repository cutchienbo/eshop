<?php
    class Connection {
        private static $instance = null, $__conn;

        private function __construct($db_configs){
            try {

                $conn = new PDO("mysql:host=".$db_configs['host'].";dbname=".$db_configs['db'], $db_configs['user'], $db_configs['pass']);
                 
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 
                self::$__conn = $conn;
            } 
            // Nhánh kết nối thất bại
            catch (PDOException $e) {
                echo "Kết nối thất bại: " . $e->getMessage();
            }
        }

        public static function getInstance($db_configs){
            if(self::$instance == null){
                $connection = new Connection($db_configs);
                self::$instance = self::$__conn;
            }

            return self::$instance;
        }
    }
