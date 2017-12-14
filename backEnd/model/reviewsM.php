<?php
require_once "db.php";

class reviewsModel extends db
{
    function starsNumber($items){
        $params = [$items["userId"]];
        $query = 'SELECT AVG( reviews.stars_number ) AS average
        FROM reviews
        WHERE user_id = ?';
        $sth = $this->db->prepare($query);
        $result = $sth->execute($params);
        return $result;
    }
	
}?>