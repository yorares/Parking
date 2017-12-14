<?php
require_once "db.php";

class reviewsModel extends db
{
    function starsNumber($items){
        $params = [$items];
        $query = 'SELECT AVG( reviews.stars_number ) AS average
        FROM reviews
        WHERE user_id = ?';
        $sth = $this->db->prepare($query);
<<<<<<< HEAD
        $sth->execute($params); //returns true
        $result = $sth->fetch(PDO::FETCH_ASSOC); //returns the result
=======
        $sth->execute($params);
        $result = $sth->fetch(PDO::FETCH_ASSOC);
>>>>>>> 964e6c9b1b2ae662e9b9010874adbcbc00d94e7c
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