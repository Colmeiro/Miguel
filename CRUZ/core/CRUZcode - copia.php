<?php

class CRUZcode
{

    private $host;
    private $user;
    private $password;
    public $database;
    private $sql;

    function __construct()
    {
        $this->connection();
    }

    function connection()
    {
        $subject = file_get_contents('../application/config/database.php');
        $string = str_replace("defined('BASEPATH') OR exit('No direct script access allowed');", "", $subject);
        
        $con = 'core/connection.php';
        $create = fopen($con, "w") or die("Change your permision folder for application and CRUZ folder to 777");
        fwrite($create, $string);
        fclose($create);
        
        require $con;

        $this->host = $db['default']['hostname'];
        $this->user = $db['default']['username'];
        $this->password = $db['default']['password'];
        $this->database = $db['default']['database'];

        // $this->sql = new mysqli($this->host, $this->user, $this->password, $this->database);
        $this->sql = pg_connect("host=".$this->host." port=5432 dbname=".$this->database." user=".$this->user." password=".$this->password."");
        // if ($this->sql->connect_error)
        // {
        //     echo $this->sql->connect_error . ", please check 'application/config/database.php'.";
        //     die();
        // }

        
        unlink($con);
    }

    function table_list()
    {
        $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='public'";
        // $stmt = pg_prepare($this->sql,'consulta',$query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        // $stmt->bind_param('s', $this->database);
        // $stmt->bind_result($table_name);
        // $stmt->execute();
        // $stmt = pg_execute($this->sql,'consulta',array($this->database));
        $stmt = pg_query($this->sql,$query);

        // $r = pg_fetch_all($stmt);
        // var_dump($r);
        while ($row = pg_fetch_assoc($stmt)) {
            $fields[] = array('table_name' => $row['table_name']);
        }
        return $fields;
        // $stmt->close();
        pg_close($this->sql);
    }

    function primary_field($table)
    {
        // $query = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='public' AND TABLE_NAME='$table' AND COLUMN_KEY = 'PRI'";
        $query = "SELECT a.attname as column_name, format_type(a.atttypid, a.atttypmod) AS data_type
        FROM   pg_index i
        JOIN   pg_attribute a ON a.attrelid = i.indrelid
                             AND a.attnum = ANY(i.indkey)
        WHERE  i.indrelid = '$table'::regclass
        AND    i.indisprimary;";


        // $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (primary_field)");
        // $stmt->bind_param('ss', $this->database, $table);
        // $stmt->bind_result($column_name, $column_key);
        // $stmt->execute();
        $stmt = pg_query($this->sql,$query);
        $row = pg_fetch_assoc($stmt);
        // $stmt->fetch();
        return $row['column_name'];
        // $stmt->close();
        pg_close($this->sql);
    }

    function not_primary_field($table)
    {
        $query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='public' AND TABLE_NAME='$table' AND column_name not in (SELECT a.attname as column_name
        FROM   pg_index i
        JOIN   pg_attribute a ON a.attrelid = i.indrelid
                             AND a.attnum = ANY(i.indkey)
        WHERE  i.indrelid = '$table'::regclass
        AND    i.indisprimary)";

        // $stmt = $this->sql->pg_prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        // $stmt->bind_param('ss', $this->database, $table);
        // $stmt->bind_result($column_name, $column_key, $data_type);
        // $stmt->execute();

        $stmt = pg_query($this->sql,$query);
        while ($row = pg_fetch_assoc($stmt)) {
            $fields[] = array('column_name' => $row['column_name'], 'column_key' => $row['column_key'], 'data_type' => $row['data_type']);
        }
        return $fields;
        // $stmt->close();
        // $this->sql->close();
    }

    function all_field($table)
    {
        $query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='public' AND TABLE_NAME='$table'";
        // $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
        // $stmt->bind_param('ss', $this->database, $table);
        // $stmt->bind_result($column_name, $column_key, $data_type);
        // $stmt->execute();
        $stmt = pg_query($this->sql,$query);
        while ($row = pg_fetch_assoc($stmt)) {
            $fields[] = array('column_name' => $row['column_name'], 'column_key' => '', 'data_type' => $row['data_type']);
        }
        return $fields;
        // $stmt->close();
        // $this->sql->close();
    }

}

$hc = new CRUZcode();
?>