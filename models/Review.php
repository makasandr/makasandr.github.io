<?php

class Review
{

    public static function getReviews($id, $offset, $limit)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM reviews WHERE trainer = :id ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$offset;

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $messages = array();
        while ($row = $result->fetch()) {
            $student_data = Student::getShortInfoById($row['student']);
            $messages[$i]['id'] = $row['id'];
            $messages[$i]['student'] = $student_data['id'];
            $messages[$i]['name'] = $student_data['name'];
            $messages[$i]['surname'] = $student_data['surname'];
            $student_avatar_path = '/upload/images/students/avatar/';
            if (file_exists(ROOT.$student_avatar_path.$student_data['id'].'.jpg')) $messages[$i]['avatar'] = $student_avatar_path.$student_data['id'].'.jpg';
            else $messages[$i]['avatar'] = $student_avatar_path.'0.jpg';
            $messages[$i]['review'] = $row['review'];
            $messages[$i]['rating'] = $row['rating'];
            $messages[$i]['date'] = $row['date'];
            $i++;
        }
        
        if ($i) return $messages;
        return false;
    }

    public static function getReview($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM reviews WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function checkReview($student)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM reviews WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->execute();

        if($user = $result->fetch()) return true;
        return false;
    }

    public static function getRating($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT AVG(rating) FROM reviews WHERE trainer = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $data = $result->fetch();
        
        if (!$data[0]) return 0;
        return round($data[0]);
    }

    public static function getCount($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM reviews WHERE trainer = :trainer';

        $result = $db->prepare($sql);
        $result->bindParam(':trainer', $id, PDO::PARAM_INT);
        $result->execute();

        $total = 0;
        $row = $result->fetch();
        
        return $row[0];
    }

    public static function addReview($date)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO reviews (student, trainer, rating, review, date) VALUES (:student, :trainer, :rating, :review, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $date['student'], PDO::PARAM_INT);
        $result->bindParam(':trainer', $date['trainer'], PDO::PARAM_INT);
        $result->bindParam(':rating', $date['rating'], PDO::PARAM_INT);
        $result->bindParam(':review', $date['review'], PDO::PARAM_STR);
        if ($result->execute()) return true;
        return false;
    }

    public static function delReview($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM reviews WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
