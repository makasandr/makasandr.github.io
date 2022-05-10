<?php

class Cart
{
    public static function getCart($student)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM cart WHERE student = :student';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function changeCart($programs, $student)
    {
        $db = Db::getConnection();
        $sql = "UPDATE cart SET programs = :programs WHERE student = :student";

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':programs', $programs, PDO::PARAM_STR);
        return $result->execute();
    }
}
