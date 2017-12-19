<?php
require_once "db.php";
class parkingModel extends db
{
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