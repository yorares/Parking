<?php
require_once "db.php";
class parkingModel extends db
{

    // edit getall
    function selectAll(){
		$query = 'SELECT * FROM `parking` WHERE 1';
    	return $this->executeQuery($query);
    }
	function updateItem($items){
        $params = [$items["price"],
                    $items["longitude"],
                    $items["latitude"],
                    $items["parkingNum"],
                    $items["startDate"],
                    $items["endDate"],
                    $items["details"],
                    $items["userId"]];
                    $query = 'UPDATE `parking` SET `price`=?,`longitude`=?,`latitude`=?,`parking_num`=?,`start_date`=?,`end_date`=?,`details`=? WHERE user_id = ?';
                    $sth = $this->db->prepare($query);
                    $sth->execute($params);
                    return $sth->rowCount();
    }

	function insertItem($items){
        $params = [ $items["price"],
                    $items["longitude"],
                    $items["latitude"],
                    $items["userId"],
                    $items["parkingNum"],
                    $items["startDate"],
                    $items["endDate"],
                    $items["details"]];

        $query = 'INSERT INTO `parking`( `price`, `longitude`, `latitude`, `user_id`, `parking_num`, `start_date`, `end_date`, `details`) VALUES (?,?,?,?,?,?,?,?)';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $this->db->lastInsertId();
    }


}?>