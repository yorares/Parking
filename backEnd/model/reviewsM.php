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
    function deteleReviews($item){
        if($_SESSION["role"] == "admin"){
            $params = [$item];
            $query = 'DELETE FROM `reviews` WHERE id = ?';
            $sth = $this->db->prepare($query);
            $sth->execute($params);
            return $sth->rowCount();
        }
    }
    function selectAll(){
        $query = 'SELECT reviews.id, reviews.stars_number, reviews.total_num_reviews, reviews.message, users.user_name, parking.user_id, reviews.creation_date FROM `reviews` INNER JOIN users ON reviews.user_id = users.id INNER JOIN parking ON reviews.parking_id = parking.id WHERE 1';
    	return $this->executeQuery($query);
    }

}?>