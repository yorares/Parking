<?php
class db{
	protected $db;

	function __construct(){
		$servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $database = "parking";
    
        try {
            $this->db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);    
            $this->db->setAttribute(PDO::ATTR_EMULATE_PREPARES, 1);
        } catch(PDOException $e) {
            die('Unable to connect');
        }
    }

function executeQuery($query){
	$sth = $this->db->prepare($query);
    $sth->execute();
    return $sth->fetchAll(PDO::FETCH_ASSOC);
}




}?>