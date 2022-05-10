<?php

class LessonController
{

    //lesson page
    public function actionPage($lesson)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $program = Program::getProgramByLessonId($lesson);
        $lesson_data = Program::getLesson($lesson);
        $ldone = true;
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                $ldone = Program::isLessonDone($id, $lesson, $program);
                if (!Program::isStudentHave($id, $program)) header('Location: /login');
                if (!Program::getLessonStatus($id, $lesson, $program)) header('Location: /login');
            } else {
                $ldone = Program::isPersonalDone($id, $lesson);
                if (!Program::isStudentHavePersonal($id, $lesson)) header('Location: /login');
            }
        } else {
            $id = Trainer::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                if ($program_data['trainer'] != $id) header('Location: /login');
            } elseif ($lesson_data['trainer'] != $id) header('Location: /login');
        }

        //page title
        $title = $lesson_data['name'];

        //data prepearing
            //video
        $lesson_path = ROOT.'/upload/videos/';
        if (file_exists($lesson_path.$lesson_data['id'].'.mp4')) $video = '/upload/videos/'.$lesson_data['id'].'.mp4';
        else $video = false;

            //author
        if ($program) {
            $author = Trainer::getShortInfoById($program_data['trainer']);
        } else {
            $author = Trainer::getShortInfoById($lesson_data['trainer']);
        }

            //levels
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }
            //tasks
        $tasks_data = json_decode($lesson_data['tasks'], true);
        if (empty($tasks_data[0])) {
            $tasks_data = false;
        }
        if ($tasks_data) {
            $i = 0;
            foreach ($tasks_data as $key => $value) {
                $secondary = 0;
                if ($value[0] == "!") {
                    $secondary = 1;
                    $value = substr($value, 1);
                }

                $tasks[$key]['target'] = $value;
                $tasks[$key]['secondary'] = $secondary;
                $i++;
            }
        }
            //tags
        $physical = json_decode($lesson_data['physical'], true);
        $muscle = json_decode($lesson_data['muscle'], true);
        $skills = json_decode($lesson_data['skills'], true);
        if (empty($physical[0])) {
            $physical = false;
        }
        if (empty($muscle[0])) {
            $muscle = false;
        }
        if (empty($skills[0])) {
            $skills = false;
        }

            //comments
        if ($user === 1) {
            $comments = Comments::getSome($id, $lesson, 0, 100);
        } else {
            $main_students = Trainer::getMainStudents($id);
            $secondary_students = Trainer::getSecondaryStudents($id);
            $students_info = array_merge($main_students, $secondary_students);
        }

        //view connection
        require_once(ROOT . '/views/lesson/index.php');
        return true;
    }

    //add comment to lesson
    public function actionAdd_comment($lesson)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $program = Program::getProgramByLessonId($lesson);
        $lesson_data = Program::getLesson($lesson);
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                if (!Program::isStudentHave($id, $program)) header('Location: /login');
                if (!Program::getLessonStatus($id, $lesson, $program)) header('Location: /login');
            } else {
                if (!Program::isStudentHavePersonal($id, $lesson)) header('Location: /login');
            }
        } else {
            $id = Trainer::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                if ($program_data['trainer'] != $id) header('Location: /login');
            } elseif ($lesson_data['trainer'] != $id) header('Location: /login');
        }

        //data proccesing
        $data['lesson'] = $lesson;
        $data['message'] = htmlspecialchars($_POST['message']);
        if ($user === 1) {
            $data['student'] = $id;
            $data['type'] = 0;
        } else {
            $data['student'] = htmlspecialchars($_POST['student']);
            $data['type'] = 1;
        }
        //adding comment
        Comments::addSome($data);

        //redirect
        header('Location: /lesson/'.$lesson);
        return true;
    }

    //delete comment
    public function actionDel_comment($comment)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $comment_data = Comments::getOne($comment);
        $program = Program::getProgramByLessonId($comment_data['lesson']);
        $lesson_data = Program::getLesson($comment_data['lesson']);
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if ($comment_data['student'] != $id) header('Location: /login');
        } else {
            if ($program) {
                $program_data = Program::getProgram($program);
                if ($program_data['trainer'] != $id) header('Location: /login');
            } elseif ($lesson_data['trainer'] != $id) header('Location: /login');
            if ($comment_data == "0") header('Location: /login');
        }

        //deleting comment
        Comments::delSome($comment);

        //redirect
        header('Location: /lesson/'.$comment_data['lesson']);
        return true;
    }

    //coments list (ajax)
    public function actionComments($lesson, $student)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $program = Program::getProgramByLessonId($lesson);
        $lesson_data = Program::getLesson($lesson);
        if ($user === 1) {
            die('Access deny.');
        } else {
            $id = Trainer::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                if ($program_data['trainer'] != $id) header('Location: /login');
            } elseif ($lesson_data['trainer'] != $id) header('Location: /login');
        }

        //data prepearing
        $comments = Comments::getSome($student, $lesson, 0, 100);

        //view connection
        require_once(ROOT . '/views/lesson/comments.php');
        return true;
    }

    //set lesson done
    public function actionDone($lesson)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $is_done = 0;
        if ($user === 2) die('Access deny.');
        else {
            $id = Student::getIdByUin($uin);
            $program = Program::getProgramByLessonId($lesson);
            if ($program) {
                if (!Program::isStudentHave($id, $program)) die('Access deny.');
                if (!Program::getLessonStatus($id, $lesson, $program)) die('Access deny.');
                if (Program::isLessonDone($id, $lesson, $program)) {
                    $is_done = 1;
                }
            } else {
                if (!Program::isStudentHavePersonal($id, $lesson)) die('Access deny.');
                if (Program::isPersonalDone($id, $lesson)) {
                    $is_done = 1;
                }
            }
        }

        //data proccesing
        if (!$is_done) {
            //is not private
            if ($program) {
                Program::setLessonDone($id, $lesson, $program);
            } else {
                Program::setPrivateLessonDone($id, $lesson);
            }
        }

        return true;
    }

    //new private lesson
    public function actionNew($task, $target_student)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $title = "New private lesson";
        if ($user === 1) {
            header('Location: /login');
        } else {
            if ($task) {
                $task_data = Task::getTask($task);
            }
            $id = Trainer::getIdByUin($uin);
            $user_data = Trainer::getDataById($id);
            if ($task) {
                if ($id != $task_data['trainer']) {
                    header('Location: /login');
                }
            }
        }

        //data prepearing
            //students
        $main_students = Trainer::getMainStudents($id);
        $secondary_students = Trainer::getSecondaryStudents($id);
        $students_info = array_merge($main_students, $secondary_students);
        if ($task) {
            $selected = json_decode($task_data['students'], true);
        } else {
            $selected[] = $target_student;
        }
        foreach ($students_info as $key => $value) {
            $students_info[$key]['selected'] = 0;
            foreach ($selected as $selected_id) {
                if ($value['id'] == $selected_id) {
                    $students_info[$key]['selected'] = 1;
                }
            }
        }

        //data processing
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);
            $data['trainer'] = $id;

            foreach ($_POST['tasks'] as $key => $value) {
                if (isset($_POST['secondary_'.$key])) {
                    $value = "!".$value;
                }
                $tasks[] = htmlspecialchars($value);
            }
            $data['tasks'] = json_encode($tasks);

            $physical = explode(",", htmlspecialchars($_POST['physical']));
            foreach ($physical as $key => $value) {
                $physical[$key] = trim($value);
            }
            $muscle = explode(",", htmlspecialchars($_POST['muscle']));
            foreach ($muscle as $key => $value) {
                $muscle[$key] = trim($value);
            }
            $skills = explode(",", htmlspecialchars($_POST['skills']));
            foreach ($skills as $key => $value) {
                $skills[$key] = trim($value);
            }

            $data['physical'] = json_encode($physical);
            $data['muscle'] = json_encode($muscle);
            $data['skills'] = json_encode($skills);

            //uploading files
            if ($result = Program::newPrivateLesson($data)) {
                if ($_FILES['cover']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['cover']["tmp_name"])) {
                        move_uploaded_file($_FILES['cover']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/lessons/preview/".$result.".jpg");
                    } else $errors['upload'] = true;
                } else $errors['upload'] = true;

                if ($_FILES['video']['type'] == "video/mp4") {
                    if (is_uploaded_file($_FILES['video']["tmp_name"])) {
                        move_uploaded_file($_FILES['video']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/videos/".$result.".mp4");
                    } else $errors['upload'] = true;
                } else $errors['upload'] = true;

                if (isset($errors['upload'])) {
                    Program::delPrivateLesson($result);
                    if (file_exists(ROOT . "/upload/videos/".$result.".mp4")) unlink(ROOT . "/upload/videos/".$result.".mp4");
                    if (file_exists(ROOT . "/upload/images/lessons/preview/".$result.".jpg")) unlink(ROOT . "/upload/images/lessons/preview/".$result.".jpg");
                } else {
                    if (!isset($_POST['students'])) {
                        $_POST['students'] = array();
                    }
                    //creating private lesson
                    foreach ($_POST['students'] as $value) {
                        $student_lessons = Program::getPrivateLessons($value);
                        $student_lessons['lessons'][] = $result;
                        $student_lessons['status'][] = 0;
                        $lessons_data['lessons'] = json_encode($student_lessons['lessons']);
                        $lessons_data['status'] = json_encode($student_lessons['status']);
                        Program::addPrivateLesson($value, $lessons_data);
                        if ($task) {
                            Task::setDone($task);
                        }
                        header('Location: /trainer');
                    }
                }
            }
            else {
                $errors['submit'] = true;
            }
        }

        //view connection
        require_once(ROOT . '/views/lesson/new.php');
        return true;
    }

    //new lesson in program
    public function actionNew_p($program)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $title = "New lesson";
        if ($user === 1) {
            header('Location: /login');
        } else {
            $program_data = Program::getProgram($program);
            $id = Trainer::getIdByUin($uin);
            $user_data = Trainer::getDataById($id);
            if ($id != $program_data['trainer']) {
                header('Location: /login');
            }
        }

        //data processing
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);
            $data['promo'] = htmlspecialchars($_POST['promo']);
            $data['trainer'] = $id;

            foreach ($_POST['tasks'] as $key => $value) {
                if (isset($_POST['secondary_'.$key])) {
                    $value = "!".$value;
                }
                $tasks[] = htmlspecialchars($value);
            }
            $data['tasks'] = json_encode($tasks);

            $physical = explode(",", htmlspecialchars($_POST['physical']));
            foreach ($physical as $key => $value) {
                $physical[$key] = trim($value);
            }
            $muscle = explode(",", htmlspecialchars($_POST['muscle']));
            foreach ($muscle as $key => $value) {
                $muscle[$key] = trim($value);
            }
            $skills = explode(",", htmlspecialchars($_POST['skills']));
            foreach ($skills as $key => $value) {
                $skills[$key] = trim($value);
            }

            $data['physical'] = json_encode($physical);
            $data['muscle'] = json_encode($muscle);
            $data['skills'] = json_encode($skills);

            //files upload
            if ($result = Program::newLesson($data)) {
                if ($_FILES['cover']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['cover']["tmp_name"])) {
                        move_uploaded_file($_FILES['cover']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/lessons/preview/".$result.".jpg");
                    } else $errors['upload'] = true;
                } else $errors['upload'] = true;

                if ($_FILES['video']['type'] == "video/mp4") {
                    if (is_uploaded_file($_FILES['video']["tmp_name"])) {
                        move_uploaded_file($_FILES['video']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/videos/".$result.".mp4");
                    } else $errors['upload'] = true;
                } else $errors['upload'] = true;

                if (isset($errors['upload'])) {
                    Program::delPrivateLesson($result);
                    if (file_exists(ROOT . "/upload/videos/".$result.".mp4")) unlink(ROOT . "/upload/videos/".$result.".mp4");
                    if (file_exists(ROOT . "/upload/images/lessons/preview/".$result.".jpg")) unlink(ROOT . "/upload/images/lessons/preview/".$result.".jpg");
                } else {
                    //creating lesson
                    $lessons = json_decode($program_data['lessons']);
                    $lessons[] = $result;
                    $lessons = json_encode($lessons);
                    Program::addLesson($program, $lessons);
                    Program::addCommonLesson($program);
                    header('Location: /explore/program/'.$program);
                }
            }
            else {
                $errors['submit'] = true;
            }
        }

        //view connection
        require_once(ROOT . '/views/lesson/new_p.php');
        return true;
    }

    //edit private lesson
    public function actionEdit($lesson_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $title = "Edit private lesson";
        if ($user === 1) {
            header('Location: /login');
        } else {
            $lesson_data = Program::getLesson($lesson_id);
            $id = Trainer::getIdByUin($uin);
            $user_data = Trainer::getDataById($id);
            if ($id != $lesson_data['trainer']) {
                header('Location: /login');
            }
        }

        //data prepearing
            //students
        $main_students = Trainer::getMainStudents($id);
        $secondary_students = Trainer::getSecondaryStudents($id);
        $students_info = array_merge($main_students, $secondary_students);
        $selected = array();
        foreach ($students_info as $value) {
            if (Program::isStudentHavePersonal($value['id'], $lesson_id)) {
                $selected[] = $value['id'];
            }
        }
        foreach ($students_info as $key => $value) {
            $students_info[$key]['selected'] = 0;
            foreach ($selected as $selected_id) {
                if ($value['id'] == $selected_id) {
                    $students_info[$key]['selected'] = 1;
                }
            }
        }

        $tasks_view = array();
        if (empty($pre_tasks[0])) {
            $pre_tasks = false;
        }
        $pre_tasks = json_decode($lesson_data['tasks'], true);
        if ($pre_tasks) {
            foreach ($pre_tasks as $key => $value) {
                if ($value[0] == "!") {
                    $tasks_view[$key]['task'] = substr($value, 1);
                    $tasks_view[$key]['primary'] = false;
                } else {
                    $tasks_view[$key]['task'] = $value;
                    $tasks_view[$key]['primary'] = true;
                }
            }
        }

        $physical_view = implode(", ", json_decode($lesson_data['physical'], true));
        $muscle_view = implode(", ", json_decode($lesson_data['muscle'], true));
        $skills_view = implode(", ", json_decode($lesson_data['skills'], true));

        //data processing
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);

            foreach ($_POST['tasks'] as $key => $value) {
                if (isset($_POST['secondary_'.$key])) {
                    $value = "!".$value;
                }
                $tasks[] = htmlspecialchars($value);
            }
            $data['tasks'] = json_encode($tasks);

            $physical = explode(",", htmlspecialchars($_POST['physical']));
            foreach ($physical as $key => $value) {
                $physical[$key] = trim($value);
            }
            $muscle = explode(",", htmlspecialchars($_POST['muscle']));
            foreach ($muscle as $key => $value) {
                $muscle[$key] = trim($value);
            }
            $skills = explode(",", htmlspecialchars($_POST['skills']));
            foreach ($skills as $key => $value) {
                $skills[$key] = trim($value);
            }

            $data['physical'] = json_encode($physical);
            $data['muscle'] = json_encode($muscle);
            $data['skills'] = json_encode($skills);

            //uploading files
            if (Program::editPrivateLesson($lesson_id, $data)) {
                if ($_FILES['cover']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['cover']["tmp_name"])) {
                        move_uploaded_file($_FILES['cover']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/lessons/preview/".$lesson_id.".jpg");
                    } else $errors['upload'] = true;
                }

                if ($_FILES['video']['type'] == "video/mp4") {
                    if (is_uploaded_file($_FILES['video']["tmp_name"])) {
                        move_uploaded_file($_FILES['video']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/videos/".$lesson_id.".mp4");
                    } else $errors['upload'] = true;
                }

                if (!isset($errors['upload'])) {
                    foreach ($students_info as $student) {
                        if (!isset($_POST['students'])) {
                            $_POST['students'] = array();
                        }
                        $student_lessons = Program::getPrivateLessons($student['id']);
                        if (array_search($student['id'], $_POST['students']) !== false) {
                            foreach ($student_lessons['lessons'] as $key => $user_lesson) {
                                $need_add = true;
                                if ($user_lesson == $lesson_id) {
                                    $need_add = false;
                                }
                                if ($need_add) {
                                    $student_lessons['lessons'][] = $lesson_id;
                                    $student_lessons['status'][] = 0;
                                    $lessons_data['lessons'] = json_encode($student_lessons['lessons']);
                                    $lessons_data['status'] = json_encode($student_lessons['status']);
                                }
                            }
                        } else {
                            foreach ($student_lessons['lessons'] as $key => $user_lesson) {
                                if ($user_lesson == $lesson_id) {
                                    unset($student_lessons['lessons'][$key]);
                                    unset($student_lessons['status'][$key]);
                                }
                            }
                            $lessons_data['lessons'] = json_encode($student_lessons['lessons']);
                            $lessons_data['status'] = json_encode($student_lessons['status']);
                        }
                        Program::addPrivateLesson($student, $lessons_data);
                    }
                    header('Location: /trainer');
                }
            } else {
                $errors['submit'] = true;
            }
        }

        //view connection
        require_once(ROOT . '/views/lesson/edit.php');
        return true;
    }

    //edit lesson in program
    public function actionEdit_p($lesson_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $title = "New lesson";
        if ($user === 1) {
            header('Location: /login');
        } else {
            $program = Program::getProgramByLessonId($lesson_id);
            $program_data = Program::getProgram($program);
            $lesson_data = Program::getLesson($lesson_id);
            $id = Trainer::getIdByUin($uin);
            $user_data = Trainer::getDataById($id);
            if ($id != $program_data['trainer']) {
                header('Location: /login');
            }
        }

        //data prepearing
        $tasks_view = array();
        $pre_tasks = json_decode($lesson_data['tasks'], true);
        if (empty($pre_tasks[0])) {
            $pre_tasks = false;
        }
        if ($pre_tasks) {
            foreach ($pre_tasks as $key => $value) {
                if ($value[0] == "!") {
                    $tasks_view[$key]['task'] = substr($value, 1);
                    $tasks_view[$key]['primary'] = false;
                } else {
                    $tasks_view[$key]['task'] = $value;
                    $tasks_view[$key]['primary'] = true;
                }
            }
        }

        $physical_view = implode(", ", json_decode($lesson_data['physical'], true));
        $muscle_view = implode(", ", json_decode($lesson_data['muscle'], true));
        $skills_view = implode(", ", json_decode($lesson_data['skills'], true));

        //data processing
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);
            $data['promo'] = htmlspecialchars($_POST['promo']);

            foreach ($_POST['tasks'] as $key => $value) {
                if (isset($_POST['secondary_'.$key])) {
                    $value = "!".$value;
                }
                $tasks[] = htmlspecialchars($value);
            }
            $data['tasks'] = json_encode($tasks);

            $physical = explode(",", htmlspecialchars($_POST['physical']));
            foreach ($physical as $key => $value) {
                $physical[$key] = trim($value);
            }
            $muscle = explode(",", htmlspecialchars($_POST['muscle']));
            foreach ($muscle as $key => $value) {
                $muscle[$key] = trim($value);
            }
            $skills = explode(",", htmlspecialchars($_POST['skills']));
            foreach ($skills as $key => $value) {
                $skills[$key] = trim($value);
            }

            $data['physical'] = json_encode($physical);
            $data['muscle'] = json_encode($muscle);
            $data['skills'] = json_encode($skills);

            //files upload
            if (Program::editLesson($lesson_id, $data)) {
                if ($_FILES['cover']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['cover']["tmp_name"])) {
                        move_uploaded_file($_FILES['cover']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/lessons/preview/".$lesson_id.".jpg");
                    } else $errors['upload'] = true;
                }

                if ($_FILES['video']['type'] == "video/mp4") {
                    if (is_uploaded_file($_FILES['video']["tmp_name"])) {
                        move_uploaded_file($_FILES['video']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/videos/".$lesson_id.".mp4");
                    } else $errors['upload'] = true;
                }

                if (!isset($errors['upload'])) {
                    header('Location: /explore/program/'.$program);
                }
            } else {
                $errors['submit'] = true;
            }
        }

        //view connection
        require_once(ROOT . '/views/lesson/edit_p.php');
        return true;
    }

    //delete lesson
    public function actionDel($lesson_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $title = "Delete private lesson";
        if ($user === 1) {
            header('Location: /login');
        } else {
            $lesson_data = Program::getLesson($lesson_id);
            $program = Program::getProgramByLessonId($lesson_id);
            $id = Trainer::getIdByUin($uin);
            if ($program) {
                $program_data = Program::getProgram($program);
                if ($program_data['trainer'] != $id) header('Location: /login');
            } elseif ($lesson_data['trainer'] != $id) header('Location: /login');
        }

        if (isset($_POST['submit'])) {
            Program::delPrivateLesson($lesson_id);
            if (file_exists(ROOT . "/upload/videos/".$lesson_id.".mp4")) unlink(ROOT . "/upload/videos/".$lesson_id.".mp4");
            if (file_exists(ROOT . "/upload/images/lessons/preview/".$lesson_id.".jpg")) unlink(ROOT . "/upload/images/lessons/preview/".$lesson_id.".jpg");
            if ($program) {
                $lessons_list = Program::getLessons($program);
                $i = 0;
                foreach ($lessons_list as $key => $value) {
                    if ($value == $lesson_id) {
                        unset($lessons_list[$key]);
                        $status_id = $i;
                    }
                    $i++;
                }
                $lessons_list = json_encode(array_values($lessons_list));
                Program::addLesson($program, $lessons_list);
                Program::delCommonLesson($program, $status_id);
                header('Location: /explore/program/'.$program);
            } else {
                $main_students = Trainer::getMainStudents($id);
                $secondary_students = Trainer::getSecondaryStudents($id);
                $students_info = array_merge($main_students, $secondary_students);
                foreach ($students_info as $student) {
                    $student_lessons = Program::getPrivateLessons($student['id']);
                    $to_unset = array_search($lesson_id, $student_lessons['lessons']);
                    if ($to_unset !== false) {
                        unset($student_lessons['lessons'][$to_unset]);
                        unset($student_lessons['status'][$to_unset]);
                        $student_data['lessons'] = json_encode($student_lessons['lessons']);
                        $student_data['status'] = json_encode($student_lessons['status']);
                        Program::addPrivateLesson($student['id'], $student_data);
                    }
                }
                header('Location: /trainer');
            }
        }

        if (isset($_POST['deny'])) {
            if ($program) {
               header('Location: /explore/program/'.$program);
            } else {
                header('Location: /trainer');
            }
        }

        //view connection
        require_once(ROOT . '/views/lesson/del.php');
        return true;
    }

}