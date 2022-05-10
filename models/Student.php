<?php

class Student
{
    public static function checkUin($uin)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM students WHERE uin = :uin';

        $result = $db->prepare($sql);
        $result->bindParam(':uin', $uin, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();

        if ($user) {
            return 1;
        } else {
            $sql = 'SELECT id FROM trainers WHERE uin = :uin';

            $result = $db->prepare($sql);
            $result->bindParam(':uin', $uin, PDO::PARAM_STR);
            $result->execute();

            $user = $result->fetch();

            if ($user) {
                return 2;
            }
        }
        return false;
    }

    public static function getIdByUin($uin)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM students WHERE uin = :uin';

        $result = $db->prepare($sql);
        $result->bindParam(':uin', $uin, PDO::PARAM_STR);
        $result->execute();

        $user = $result->fetch();
        return $user['id'];
    }

    public static function getDataById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM students WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function getShortInfoById($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname FROM students WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function isTrainer($id, $trainer)
    {
        $db = Db::getConnection();
        $sql = 'SELECT main_trainer, trainers FROM students WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();

        if ($trainer == $data['main_trainer']) return true;

        $trainers = json_decode($data['trainers'], true);
        foreach ($trainers as $value) {
            if ($trainer == $value) return true;
        }

        return false;
    }

    public static function raise($next_level, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE students SET level = :level WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':level', $next_level, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getStudentsList($from, $to, $order)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, surname, regdate, level FROM students WHERE regdate > '.$from.' AND regdate < '.$to;
        if ($order == 2) {
            $sql .= ' ORDER BY regdate DESC';
        } elseif ($order == 3) {
            $sql .= ' ORDER BY level DESC';
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
            $data[$i]['level'] = $row['level'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$row['id'].'.jpg')) $data[$i]['avatar'] = $student_avatar_path.$row['id'].'.jpg';
            else $data[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $data[$i]['total'] = Transactions::getStudentTotal($from, $to, $row['id']);
            $i++;
        }

        if ($order == 1) {
            function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) {
                $sort_col = array();
                foreach ($arr as $key=> $row) {
                    $sort_col[$key] = $row[$col];
                }

                array_multisort($sort_col, $dir, $arr);
            }

            array_sort_by_column($data, 'total');
        }
        
        if ($i) return $data;
        return false;
    }

    public static function editStudent($data, $id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE students SET name = :name, surname = :surname, status = :status, mail = :mail, phone = :phone, fb = :fb, instagram = :instagram, about = :about WHERE id = :id";

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
        return $result->execute();
    }

    public static function getFinishedPrograms($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        while ($row = $result->fetch()) {
            $statuses = json_decode($row['status'], true);
            $check = true;
            foreach ($statuses as $value) {
                if (!$value) {
                    $check = false;
                }
            }
            if ($check) {
                $total++;
            }
        }
        
        return $total;
    }

    public static function getCountPersonal($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons FROM personal WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();

        $lessons = json_decode($row['lessons'], true);
        
        return count($lessons);
    }

    public static function getFinishedPersonal($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM personal WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();

        $total = 0;
        $statuses = json_decode($row['status'], true);
        foreach ($statuses as $value) {
            if ($value) {
                $total++;
            }
        }
        
        return $total;
    }

}
