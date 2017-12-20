<?php
require_once "db.php";
class chatModel extends db
{
    function getChat($items){
        $params = [$items["id"]];
        $query = 'SELECT chat.id, users.user_name, chat.content, chat.date_sent, chat.date_read FROM `chat` INNER JOIN users ON chat.user_id = users.id WHERE `user_id_recive` = ?';
        $sth = $this->db->prepare($query);
        $sth->execute($params);
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }


}?>