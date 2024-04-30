<?php
class Database
{
    private $conn;

    use QueryBuilder;

    function __construct()
    {
        global $configs;

        $this->conn = Connection::getInstance($configs['database']);
    }

    public function INSERT($__table = '', $__column = [], $__value = [])
    {
        try {
            if(empty($__table) || empty($__column) || empty($__value)){
                return false;
            }

            $column = '( ' . implode(', ', $__column) . ' )';

            $params = '( :' . implode(', :', $__column) . ' )';

            $sql = "INSERT INTO " . $__table . " " . $column . "VALUES " . $params;

            $stmt = $this->conn->prepare($sql);

            foreach ($__column as $key => $value) {
                $stmt->bindParam(':' . $value, $__value[$key]);
            }

            $stmt->execute();

            $last_id = $this -> conn->lastInsertId();

            if ($last_id) {
                return $last_id;
            }

            return false;
        } 
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    public function DELETE($table_name = '', $condition = ''){
        $sql = "DELETE FROM $table_name WHERE $condition";

        $this -> query($sql);
    }

    public function UPDATE($table_name = '', $value = [], $condition = ''){
        $update_string = '';

        foreach($value as $key => $item){
            $update_string .= $key.'='."'".$item."'".',';
        }

        $update_string = trim($update_string, ',');

        $sql = "UPDATE $table_name SET $update_string WHERE $condition";

        $this -> query($sql);
    }

    public function query($sql)
    {
        try { 
           
            $stmt = $this->conn->prepare($sql);

            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_ASSOC);

            $result = $stmt->fetchAll();

            if ($result) {
                return $result;
            }

            return false;
        } 
        catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
