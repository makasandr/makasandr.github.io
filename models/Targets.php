<?php

class Targets
{

    public static function getStudentTargets($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM targets WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        $output['physical'] = json_decode($data['physical'], true);
        $output['personal'] = json_decode($data['personal'], true);
        $output['other'] = json_decode($data['other'], true);
        $physical = array();
        $personal = array();
        $other = array();

        $physical = false;
        if ($output['physical']) {
            $i = 0;
            foreach ($output['physical'] as $key => $value) {
                $done = 0;
                if ($value[0] == "!") {
                    $done = 1;
                    $value = substr($value, 1);
                }
                $value = explode("|", $value);
                $physical[$key]['target'] = $value[0];
                $physical[$key]['date'] = $value[1];
                $physical[$key]['done'] = $done;
                $i++;
            }
        }

        $personal = false;
        if ($output['personal']) {
            $i = 0;
            foreach ($output['personal'] as $key => $value) {
                $done = 0;
                if ($value[0] == "!") {
                    $done = 1;
                    $value = substr($value, 1);
                }
                $value = explode("|", $value);
                $personal[$key]['target'] = $value[0];
                $personal[$key]['date'] = $value[1];
                $personal[$key]['done'] = $done;
                $i++;
            }
        }

        $other = false;
        if ($output['other']) {
            $i = 0;
            foreach ($output['other'] as $key => $value) {
                $done = 0;
                if ($value[0] == "!") {
                    $done = 1;
                    $value = substr($value, 1);
                }
                $value = explode("|", $value);
                $other[$key]['target'] = $value[0];
                $other[$key]['date'] = $value[1];
                $other[$key]['done'] = $done;
                $i++;
            }
        }

        $output['physical'] = $physical;
        $output['personal'] = $personal;
        $output['other'] = $other;
        return $output;
    }

    public static function getTrainerTargets($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM targets WHERE trainer = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        $output = json_decode($data['other'], true);

        if ($output) {
            $i = 0;
            foreach ($output as $key => $value) {
                $done = 0;
                if ($value[0] == "!") {
                    $done = 1;
                    $value = substr($value, 1);
                }
                $value = explode("|", $value);
                $targets[$key]['target'] = $value[0];
                $targets[$key]['date'] = $value[1];
                $targets[$key]['done'] = $done;
                $i++;
            }
            return $targets;
        }
        return false;
    }

    public static function revriteStudent($id, $category, $new_list)
    {
        $db = Db::getConnection();
        if ($category == 1) {
            $sql = "UPDATE targets SET physical = :new_list WHERE student = :id";
        } elseif ($category == 2) {
            $sql = "UPDATE targets SET personal = :new_list WHERE student = :id";
        } else {
            $sql = "UPDATE targets SET other = :new_list WHERE student = :id";
        }

        $result = $db->prepare($sql);
        $result->bindParam(':new_list', $new_list, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function revriteTrainer($id, $new_list)
    {
        $db = Db::getConnection();
        $sql = "UPDATE targets SET other = :new_list WHERE trainer = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':new_list', $new_list, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

}
