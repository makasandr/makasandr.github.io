<?php

class User
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

}
