<?php

class Blogs
{

    public static function getMessages($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM blogs WHERE trainer = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        while ($row = $result->fetch()) {
            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $messages[$row['date']]['id'] = $row['id'];
            $messages[$row['date']]['trainer'] = $trainer_data['id'];
            $messages[$row['date']]['name'] = $trainer_data['name'];
            $messages[$row['date']]['surname'] = $trainer_data['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $messages[$row['date']]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
            else $messages[$row['date']]['avatar'] = $trainer_avatar_path.'0.jpg';
            $messages[$row['date']]['message'] = $row['message'];
            $messages[$row['date']]['images'] = json_decode($row['images'], true);
            $messages[$row['date']]['date'] = $row['date'];
        }
        
        return $messages;
    }

    public static function getMessagesStud($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM blogs WHERE student = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        while ($row = $result->fetch()) {
            $student_data = Trainer::getShortInfoById($row['student']);
            $messages[$row['date']]['id'] = $row['id'];
            $messages[$row['date']]['student'] = $student_data['id'];
            $messages[$row['date']]['name'] = $student_data['name'];
            $messages[$row['date']]['surname'] = $student_data['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$row['date']]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
            else $messages[$row['date']]['avatar'] = $student_avatar_path.'0.jpg';
            $messages[$row['date']]['message'] = $row['message'];
            $messages[$row['date']]['images'] = json_decode($row['images'], true);
            $messages[$row['date']]['date'] = $row['date'];
        }
        
        return $messages;
    }

    public static function checkMessageStud($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT student FROM blogs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        
        return $row[0];
    }

    public static function getCount($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM blogs WHERE trainer = :trainer';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();
        
        return $row[0];
    }

    public static function getCountStud($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM blogs WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();
        
        return $row[0];
    }

    public static function getMessagesForDate($id, $start, $end)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM blogs WHERE trainer = :id AND date > '.$start.' AND date < '.$end.' ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        while ($row = $result->fetch()) {
            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $messages[$row['date']]['id'] = $row['id'];
            $messages[$row['date']]['trainer'] = $trainer_data['id'];
            $messages[$row['date']]['name'] = $trainer_data['name'];
            $messages[$row['date']]['surname'] = $trainer_data['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $messages[$row['date']]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
            else $messages[$row['date']]['avatar'] = $trainer_avatar_path.'0.jpg';
            $messages[$row['date']]['message'] = $row['message'];
            $messages[$row['date']]['images'] = json_decode($row['images'], true);
            $messages[$row['date']]['date'] = $row['date'];
        }
        
        return $messages;
    }

    public static function getMessagesForDateStud($id, $start, $end)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM blogs WHERE student = :id AND date > '.$start.' AND date < '.$end.' ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        while ($row = $result->fetch()) {
            $student_data = Student::getShortInfoById($row['student']);
            $messages[$row['date']]['id'] = $row['id'];
            $messages[$row['date']]['student'] = $student_data['id'];
            $messages[$row['date']]['name'] = $student_data['name'];
            $messages[$row['date']]['surname'] = $student_data['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$row['date']]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
            else $messages[$row['date']]['avatar'] = $student_avatar_path.'0.jpg';
            $messages[$row['date']]['message'] = $row['message'];
            $messages[$row['date']]['images'] = json_decode($row['images'], true);
            $messages[$row['date']]['date'] = $row['date'];
        }
        
        return $messages;
    }

    public static function addBlog($id, $message)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO blogs (trainer, message, images, date) VALUES (:trainer, :message, "[]", '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function addBlogStud($id, $message)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO blogs (student, message, images, date) VALUES (:student, :message, "[]", '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->bindParam(':message', $message, PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function getImages($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT images FROM blogs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) {
            return json_decode($row[0], true);
        } else return 0;
    }

    public static function delBlog($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM blogs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function addImage($id, $code)
    {
        $db = Db::getConnection();
        $sql = "UPDATE blogs SET images = :images WHERE id = :id";

        $images = self::getImages($id);
        $images[] = $id.$code;
        $images = json_encode($images);
        $result = $db->prepare($sql);
        $result->bindParam(':images', $images, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
