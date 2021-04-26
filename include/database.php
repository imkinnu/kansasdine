<?php
/**
 * Database.php
 *
 * The Database class is meant to simplify the task of accessing
 * information from the website's database.
 *
 * Written by: Jpmaster77 a.k.a. The Grandmaster of C++ (GMC)
 * Last Updated: June 15, 2011 by Ivan Novak
 */
include("header.php");


class MySQLDB
{
    var $connection;

    function __construct(){
        /* Make connection to database */



        try
        {
            $this->connection = new PDO("mysql:host=".DB_SERVER.";dbname=".DB_NAME,DB_USER, DB_PASS);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }


        // mysqli_select_db(DB_NAME, $this->connection) or die(mysqli_error());

        /**
         * Only query database to find out number of members
         * when getNumMembers() is called for the first time,
         * until then, default value set.
         */

    }
    function query($query)
    {


        $operation = substr($query,0,6);


        //Test for basic injection
        $comment = explode('--',$query);

        $union1 = explode("' UNION SELECT",$query);

        $union2 = explode("'; UNION SELECT",$query);

        $sleep = explode("SLEEP",$query);

        $benchmark = explode("BENCHMARK",$query);
        $union3 = explode("' UNION ALL SELECT",$query);

        $makeset = explode("MAKE",$query);

        $version  = explode("version",strtolower($query));

        $infoschema = explode("information_schema", strtolower($query));


        $randnum = explode("randnum(", strtolower($query));
        $elt = explode("elt(", strtolower($query));

        $ordmid = explode("ord(mid",strtolower($query));



        $xss  = explode("script",strtolower($query));





        if(count($comment) > 1 || count($union1) > 1 || count($union2) > 1 || count($sleep) > 1 || count($benchmark) > 1 || count($union3) > 1 || count($makeset) > 1|| count($version) > 1 || count($xss) > 1 || count($infoschema) > 1|| count($randnum) > 1|| count($elt) > 1 || count($ordmid) > 1 ){
            return false;
        }
        /*

        if(strtoupper($operation) == 'SELECT'){

        if (mysqli_ping($this->connection1)) {
        //    printf ("ok!\n");
        }
        return mysqli_query( $this->connection1,$query);

        }

        */
        //  echo $query;
        return $this->connection->query($query);
    }
    function get_name($table,$column,$id,$what)
    {

        $query="SELECT * FROM `".$table."` WHERE `".$column."` = '".$id."'";
        $selection = $this->query($query);

        $data = $selection->fetch( PDO::FETCH_ASSOC );

        if($what != NULL){

            return $data[$what];

        }

        else{

            return $selection;

        }

    }
    function successMessage()
    {
        echo "<script>alert('".SUCCESS_MESSAGE."');</script>";
    }
    function throwVechicleError()
    {
        echo "<script>alert('".VEHICLE_ERROR."')</script>";
    }
    function throwLoadError()
    {
        echo "<script>alert('".LOAD_ERROR."')</script>";
    }
    function throwCustomError($error)
    {
        echo "<script>alert('".$error."')</script>";
    }
    function getColumns($dbname,$table)
    {
        $bind_array['db'] = $dbname;
        $bind_array['table'] = $table;
        $columns = [];


        $getCol = $this->connection->prepare("SELECT `COLUMN_NAME` FROM `INFORMATION_SCHEMA`.`COLUMNS` WHERE TABLE_SCHEMA=:db AND TABLE_NAME=:table");
        $getCol ->execute($bind_array);
        while($getColumns = $getCol->fetch(PDO::FETCH_ASSOC))
        {
            $columns[] = $getColumns['COLUMN_NAME'];
        }

        return $columns;
    }
    function log($post,$type)
    {
        $insert = $this->connection->prepare("insert into log values (NULL,:type,:post,:timestamp)");
        $insert ->execute(array('type'=>$type,'post'=>serialize($post),'timestamp'=>time()));

        return true;
    }
    function cleanInput($post = array()) {
        foreach($post as $k => $v){
            $post[$k] = trim(htmlspecialchars($v));
        }
        return $post;
    }

};

/* Create database connection */
$database = new MySQLDB;

?>
