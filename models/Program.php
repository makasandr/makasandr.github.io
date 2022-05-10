<?php

class Program
{

    public static function getProgram($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM programs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function getProgramPreview($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, about, cost, level FROM programs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $data = $result->fetch();
        return $data;
    }

    public static function getProgramStatus($id, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE student = :id AND program = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $status = $result->fetch();
        $status = json_decode($status['status'], true);
        return $status;
    }

    public static function checkProgramLevel($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT level FROM programs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $program = $result->fetch();
        return $program['level'];
    }

    public static function newProgram($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO programs (name, about, trainer, promo, cost, level, date, lessons) VALUES (:name, :about, :trainer, :promo, :cost, :level, '.time().', "[]")';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':trainer', $data['trainer'], PDO::PARAM_INT);
        $result->bindParam(':promo', $data['promo'], PDO::PARAM_STR);
        $result->bindParam(':cost', $data['cost'], PDO::PARAM_STR);
        $result->bindParam(':level', $data['level'], PDO::PARAM_INT);
        if ($result->execute()) {
            return $db->lastInsertId();
        }
        return false;
    }

    public static function editProgram($id, $data)
    {
        $db = Db::getConnection();
        $sql = "UPDATE programs SET name = :name, about = :about, promo = :promo, cost = :cost, level = :level WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':promo', $data['promo'], PDO::PARAM_STR);
        $result->bindParam(':cost', $data['cost'], PDO::PARAM_STR);
        $result->bindParam(':level', $data['level'], PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function delProgram($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM programs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function addCommon($student, $program, $status)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO common (student, program, status) VALUES (:student, :program, :status)';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function delCommon($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM common WHERE program = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function isStudentHave($id, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM common WHERE student = :id AND program = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();
        
        if ($result->fetch()) return true;
        return false;
    }

    public static function getStudentPrograms($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT program, status FROM common WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $programs = array();
        while ($row = $result->fetch()) {
            $program_data = self::getProgramPreview($row['program']);
            $status = json_decode($row['status'], true);
            $total = count($status);
            $done = 0;
            foreach ($status as $value) {
                if ($value) $done++;
            }
            $program_avatar_path = '/upload/images/programs/avatar/';
            if (file_exists(ROOT.$program_avatar_path.$row['program'].'.jpg')) $avatar = $program_avatar_path.$row['program'].'.jpg';
            else $avatar = $program_avatar_path.'0.jpg';
            if (strlen($program_data['about']) > 50) $short_about = substr($program_data['about'], 0, 50).'...';
            else $short_about = $program_data['about'];

            $programs[$i]['id'] = $row['program'];
            $programs[$i]['avatar'] = $avatar;
            $programs[$i]['name'] = $program_data['name'];
            $programs[$i]['about'] = $program_data['about'];
            $programs[$i]['short_about'] = $short_about;
            $programs[$i]['done'] = $done;
            $programs[$i]['total'] = $total;
            $i++;
        }
        
        if ($i) return $programs;
        return false;
    }

    public static function getTrainerPrograms($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, about FROM programs WHERE trainer = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $programs = array();
        while ($row = $result->fetch()) {
            $programs[$i]['id'] = $row['id'];
            $programs[$i]['name'] = $row['name'];
            $programs[$i]['about'] = $row['about'];
            $program_avatar_path = '/upload/images/programs/avatar/';
            if (file_exists(ROOT.$program_avatar_path.$row['id'].'.jpg')) $avatar = $program_avatar_path.$row['id'].'.jpg';
            else $avatar = $program_avatar_path.'0.jpg';
            if (strlen($row['about']) > 50) $short_about = substr($row['about'], 0, 50).'...';
            else $short_about = $row['about'];
            $programs[$i]['avatar'] = $avatar;
            $programs[$i]['short_about'] = $short_about;
            $i++;
        }
        
        if ($i) return $programs;
        return false;
    }

    public static function getExplorePrograms($level, $trainer)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, about, level FROM programs';
        if ($level || $trainer) $sql .= ' WHERE';
        if ($level) $sql .= ' level = :level';
        if ($level && $trainer) $sql .= ' AND';
        if ($trainer) $sql .= ' trainer = :trainer';
        $sql .= ' ORDER BY id DESC';


        $result = $db->prepare($sql);
        if ($level) $result->bindParam(':level', $level, PDO::PARAM_INT);
        if ($trainer) $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $programs = array();
        while ($row = $result->fetch()) {
            $programs[$i]['id'] = $row['id'];
            $programs[$i]['name'] = $row['name'];
            $programs[$i]['about'] = $row['about'];
            $program_avatar_path = '/upload/images/programs/avatar/';
            if (file_exists(ROOT.$program_avatar_path.$row['id'].'.jpg')) $avatar = $program_avatar_path.$row['id'].'.jpg';
            else $avatar = $program_avatar_path.'0.jpg';
            if (strlen($row['about']) > 50) $short_about = substr($row['about'], 0, 50).'...';
            else $short_about = $row['about'];
            $programs[$i]['avatar'] = $avatar;
            $programs[$i]['level'] = $row['level'];
            $programs[$i]['short_about'] = $short_about;
            $i++;
        }
        
        if ($i) return $programs;
        return false;
    }








    public static function getCommonProgress($id, $level)
    {
        $db = Db::getConnection();
        $sql = 'SELECT program, status FROM common WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $count = 0;
        while ($row = $result->fetch()) {
            $lavel_check = self::checkProgramLevel($row['program']);
            if ($lavel_check == $level) {
                $status_data = json_decode($row['status'], true);
                foreach ($status_data as $status) {
                    if ($status) $count++;
                }
            }
        }
        return $count;
    }

    public static function getPersonalProgress($id, $level)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons, status FROM personal WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $count = 0;
        $row = $result->fetch();
        $lessons = json_decode($row['lessons'], true);
        $status = json_decode($row['status'], true);
        if ($lessons) {
            foreach ($lessons as $key => $lesson) {
                $lavel_check = self::checkLessonLevel($lesson);
                if ($lavel_check == $level) {
                    if ($status[$key]) $count++;
                }
            }
        }

        return $count;
    }

    public static function getPersonalProgressData($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM personal WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $done = 0;
        $row = $result->fetch();
        $status = json_decode($row['status'], true);
        $total = 0;
        if ($status) {
            foreach ($status as $value) {
                if ($value) $done++;
                $total++;
            }
        } else $done = 0;

        $res['done'] = $done;
        $res['total'] = $total;
        return $res;
    }

    public static function getTopProgress($level)
    {
        if ($level == 1) return 15;
        if ($level == 2) return 45;
        if ($level == 3) return 60;
        if ($level == 4) return 100;
        return false;
    }

    public static function getLevelName($level)
    {
        if ($level == 1) return "First step";
        if ($level == 2) return "Bronze";
        if ($level == 3) return "Silver";
        if ($level == 4) return "Gold";
        return "Super star";
    }






    public static function addRecommendation($student, $trainer, $program)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO recomendations (student, trainer, program) VALUES (:student, :trainer, :program)';

        $result = $db->prepare($sql);
        $result->bindParam(':student', $student, PDO::PARAM_INT);
        $result->bindParam(':trainer', $trainer, PDO::PARAM_INT);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function getRecomendatins($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM recomendations WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $i = 0;
        $recomendationss = array();
        while ($row = $result->fetch()) {
            $recomendationss[$i]['id'] = $row['id'];
            $recomendationss[$i]['trainer'] = $row['trainer'];
            $recomendationss[$i]['program'] = $row['program'];
            $i++;
        }
        
        if ($i) return $recomendationss;
        return false;
    }

    public static function getRecomendatinsCount($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT COUNT(id) FROM recomendations WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $count = $result->fetch();
        return $count[0];
    }

    public static function isHaveRecommendation($id, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM recomendations WHERE student = :id AND program = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();
        
        if ($result->fetch()) return true;
        return false;
    }






    public static function getLessons($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons FROM programs WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $lessons = $result->fetch();
        $lessons = json_decode($lessons['lessons'], true);
        return $lessons;
    }

    public static function getPrivateLessons($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons, status FROM personal WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $lessons = $result->fetch();
        $res['lessons'] = json_decode($lessons['lessons'], true);
        $res['status'] = json_decode($lessons['status'], true);
        return $res;
    }

    public static function getLessonPreview($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id, name, about, trainer, promo, date FROM lessons WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function getLesson($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT * FROM lessons WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        return $result->fetch();
    }

    public static function checkLessonLevel($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT level FROM lessons WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $lesson = $result->fetch();
        return $lesson['level'];
    }

    public static function getProgramByLessonId($id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM programs WHERE lessons LIKE :id_middle
                OR lessons LIKE :id_first
                OR lessons LIKE :id_last
                OR lessons = :id_one';
        $id_middle = '%,"'.$id.'",%';
        $id_first = '["'.$id.'",%';
        $id_last = '%,"'.$id.'"]';
        $id_one = '["'.$id.'"]';

        $result = $db->prepare($sql);
        $result->bindParam(':id_middle', $id_middle, PDO::PARAM_STR);
        $result->bindParam(':id_first', $id_first, PDO::PARAM_STR);
        $result->bindParam(':id_last', $id_last, PDO::PARAM_STR);
        $result->bindParam(':id_one', $id_one, PDO::PARAM_STR);
        $result->execute();

        if ($row = $result->fetch()) return $row['id'];
        return false;
    }

    public static function isStudentHavePersonal($id, $lesson)
    {
        $db = Db::getConnection();
        $sql = 'SELECT id FROM personal WHERE (lessons LIKE :id_middle
                OR lessons LIKE :id_first
                OR lessons LIKE :id_last
                OR lessons = :id_one)
                AND student = :id';
        $id_middle = '%,"'.$lesson.'",%';
        $id_first = '["'.$lesson.'",%';
        $id_last = '%,"'.$lesson.'"]';
        $id_one = '["'.$lesson.'"]';

        $result = $db->prepare($sql);
        $result->bindParam(':id_middle', $id_middle, PDO::PARAM_STR);
        $result->bindParam(':id_first', $id_first, PDO::PARAM_STR);
        $result->bindParam(':id_last', $id_last, PDO::PARAM_STR);
        $result->bindParam(':id_one', $id_one, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        if ($row = $result->fetch()) return true;
        return false;
    }

    public static function getLessonStatus($id, $lesson, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE program = :program AND student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $status = json_decode($row['status'], true);

        $sql = 'SELECT lessons FROM programs WHERE id = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $lessons = json_decode($row['lessons'], true);

        $locked = 0;
        foreach ($status as $key => $value) {
            if (!$locked && $lessons[$key] == $lesson) {
                return true;
            }
            if ($value && (intval($value)+86400) < time()) {
                $locked = 0;
            } else {
                $locked = 1;
            }
        }

        return false;
    }

    public static function isLessonDone($id, $lesson, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE program = :program AND student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $status = json_decode($row['status'], true);

        $sql = 'SELECT lessons FROM programs WHERE id = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $lessons = json_decode($row['lessons'], true);

        foreach ($status as $key => $value) {
            if ($lessons[$key] == $lesson) {
                if ($value) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function isPersonalDone($id, $lesson)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons, status FROM personal WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();

        $status = json_decode($row['status'], true);
        $lessons = json_decode($row['lessons'], true);

        foreach ($status as $key => $value) {
            if ($lessons[$key] == $lesson) {
                if ($value) {
                    return true;
                }
            }
        }
        return false;
    }

    public static function setLessonDone($id, $lesson, $program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE program = :program AND student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $status = json_decode($row['status'], true);

        $sql = 'SELECT lessons FROM programs WHERE id = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $lessons = json_decode($row['lessons'], true);

        foreach ($status as $key => $value) {
            if ($lessons[$key] == $lesson) {
                $status[$key] = time();
            }
        }

        $status = json_encode($status);

        $sql = "UPDATE common SET status = :status WHERE program = :program AND student = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function setPrivateLessonDone($id, $lesson)
    {
        $db = Db::getConnection();
        $sql = 'SELECT lessons, status FROM personal WHERE student = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->execute();
        $row = $result->fetch();

        $status = json_decode($row['status'], true);
        $lessons = json_decode($row['lessons'], true);

        foreach ($status as $key => $value) {
            if ($lessons[$key] == $lesson) {
                $status[$key] = time();
            }
        }

        $status = json_encode($status);

        $sql = "UPDATE personal SET status = :status WHERE student = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function newPrivateLesson($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO lessons (name, about, trainer, tasks, physical, muscle, skills, date) VALUES (:name, :about, :trainer, :tasks, :physical, :muscle, :skills, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':trainer', $data['trainer'], PDO::PARAM_INT);
        $result->bindParam(':tasks', $data['tasks'], PDO::PARAM_STR);
        $result->bindParam(':physical', $data['physical'], PDO::PARAM_STR);
        $result->bindParam(':muscle', $data['muscle'], PDO::PARAM_STR);
        $result->bindParam(':skills', $data['skills'], PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        } else return false;
    }

    public static function newLesson($data)
    {
        $db = Db::getConnection();
        $sql = 'INSERT INTO lessons (name, about, promo, tasks, physical, muscle, skills, date) VALUES (:name, :about, :promo, :tasks, :physical, :muscle, :skills, '.time().')';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':promo', $data['promo'], PDO::PARAM_STR);
        $result->bindParam(':tasks', $data['tasks'], PDO::PARAM_STR);
        $result->bindParam(':physical', $data['physical'], PDO::PARAM_STR);
        $result->bindParam(':muscle', $data['muscle'], PDO::PARAM_STR);
        $result->bindParam(':skills', $data['skills'], PDO::PARAM_STR);
        if ($result->execute()) {
            return $db->lastInsertId();
        } else return false;
    }

    public static function editPrivateLesson($id, $data)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE lessons SET name = :name, about = :about, tasks = :tasks, physical = :physical, muscle = :muscle, skills = :skills WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':tasks', $data['tasks'], PDO::PARAM_STR);
        $result->bindParam(':physical', $data['physical'], PDO::PARAM_STR);
        $result->bindParam(':muscle', $data['muscle'], PDO::PARAM_STR);
        $result->bindParam(':skills', $data['skills'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);        
        return $result->execute();
    }

    public static function editLesson($id, $data)
    {
        $db = Db::getConnection();
        $sql = 'UPDATE lessons SET name = :name, about = :about, promo = :promo, tasks = :tasks, physical = :physical, muscle = :muscle, skills = :skills WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':name', $data['name'], PDO::PARAM_STR);
        $result->bindParam(':about', $data['about'], PDO::PARAM_STR);
        $result->bindParam(':promo', $data['promo'], PDO::PARAM_STR);
        $result->bindParam(':tasks', $data['tasks'], PDO::PARAM_STR);
        $result->bindParam(':physical', $data['physical'], PDO::PARAM_STR);
        $result->bindParam(':muscle', $data['muscle'], PDO::PARAM_STR);
        $result->bindParam(':skills', $data['skills'], PDO::PARAM_STR);
        $result->bindParam(':id', $id, PDO::PARAM_INT);        
        return $result->execute();
    }

    public static function delPrivateLesson($id)
    {
        $db = Db::getConnection();
        $sql = 'DELETE FROM lessons WHERE id = :id';

        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }

    public static function addPrivateLesson($student, $data)
    {
        $db = Db::getConnection();
        $sql = "UPDATE personal SET lessons = :lessons, status = :status WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $student, PDO::PARAM_INT);
        $result->bindParam(':lessons', $data['lessons'], PDO::PARAM_STR);
        $result->bindParam(':status', $data['status'], PDO::PARAM_STR);
        return $result->execute();
    }

    public static function addLesson($program, $lessons)
    {
        $db = Db::getConnection();
        $sql = "UPDATE programs SET lessons = :lessons WHERE id = :id";

        $result = $db->prepare($sql);
        $result->bindParam(':id', $program, PDO::PARAM_INT);
        $result->bindParam(':lessons', $lessons, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function addCommonLesson($program)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE program = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $status = json_decode($row['status'], true);
        $status[] = 0;
        $status = json_encode($status);

        $sql = "UPDATE common SET status = :status WHERE program = :program";

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        return $result->execute();
    }

    public static function delCommonLesson($program, $status_id)
    {
        $db = Db::getConnection();
        $sql = 'SELECT status FROM common WHERE program = :program';

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->execute();

        $row = $result->fetch();
        $status = json_decode($row['status'], true);
        unset($status[$status_id]);
        $status = json_encode($status);

        $sql = "UPDATE common SET status = :status WHERE program = :program";

        $result = $db->prepare($sql);
        $result->bindParam(':program', $program, PDO::PARAM_INT);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        return $result->execute();
    }

}
