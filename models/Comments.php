<?php

class Comments
{
    public static function getSome($id, $lesson, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM comments WHERE student = :id AND lesson = :lesson ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':lesson', $lesson, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['message'] = $row['message'];
            $messages[$i]['date'] = $row['date'];

            $messages[$i]['type'] = $row['type'];
            if ($row['type']) {
                if ($program = Program::getProgramByLessonId($lesson)) {
                    $lesson_info = Program::getProgram($program);
                } else {
                    $lesson_info = Program::getLessonPreview($lesson);
                }
                $trainer_data = Trainer::getShortInfoById($lesson_info['trainer']);
                $messages[$i]['user_id'] = $trainer_data['id'];
                $messages[$i]['name'] = $trainer_data['name'];
                $messages[$i]['surname'] = $trainer_data['surname'];
                $trainer_avatar_path = '/upload/images/trainers/avatar/';
                if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $messages[$i]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
                else $messages[$i]['avatar'] = $trainer_avatar_path.'0.jpg';
            } else {
                $student_data = Student::getShortInfoById($row['student']);
                $messages[$i]['user_id'] = $student_data['id'];
                $messages[$i]['name'] = $student_data['name'];
                $messages[$i]['surname'] = $student_data['surname'];
                $student_avatar_path = '/upload/images/trainers/avatar/';
                if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$i]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
                else $messages[$i]['avatar'] = $student_avatar_path.'0.jpg';
            }
            $i++;
        }
        
        if (!empty($messages)) return $messages;
        return false;
    }

    public static function addSome($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO comments (lesson, student, type, message, date) VALUES (:lesson, :student, :type, :message, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':lesson', $data['lesson'], PDO::PARAM_INT);
        $result->bindParam(':student', $data['student'], PDO::PARAM_INT);
        $result->bindParam(':type', $data['type'], PDO::PARAM_INT);
        $result->bindParam(':message', $data['message'], PDO::PARAM_STR);
        if ($result->execute()) {
            return true;
        }
        return false;
    }

    public static function delSome($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM comments WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOne($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM comments WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }


    public static function getSomeProg($program, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM prog_comments WHERE program = :program ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $messages = array();
        $i = 0;
        while ($row = $result->fetch()) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['message'] = $row['message'];
            $messages[$i]['date'] = $row['date'];
            $student_data = Student::getShortInfoById($row['student']);
            $messages[$i]['user_id'] = $student_data['id'];
            $messages[$i]['name'] = $student_data['name'];
            $messages[$i]['surname'] = $student_data['surname'];
            $student_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$i]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
            else $messages[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $i++;
        }
        
        if (!empty($messages)) return $messages;
        return false;
    }

    public static function addSomeProg($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO prog_comments (student, program, message, date) VALUES (:student, :program, :message, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $data['student'], PDO::PARAM_INT);
        $result->bindParam(':program', $data['program'], PDO::PARAM_INT);
        $result->bindParam(':message', $data['message'], PDO::PARAM_STR);
        if ($result->execute()) {
            return true;
        }
        return false;
    }

    public static function delSomeProg($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM prog_comments WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getOneProg($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM prog_comments WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }
}
