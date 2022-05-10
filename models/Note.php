<?php

class Note
{
    public static function getStudentNotes($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM notes WHERE student = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['note'] = $row['note'];
            $messages[$i]['images'] = json_decode($row['images'], true);
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function getImages($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT images FROM notes WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) {
            return json_decode($row[0], true);
        } else return 0;
    }

    public static function getTrainerNotes($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM notes WHERE trainer = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['note'] = $row['note'];
            $messages[$i]['images'] = json_decode($row['images'], true);
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function addNoteStud($id, $note)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO notes (student, note, images, date) VALUES (:student, :note, "[]", '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $id, PDO::PARAM_INT);
        $result->bindParam(':note', $note, PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function addNoteTrain($id, $note)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO notes (trainer, note, images, date) VALUES (:trainer, :note, "[]", '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->bindParam(':note', $note, PDO::PARAM_STR);
        if ($result->execute()) return $db->lastInsertId();
        return false;
    }

    public static function checkMessageStud($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT student FROM notes WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) {
            return $row[0];
        } else return 0;
    }

    public static function checkMessageTrain($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT trainer FROM notes WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) {
            return $row[0];
        } else return 0;
    }

    public static function delNote($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM notes WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function addImage($id, $code)
    {
        $db = Db::getConnection();
        $sql = "UPDATE notes SET images = :images WHERE id = :id";

        $images = self::getImages($id);
        $images[] = $id.$code;
        $images = json_encode($images);
        $result = $db->prepare($sql);
        $result->bindParam(':images', $images, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
