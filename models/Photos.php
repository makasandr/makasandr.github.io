<?php

class Photos
{

    public static function getStudentLastPhoto($id, $category)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM photos WHERE student = :id AND category = :category ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->execute();

        $photo = $result->fetch();
        if (!$photo) return 0;
        return $photo['id'];
    }

    public static function getStudentPhotoCount($id, $category)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM photos WHERE student = :id AND category = :category';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->execute();

        $count = $result->fetch();
        return $count[0];
    }

    public static function getStudentPhotos($id, $category, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE student = :id AND category = :category ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $photos = array();
        while ($row = $result->fetch()) {
            $photos[$i]['id'] = $row['id'];
            $photos[$i]['about'] = $row['about'];
            $photos[$i]['date'] = $row['date'];
            if (!empty($row['trainer'])) {
                $trainer_data = Trainer::getShortInfoById($row['trainer']);
                $photos[$i]['trainer'] = $row['trainer'];
                $photos[$i]['name'] = $trainer_data['name'];
                $photos[$i]['surname'] = $trainer_data['surname'];
            }
            $i++;
        }
        
        if ($i) return $photos;
        return false;
    }

    public static function getPhoto($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $photo = $result->fetch();
        if (!$photo) return 0;
        return $photo;
    }

    public static function getTrainerPrevId($id, $trainer)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE trainer = :trainer AND category = 0 ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->execute();

        $prev = 0;
        $exit = 0;
        while ($row = $result->fetch()) {
            if (!$exit) {
                if ($row['id'] == $id) {
                    $exit = 1;
                } else {
                    $prev = $row['id'];
                }
            }
        }

        return $prev;
    }

    public static function getTrainerNextId($id, $trainer)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE trainer = :trainer AND category = 0 ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->execute();

        $next = 0;
        $exit = 0;
        while ($row = $result->fetch()) {
            if (!$exit) {
                if (intval($row['id']) < intval($id)) {
                    $next = $row['id'];
                    $exit = 1;
                }
            }
        }
        return $next;
    }

    public static function getStudentPrevId($id, $student, $category)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE student = :student AND category = :category ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->execute();

        $prev = 0;
        $exit = 0;
        while ($row = $result->fetch()) {
            if (!$exit) {
                if ($row['id'] == $id) {
                    $exit = 1;
                } else {
                    $prev = $row['id'];
                }
            }
        }

        return $prev;
    }

    public static function getStudentNextId($id, $student, $category)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE student = :student AND category = :category ORDER BY id DESC';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->execute();

        $next = 0;
        $exit = 0;
        while ($row = $result->fetch()) {
            if (!$exit) {
                if (intval($row['id']) < intval($id)) {
                    $next = $row['id'];
                    $exit = 1;
                }
            }
        }
        return $next;
    }

    public static function addPhoto($student, $category, $about, $trainer)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO photos (student, trainer, about, date, category) VALUES (:student, :trainer, :about, '.time().', :category)';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->bindParam(':about', $about, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        if ($result->execute()) {
            $last_id = $db->lastInsertId();
            return $last_id;
        }
        return false;
    }

    public static function delPhoto($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM photos WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getTrainerPhotos($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM photos WHERE trainer = :id AND category = 0 ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $photos = array();
        while ($row = $result->fetch()) {
            $trainer_data = Trainer::getShortInfoById($row['trainer']);
            $photos[$i]['id'] = $row['id'];
            $photos[$i]['about'] = $row['about'];
            $photos[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $photos;
        return false;
    }

}
