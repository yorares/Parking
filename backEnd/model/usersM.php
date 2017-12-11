<?php
require_once "db.php";
class usersModel extends db
{
	protected function insertItem($item) {
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

}?>