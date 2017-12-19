<?php
require_once "db.php";
class priceModel extends db
{
    function historyOfParking($items){
        $params = [$items];
        $query = 'SELECT  `parking_id`, `car_number`, `price`, `payment_date` FROM `payment` WHERE `user_id` = 2';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    function payParking($item){
        $params = [ $item["parkingId"],
                    $item["userId"],
                    $item["carNumber"],
                    $item["price"]];

        $query = 'INSERT INTO `payment`(`parking_id`, `user_id`, `car_number`, `price`, `payment_date`) VALUES (?,?,?,?,NOW())';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $this->db->lastInsertId();
    }
    function getPrice($items){
        $params = [$items];
        $query = 'SELECT `price` FROM `parking` WHERE `id` = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetch(PDO::FETCH_ASSOC);
    }


}?>