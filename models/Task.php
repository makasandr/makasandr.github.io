<?php

class Task
{

    public static function getTasks($id, $day)
    {
        $db = Db::getConnection();
        $next_day = $day+86400;
        $sql = 'SELECT * FROM tasks WHERE trainer = :id AND date > '.$day.' AND date < '.$next_day;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $tasks = array();
        while ($row = $result->fetch()) {
            $tasks[$i]['id'] = $row['id'];
            $tasks[$i]['name'] = $row['name'];
            $tasks[$i]['date'] = $row['date'];
            $tasks[$i]['students'] = json_decode($row['students'], true);
            $tasks[$i]['status'] = $row['status'];
            $i++;
        }
        
        if ($i) return $tasks;
        return false;
    }

    public static function getTask($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM tasks WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function addTask($id, $data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO tasks (name, trainer, date, students, status) VALUES (:name, :trainer, :date, :students, 0)';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->bindParam(':date', $data['date'], PDO::PARAM_INT);
        $result->bindParam(':students', $data['students'], PDO::PARAM_STR);
        if ($result->execute()) return true;
        return false;
    }

    public static function delTask($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM tasks WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function setDone($id)
    {
        $db = Db::getConnection();
        $sql = "UPDATE tasks SET status = 1 WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
