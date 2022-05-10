<?php

class Awards
{
    public static function getSome($id, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM awards WHERE student = :id ORDER BY id DESC';
        if ($limit) {
            $sql .= ' LIMIT '.$limit;
        }

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $awards = array();
        while ($row = $result->fetch()) {
            $awards[$row['id']]['id'] = $row['id'];
            $awards[$row['id']]['message'] = $row['message'];
            $awards[$row['id']]['date'] = $row['date'];
            $awards[$row['id']]['type'] = $row['type'];

            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $awards[$row['id']]['name'] = $trainer_data['name'];
            $awards[$row['id']]['surname'] = $trainer_data['surname'];
            $trainer_avatar_path = '/upload/images/trainers/avatar/';
            if (file_exists(ROOT.$trainer_avatar_path.$trainer_data['id'].'.jpg')) $awards[$row['id']]['avatar'] = $trainer_avatar_path.$trainer_data['id'].'.jpg';
            else $awards[$row['id']]['avatar'] = $trainer_avatar_path.'0.jpg';
        }
        
        if (!empty($awards)) return $awards;
        return false;
    }

    public static function addSome($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO awards (student, trainer, message, type, date) VALUES (:student, :trainer, :message, :type, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $data['student'], PDO::PARAM_INT);
        $result->bindParam(':trainer', $data['trainer'], PDO::PARAM_INT);
        $result->bindParam(':message', $data['message'], PDO::PARAM_STR);
        $result->bindParam(':type', $data['type'], PDO::PARAM_INT);
        if ($result->execute()) {
            return true;
        }
        return false;
    }

    public static function getOne($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM awards WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

}
