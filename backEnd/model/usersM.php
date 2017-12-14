<?php
require_once "db.php";
class usersModel extends db
{
	public function insertItem($item) {
        $params = [ $item["firstName"],
                    $item["lastName"],
                    $item["userName"],
                    $item["email"],
                    $item["password"],
                    $item["birthDate"],
                    $item["phone"],
                    $item["userIp"]];

        $query = 'INSERT INTO `users`(`first_name`, `last_name`, `user_name`, `email`, `password`, `birth_date`, `phone`, `user_ip`) VALUES (?,?,?,?,?,?,?,?)';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $this->db->lastInsertId();
    }
    function selectItem($item){
        if(!empty($item["email"])){
            $item["who"] = $item["email"];
            $query = "SELECT `id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `role`, `last_login`, `creation_date`, `active` FROM `users` WHERE `email` = ? && password = ?;";
        }else if (!empty($item["user"])){
            $item["who"] = $item["user"];
            $query = "SELECT `id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `role`, `last_login`, `creation_date`, `active` FROM `users` WHERE `user_name` = ? && password = ?;";
        }
        $params = [$item["who"],
                    $item["password"]];
        $sth = $this->db->prepare($query);
        $sth->execute($params);

        //var_dump($sth->fetch(PDO::FETCH_ASSOC));
        return $sth->fetch(PDO::FETCH_ASSOC);
    }
    function checkEmail($item){
        $params = [ $item["email"] ];
        $query = 'SELECT * FROM `users` WHERE email = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }

    function checkUser($item){
        $params = [ $item["user_name"] ];
        $query = 'SELECT * FROM `users` WHERE user_name = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }

    function deleteItem($item){
        if($_SESSION["role"] == "admin"){
           $params = [$item];
        $query = 'DELETE FROM `users` WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
        }
    }
    function selectItemByName($items){
        $params = [$items];
        $query = 'SELECT * FROM `users` WHERE user_name = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    function selectAll(){
		$query = 'SELECT * FROM `users` WHERE 1';
    	return $this->executeQuery($query);
    }
    
    function editItem($item){
        $params = [ $item["firstName"],
                   $item["lastName"],
                   $item["userName"],
                   $item["email"],
                   $item["password"],
                   $item["birthDate"],
                   $item["phone"],
                   $item["id"]];

        $query = 'UPDATE `users` SET `first_name`=?,`last_name`=?,`user_name`=?,`email`=?,`password`=?,`birth_date`=?,`phone`=?,`picture_link`=? WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $this->db->rowCount();
    }

    function changeStatus($item){
        $params=[$item];
        $query = 'UPDATE `users` SET user_status="online", last_login = NOW() WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
    }
    function banUser($item){
        $params = [ $item["banTime"],
                   $item["id"]];

        $query = 'UPDATE `users` SET active="banned",`ban_time`= ? WHERE `id`=?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }
    function unBanUser($item){
        $params = [ $item["id"]];

        $query = 'UPDATE `users` SET active="unbanned", ban_time = null WHERE `id`=?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }

    function logOut($item){
        $params=[$item];
        $query = 'UPDATE `users` SET user_status = "offline"  WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }

    // function checkBirthDate(){
    //     $hour = date("h");
    //     $day = date("d");
    //     $year = date("y");
    //     $month = date("m");
    //     $date = "$year"."-"."$month"."-"."$day";
    //     $query = 'SELECT `first_name`, `last_name` FROM `users` WHERE birth_date = $date'; 
    //     // $datas = 'SELECT  FROM `user` WHERE birth_date = $year-$month-$day';
    //     $sth = $this->db->prepare($query);
    //     $sth->execute();
    //     return $sth->fetch(PDO::FETCH_ASSOC);
    // }
}?>