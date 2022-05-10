<?php

class Admin
{

    public static function checkPass($pass)
    {
        $db = Db::getConnection();
        $sql = 'SELECT pass FROM admin WHERE pass = :pass';

        $result = $db->prepare($sql);
        $result->bindParam(':pass', $pass, PDO::PARAM_STR);
        $result->execute();

        if($user = $result->fetch()) return true;
        return false;
    }

    public static function addStudent($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO students (name, surname, main_trainer, trainers, about, mail, phone, regdate, uin) VALUES (:name, :surname, :main_trainer, "[]", "[]", :mail, :phone, '.time().', :uin)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
        $result->bindParam(':main_trainer', $data['main_trainer'], PDO::PARAM_INT);
        $result->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':uin', $data['uin'], PDO::PARAM_STR);
        if ($result->execute()) {
	        $last_id = $db->lastInsertId();

	        $sql = 'INSERT INTO personal (student, lessons, status) VALUES ('.$last_id.', "[]", "[]")';
	        $result = $db->prepare($sql);
	        if ($result->execute()) {
	        	$sql = 'INSERT INTO targets (student, physical, personal, other) VALUES ('.$last_id.', "[]", "[]", "[]")';
		        $result = $db->prepare($sql);
		        if ($result->execute()) {
                    $sql = 'INSERT INTO cart (student, programs) VALUES ('.$last_id.', "[]")';
                    $result = $db->prepare($sql);
                    if ($result->execute()) return true;
                }
	        }
	    }

	    return false;
    }

    public static function changeStudent($data, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE students SET name = :name, surname = :surname, main_trainer = :main_trainer, mail = :mail, phone = :phone, uin = :uin WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
        $result->bindParam(':main_trainer', $data['main_trainer'], PDO::PARAM_INT);
        $result->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':uin', $data['uin'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function addTrainer($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO trainers (name, surname, about, mail, phone, price, payment, regdate, uin) VALUES (:name, :surname, "[]", :mail, :phone, :price, :payment, '.time().', :uin)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
        $result->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':price', $data['price'], PDO::PARAM_STR);
        $result->bindParam(':payment', $data['payment'], PDO::PARAM_STR);
        $result->bindParam(':uin', $data['uin'], PDO::PARAM_STR);
        if ($result->execute()) {
	        $last_id = $db->lastInsertId();

        	$sql = 'INSERT INTO targets (trainer, physical, personal, other) VALUES ('.$last_id.', "[]", "[]", "[]")';
	        $result = $db->prepare($sql);
	        if ($result->execute()) return true;
	    }

	    return false;
    }

    public static function changeTrainer($data, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE trainers SET name = :name, surname = :surname, mail = :mail, phone = :phone, price = :price, payment = :payment, uin = :uin WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
        $result->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':price', $data['price'], PDO::PARAM_STR);
        $result->bindParam(':payment', $data['payment'], PDO::PARAM_STR);
        $result->bindParam(':uin', $data['uin'], PDO::PARAM_STR);
        return $result->execute();
    }

}