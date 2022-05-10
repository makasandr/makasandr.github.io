<?php

class Trainer
{

    public static function getIdByUin($uin)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM trainers WHERE uin = :uin';

        $result = $db->prepare($sql);
        $result->bindParam(':uin', $uin, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        return $user['id'];
    }

    public static function getDataById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM trainers WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function getShortInfoById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname FROM trainers WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function getShortInfo()
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname FROM trainers';

        $result = $db->prepare($sql);
        $result->execute();

        $i = 0;
        $trainers = array();
        while ($row = $result->fetch()) {
            $trainers[$i]['id'] = $row['id'];
            $trainers[$i]['name'] = $row['name'];
            $trainers[$i]['surname'] = $row['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$row['id'].'.jpg')) $trainers[$i]['avatar'] = $trainer_avatar_path.$row['id'].'.jpg';
            else $trainers[$i]['avatar'] = $trainer_avatar_path.'0.jpg';
            $i++;
        }
        
        return $trainers;
    }

    public static function getMainStudents($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname FROM students WHERE main_trainer = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $students = array();
        while ($row = $result->fetch()) {
            $students[$i]['id'] = $row['id'];
            $students[$i]['name'] = $row['name'];
            $students[$i]['surname'] = $row['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$row['id'].'.jpg')) $students[$i]['avatar'] = $student_avatar_path.$row['id'].'.jpg';
            else $students[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $i++;
        }
        
        return $students;
    }

    public static function getSecondaryStudents($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname FROM students WHERE trainers LIKE :id_middle
                OR trainers LIKE :id_first
                OR trainers LIKE :id_last
                OR trainers = :id_one';
        $id_middle = '%,"'.$id.'",%';
        $id_first = '["'.$id.'",%';
        $id_last = '%,"'.$id.'"]';
        $id_one = '["'.$id.'"]';

        $result = $db->prepare($sql);
        $result->bindParam(':id_middle', $id_middle, PDO::PARAM_STR);
        $result->bindParam(':id_first', $id_first, PDO::PARAM_STR);
        $result->bindParam(':id_last', $id_last, PDO::PARAM_STR);
        $result->bindParam(':id_one', $id_one, PDO::PARAM_STR);
        $result->execute();

        $i = 0;
        $students = array();
        while ($row = $result->fetch()) {
            $students[$i]['id'] = $row['id'];
            $students[$i]['name'] = $row['name'];
            $students[$i]['surname'] = $row['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$row['id'].'.jpg')) $students[$i]['avatar'] = $student_avatar_path.$row['id'].'.jpg';
            else $students[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $i++;
        }
        
        return $students;
    }

    public static function revriteTrainers($id, $trainers)
    {
        $db = Db::getConnection();
        $sql = "UPDATE students SET trainers = :new_list WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':new_list', $trainers, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getTrainersList($from, $to, $order)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname, regdate FROM trainers WHERE regdate > '.$from.' AND regdate < '.$to;
        if ($order == 2) {
            $sql .= ' ORDER BY regdate DESC';
        }

        $result = $db->prepare($sql);
        $result->execute();

        $i = 0;
        $data = array();
        while ($row = $result->fetch()) {
            $data[$i]['id'] = $row['id'];
            $data[$i]['name'] = $row['name'];
            $data[$i]['surname'] = $row['surname'];
            $data[$i]['regdate'] = $row['regdate'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$row['id'].'.jpg')) $data[$i]['avatar'] = $trainer_avatar_path.$row['id'].'.jpg';
            else $data[$i]['avatar'] = $trainer_avatar_path.'0.jpg';
            $data[$i]['total'] = Transactions::getTrainerTotal($from, $to, $row['id']);
            $data[$i]['rating'] = Review::getRating($row['id']);
            $i++;
        }

        function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
            $sort_col = array();
            foreach ($arr as $key=> $row) {
                $sort_col[$key] = $row[$col];
            }

            array_multisort($sort_col, $dir, $arr);
        }

        if ($order == 1) {
            array_sort_by_column($data, 'total');
        } elseif ($order == 3) {
            array_sort_by_column($data, 'rating');
        }
        
        if ($i) return $data;
        return false;
    }

    public static function editTrainer($data, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE trainers SET name = :name, surname = :surname, status = :status, mail = :mail, phone = :phone, fb = :fb, instagram= :instagram, payment = :payment, price = :price, about = :about WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':surname', $data['surname'], PDO::PARAM_STR);
        $result->bindParam(':status', $data['status'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['answers'], PDO::PARAM_STR);
        $result->bindParam(':mail', $data['mail'], PDO::PARAM_STR);
        $result->bindParam(':phone', $data['phone'], PDO::PARAM_STR);
        $result->bindParam(':fb', $data['fb'], PDO::PARAM_STR);
        $result->bindParam(':instagram', $data['instagram'], PDO::PARAM_STR);
        $result->bindParam(':payment', $data['payment'], PDO::PARAM_STR);
        $result->bindParam(':price', $data['price'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function getProgramsNum($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM programs WHERE trainer = :trainer';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();
        
        return $row[0];
    }

}
