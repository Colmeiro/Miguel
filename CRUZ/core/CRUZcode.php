<?php

class CRUZcode
{

    private $host;
    private $user;
    private $password;
    public $database;
    private $dbdriver;
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
        $this->dbdriver = $db['default']['dbdriver'];

        switch($this->dbdriver){
            case 'mysqli':
                $this->sql = new mysqli($this->host, $this->user, $this->password, $this->database);
                if ($this->sql->connect_error)
                {
                    echo $this->sql->connect_error . ", please check 'application/config/database.php'.";
                    die();
                }
            break;
            case 'postgre':
                $this->sql = pg_connect("host=".$this->host." port=5432 dbname=".$this->database." user=".$this->user." password=".$this->password."");
            break;
        }
        
        unlink($con);
    }

    function table_list()
    {
        switch($this->dbdriver){
            case 'mysqli':
                $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA=?";
                $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
                $stmt->bind_param('s', $this->database);
                $stmt->bind_result($table_name);
                $stmt->execute();
                while ($stmt->fetch()) {
                    $fields[] = array('table_name' => $table_name);
                }
                return $fields;
                $stmt->close();
                $this->sql->close();
            break;
            case 'postgre':
                $query = "SELECT TABLE_NAME FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA='public'";
                $stmt = pg_query($this->sql,$query);
                while ($row = pg_fetch_assoc($stmt)) {
                    $fields[] = array('table_name' => $row['table_name']);
                }
                return $fields;
                pg_close($this->sql);
            break;
        }

        
    }

    function primary_field($table)
    {
        switch($this->dbdriver){
            case 'mysqli':
                $query = "SELECT COLUMN_NAME,COLUMN_KEY FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY = 'PRI'";
                $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (primary_field)");
                $stmt->bind_param('ss', $this->database, $table);
                $stmt->bind_result($column_name, $column_key);
                $stmt->execute();
                $stmt->fetch();
                return $column_name;
                $stmt->close();
                $this->sql->close();
            break;
            case 'postgre':
                $query = "SELECT a.attname as column_name, format_type(a.atttypid, a.atttypmod) AS data_type
                FROM   pg_index i
                JOIN   pg_attribute a ON a.attrelid = i.indrelid
                                    AND a.attnum = ANY(i.indkey)
                WHERE  i.indrelid = '$table'::regclass
                AND    i.indisprimary;";
                $stmt = pg_query($this->sql,$query);
                $row = pg_fetch_assoc($stmt);
                return $row['column_name'];
                pg_close($this->sql);
            break;
        }
        
    }

    function not_primary_field($table)
    {
        switch($this->dbdriver){
            case 'mysqli':
                $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=? AND COLUMN_KEY <> 'PRI'";
                $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
                $stmt->bind_param('ss', $this->database, $table);
                $stmt->bind_result($column_name, $column_key, $data_type);
                $stmt->execute();
                while ($stmt->fetch()) {
                    $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
                }
                return $fields;
                $stmt->close();
                $this->sql->close();
            break;
            case 'postgre':
                $query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='public' AND TABLE_NAME='$table' AND column_name not in (SELECT a.attname as column_name
                FROM   pg_index i
                JOIN   pg_attribute a ON a.attrelid = i.indrelid
                                    AND a.attnum = ANY(i.indkey)
                WHERE  i.indrelid = '$table'::regclass
                AND    i.indisprimary)";

                $stmt = pg_query($this->sql,$query);
                while ($row = pg_fetch_assoc($stmt)) {
                    $fields[] = array('column_name' => $row['column_name'], 'column_key' => $row['column_key'], 'data_type' => $row['data_type']);
                }
                return $fields;
                pg_close($this->sql);
            break;
        }
        
    }

    function all_field($table)
    {
        switch($this->dbdriver){
            case 'mysqli':
                $query = "SELECT COLUMN_NAME,COLUMN_KEY,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA=? AND TABLE_NAME=?";
                $stmt = $this->sql->prepare($query) OR die("Error code :" . $this->sql->errno . " (not_primary_field)");
                $stmt->bind_param('ss', $this->database, $table);
                $stmt->bind_result($column_name, $column_key, $data_type);
                $stmt->execute();
                while ($stmt->fetch()) {
                    $fields[] = array('column_name' => $column_name, 'column_key' => $column_key, 'data_type' => $data_type);
                }
                return $fields;
                $stmt->close();
                $this->sql->close();
            break;
            case 'postgre':
                $query = "SELECT COLUMN_NAME,DATA_TYPE FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA='public' AND TABLE_NAME='$table'";
                $stmt = pg_query($this->sql,$query);
                while ($row = pg_fetch_assoc($stmt)) {
                    $fields[] = array('column_name' => $row['column_name'], 'column_key' => '', 'data_type' => $row['data_type']);
                }
                return $fields;
                pg_close($this->sql);
            break;
        }
        
    }

}

$hc = new CRUZcode();
?>