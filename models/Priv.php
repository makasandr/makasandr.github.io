<?php

class Priv
{
    public static function getStudentMessages($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM private WHERE student = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['from'] = $row['from_stud'];
            $messages[$i]['trainer'] = $trainer_data['id'];
            $messages[$i]['name'] = $trainer_data['name'];
            $messages[$i]['surname'] = $trainer_data['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $messages[$i]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
            else $messages[$i]['avatar'] = $trainer_avatar_path.'0.jpg';
            $messages[$i]['message'] = $row['message'];
            $messages[$i]['images'] = json_decode($row['images'], true);
            $messages[$i]['type'] = $row['type'];
            $messages[$i]['status'] = $row['status'];
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function getStudentMessagesFromTrainer($id, $trainer, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM private WHERE student = :id AND trainer = :trainer ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['from'] = $row['from_stud'];
            $messages[$i]['trainer'] = $trainer_data['id'];
            $messages[$i]['name'] = $trainer_data['name'];
            $messages[$i]['surname'] = $trainer_data['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $messages[$i]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
            else $messages[$i]['avatar'] = $trainer_avatar_path.'0.jpg';
            $messages[$i]['message'] = $row['message'];
            $messages[$i]['images'] = json_decode($row['images'], true);
            $messages[$i]['type'] = $row['type'];
            $messages[$i]['status'] = $row['status'];
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function getMessagesFromTrainer($trainer, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM private WHERE trainer = :trainer ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $student_data = Student::getShortInfoById($row['student']);
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['from'] = $row['from_stud'];
            $messages[$i]['student'] = $student_data['id'];
            $messages[$i]['name'] = $student_data['name'];
            $messages[$i]['surname'] = $student_data['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$i]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
            else $messages[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $messages[$i]['message'] = $row['message'];
            $messages[$i]['images'] = json_decode($row['images'], true);
            $messages[$i]['type'] = $row['type'];
            $messages[$i]['status'] = $row['status'];
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function setYes($id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE private SET status = 1 WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function setNo($id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE private SET status = 2 WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getImages($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT images FROM private WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) {
            return json_decode($row[0], true);
        } else return 0;
    }

    public static function addPriv($id, $date)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO private (student, trainer, type, message, images, status, date) VALUES (:student, :trainer, :type, :message, "[]", 0, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $date['student'], PDO::PARAM_INT);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->bindParam(':type', $date['type'], PDO::PARAM_INT);
        $result->bindParam(':message', $date['message'], PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function addPrivStud($id, $date)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO private (student, trainer, from_stud, type, message, images, status, date) VALUES (:student, :trainer, 1, :type, :message, "[]", 0, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $date['trainer'], PDO::PARAM_INT);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->bindParam(':type', $date['type'], PDO::PARAM_INT);
        $result->bindParam(':message', $date['message'], PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function checkMessageStud($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT student, from_stud FROM private WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();

        if ($row[1]) {
            return $row[0];
        } else return 0;
    }

    public static function delPriv($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM private WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function addImage($id, $code)
    {
        $db = Db::getConnection();
        $sql = "UPDATE private SET images = :images WHERE id = :id";

        $images = self::getImages($id);
        $images[] = $id.$code;
        $images = json_encode($images);
        $result = $db->prepare($sql);
        $result->bindParam(':images', $images, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
