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
            $query = "SELECT `id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `admin`, `last_login`, `creation_date` FROM `users` WHERE `email` = ? && password = ?;";
        }else if (!empty($item["user"])){
            $item["who"] = $item["user"];
            $query = "SELECT `id`, `user_name`, `password`, `first_name`, `last_name`, `email`, `admin`, `last_login`, `creation_date` FROM `users` WHERE `user_name` = ? && password = ?;";
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
        $params = [ $item["userName"]];

        $query = 'SELECT * FROM `users` WHERE email = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }
    function deleteItem($item){
        $params = [$item];

        $query = 'DELETE FROM `users` WHERE id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->rowCount();
    }
    function selectItemByName($items){
        $params = [$items];

        $query = 'SELECT * FROM `users` WHERE user_name = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);

        return $sth->fetch(PDO::FETCH_ASSOC);
    }

    function changeStatus($item){
        $params=[$item];
        $query = 'UPDATE `users` SET user_status="online", last_login = CURENT_TIMESTAMP   WHERE user_id = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
    }

}?>