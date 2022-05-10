<?php

class ExploreController
{

    //main page
    public function actionPage()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page title
        $title = "Explore";

        //page type, get user data
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            $recomendations = Program::getRecomendatins($id);
            $cart = Cart::getCart($id);
            $cart_programs = json_decode($cart['programs'], true);
        } else {
            $id = Trainer::getIdByUin($uin);
            $recomendations = false;
        }

        //data prepearing
            //recomendations
        if ($recomendations) {
            $rec_programs = array();
            $i = 0;
            foreach ($recomendations as $rec) {
                $program_preview = Program::getProgramPreview($rec['program']);
                $program_avatar_path = '/upload/images/programs/avatar/';
                if (file_exists(ROOT.$program_avatar_path.$rec['program'].'.jpg')) $avatar = $program_avatar_path.$rec['program'].'.jpg';
                else $avatar = $program_avatar_path.'0.jpg';
                if (strlen($program_preview['about']) > 50) $short_about = substr($program_preview['about'], 0, 50).'...';
                else $short_about = $program_preview['about'];
                $trainer_info = Trainer::getShortInfoById($rec['trainer']);
                $trainer_avatar_path = '/upload/images/trainers/avatar/';
                if (file_exists(ROOT.$trainer_avatar_path.$rec['trainer'].'.jpg')) $t_avatar = $trainer_avatar_path.$rec['trainer'].'.jpg';
                else $t_avatar = $trainer_avatar_path.'0.jpg';
                
                $rec_programs[$i]['id'] = $rec['program'];
                $rec_programs[$i]['name'] = $program_preview['name'];
                $rec_programs[$i]['about'] = $short_about;
                $rec_programs[$i]['avatar'] = $avatar;
                $rec_programs[$i]['level'] = $program_preview['level'];
                $rec_programs[$i]['t_id'] = $rec['trainer'];
                $rec_programs[$i]['t_name'] = $trainer_info['name'];
                $rec_programs[$i]['t_surname'] = $trainer_info['surname'];
                $rec_programs[$i]['t_avatar'] = $t_avatar;
                $i++;
            }
        }

            //filters
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }
        $trainers = Trainer::getShortInfo();

        //page type
        require_once(ROOT . '/views/explore/index.php');
        return true;
    }

    //program page
    public function actionProgram($program_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            $my_program = Program::isStudentHave($id, $program_id);
            $my_level = Student::getDataById($id);
            $my_level = $my_level['level'];
        } else {
            $id = Trainer::getIdByUin($uin);
            $main_students = Trainer::getMainStudents($id);
            $secondary_students = Trainer::getSecondaryStudents($id);
            $students_list = array_merge($main_students, $secondary_students);
        }

        //data prepearing
            //program info
        $program = Program::getProgram($program_id);
        $trainer_info = Trainer::getShortInfoById($program['trainer']);
        $program['lessons'] = json_decode($program['lessons'], true);
        $program_avatar_path = '/upload/images/programs/avatar/';
        if (file_exists(ROOT.$program_avatar_path.$program_id.'.jpg')) $avatar = $program_avatar_path.$program_id.'.jpg';
        else $avatar = $program_avatar_path.'0.jpg';
        $trainer_avatar_path = '/upload/images/trainers/avatar/';
        if (file_exists(ROOT.$trainer_avatar_path.$program['trainer'].'.jpg')) $trainer_info['avatar'] = $trainer_avatar_path.$program['trainer'].'.jpg';
        else $trainer_info['avatar'] = $trainer_avatar_path.'0.jpg';

        if ($user === 2) {
            if ($program['trainer'] == $id) {
                $my_program = true;
            } else {
                $my_program = false;
            }
        }
        $title = $program['name'];
            //lessons
        $lesson_preview_path = '/upload/images/lessons/preview/';
        $lessons_data = array();
        if ($program['lessons']) {
            foreach ($program['lessons'] as $key => $lesson) {
                $lessons_data[$key] = Program::getLessonPreview($lesson);
                if (strlen($lessons_data[$key]['about']) > 50) $lessons_data[$key]['about'] = substr($lessons_data[$key]['about'], 0, 50).'...';
                if (file_exists(ROOT.$lesson_preview_path.$lesson.'.jpg')) $lessons_data[$key]['preview'] = $lesson_preview_path.$lesson.'.jpg';
                else $lessons_data[$key]['preview'] = $lesson_preview_path.'0.jpg';
            }
        }
            //levels
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }

            //tags
        if ($program['lessons']) {
            $physical = array();
            $muscle = array();
            $skills = array();
            foreach ($program['lessons'] as $key => $lesson) {
                $lessons_tags = Program::getLesson($lesson);
                $physical = array_merge($physical, json_decode($lessons_tags['physical'], true));
                $muscle = array_merge($muscle, json_decode($lessons_tags['muscle'], true));
                $skills = array_merge($skills, json_decode($lessons_tags['skills'], true));
            }
            $physical = array_unique($physical);
            $muscle = array_unique($muscle);
            $skills = array_unique($skills);
            if(($key = array_search("", $physical)) !== false) {
                unset($physical[$key]);
            }
            if(($key = array_search("", $muscle)) !== false) {
                unset($muscle[$key]);
            }
            if(($key = array_search("", $skills)) !== false) {
                unset($skills[$key]);
            }
            if (empty($physical)) {
                $physical = false;
            }
            if (empty($muscle)) {
                $muscle = false;
            }
            if (empty($skills)) {
                $skills = false;
            }
        }

            //comments
        $comments = Comments::getSomeProg($program_id, 0, 100);

        //view connection
        require_once(ROOT . '/views/explore/program.php');
        return true;
    }

    //add program comment
    public function actionAdd_comment($program_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //Page type (my page or observe)
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
        } else header('Location: /login');

        //data proccesing
        $data['program'] = $program_id;
        $data['message'] = htmlspecialchars($_POST['message']);
        $data['student'] = $id;
        Comments::addSomeProg($data);

        //view connection
        header('Location: /explore/program/'.$program_id);
        return true;
    }

    //delete comment
    public function actionDel_comment($comment)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //rights check
        if ($user === 1) {
            $comment_data = Comments::getOneProg($comment);
            $id = Student::getIdByUin($uin);
            if ($comment_data['student'] != $id) header('Location: /login');
        } header('Location: /login');

        //delete action
        Comments::delSomeProg($comment);

        //redirection
        header('Location: /explore/program/'.$comment_data['program']);
        return true;
    }

    //new program
    public function actionNew()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page title
        $title = "New program";

        //page type, get user data
        if ($user === 1) {
            header('Location: /login');
        } else {
            $id = Trainer::getIdByUin($uin);
        }

        //data prepearing
            //levels
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }

        //data processing
        $error = false;
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);
            $data['trainer'] = $id;
            $data['promo'] = htmlspecialchars($_POST['promo']);
            $data['cost'] = floatval($_POST['cost']);
            $data['level'] = intval($_POST['level']);

            if (!$result = Program::newProgram($data)) $error = true;
            else {
                if ($_FILES['avatar']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['avatar']["tmp_name"])) {
                        move_uploaded_file($_FILES['avatar']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/programs/avatar/".$result.".jpg");
                    } else $errors['upload'] = true;
                } else $errors['upload'] = true;
                if (!isset($errors['upload'])) {
                    header('Location: /explore/program/'.$result);
                } else {
                    Program::delProgram($result);
                }
            }
        }

        //view connection
        require_once(ROOT . '/views/explore/new.php');
        return true;
    }

    //edit program
    public function actionEdit($program_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page title
        $title = "Edit program";

        //page type, get user data
        if ($user === 1) {
            header('Location: /login');
        } else {
            $id = Trainer::getIdByUin($uin);
            $program_data = Program::getProgram($program_id);
            if ($program_data['trainer'] != $id) {
                header('Location: /login');
            }
        }

        //data prepearing
            //levels
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }

        //data processing
        $error = false;
        if (isset($_POST['submit'])) {
            $data['name'] = htmlspecialchars($_POST['name']);
            $data['about'] = htmlspecialchars($_POST['about']);
            $data['promo'] = htmlspecialchars($_POST['promo']);
            $data['cost'] = floatval($_POST['cost']);
            $data['level'] = intval($_POST['level']);

            if (!Program::editProgram($program_id, $data)) $error = true;
            else {
                if ($_FILES['avatar']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['avatar']["tmp_name"])) {
                        move_uploaded_file($_FILES['avatar']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/programs/avatar/".$program_id.".jpg");
                    } else $errors['upload'] = true;
                }
                if (!isset($errors['upload'])) {
                    header('Location: /explore/program/'.$program_id);
                }
            }
        }

        //view connection
        require_once(ROOT . '/views/explore/edit.php');
        return true;
    }

    //delete program
    public function actionDel($program_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page title
        $title = "Edit program";

        //page type, get user data
        if ($user === 1) {
            header('Location: /login');
        } else {
            $id = Trainer::getIdByUin($uin);
            $program_data = Program::getProgram($program_id);
            if ($program_data['trainer'] != $id) {
                header('Location: /login');
            }
        }

        //deleting proces
        if (isset($_POST['submit'])) {
            //deleting program
            Program::delProgram($program_id);
            //deleting program from users
            Program::delCommon($program_id);
            //deleting files
            if (file_exists(ROOT . "/upload/images/programs/avatar/".$program_id.".jpg")) unlink(ROOT . "/upload/images/programs/avatar/".$program_id.".jpg");
            //redirect
            header('Location: /trainer');
        }

        //if clicked "no"
        if (isset($_POST['deny'])) {
            //redirect
            header('Location: /trainer');
        }

        //view connection
        require_once(ROOT . '/views/explore/del.php');
        return true;
    }

    //recomend program to student (ajax)
    public function actionRecomend($program, $student)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $my_page = 0;
        if ($user === 1) die('Access deny.');
        else {
            $id = Trainer::getIdByUin($uin);
            if (!Student::isTrainer($student, $id)) die('Access deny.');
        }

        //check is realy actual recomendation
        if (!Program::isStudentHave($student, $program)) {
            if (!Program::isHaveRecommendation($student, $program)) {
                //adding recomendation
                if (Program::addRecommendation($student, $id, $program)) echo "Recommended";
                else echo "Error on the server";
            } else echo "Already recommended to user";
        } else echo "Student already have it";

        return true;
    }

    //programs list (ajax)
    public function actionLoad($level, $trainer)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //data prepearing
            //levels
        $levels = array();
        $i = 1;
        while ($i <= 5) {
            $levels[$i] = Program::getLevelName($i);
            $i++;
        }

        //get programs
        $programs = Program::getExplorePrograms($level, $trainer);

        //view connection
        require_once(ROOT . '/views/explore/programs.php');
        return true;
    }

    //add program to cart
    public function actionAdd($program_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            $program_data = Program::getProgram($program_id);
            if (!Program::isStudentHave($id, $program_id)) header('Location: /login');
            $my_level = Student::getDataById($id);
            $my_level = $my_level['level'];
            if ($program_data['level'] > $my_level) header('Location: /login');
        } else {
            header('Location: /login');
        }

        //get cart data
        $cart = Cart::getCart($id);
        $programs = json_decode($cart['programs'], true);
        if (array_search($program_id, $programs) === false) {
            $programs[] = $program_id;
        }
        $programs = json_encode($programs);

        //change cart data
        Cart::changeCart($programs, $id);

        //redirect
        header('Location: /explore/cart');
        return true;
    }

    //cart page
    public function actionCart()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        if ($user === 1) {
            $title = "Cart";
            $id = Student::getIdByUin($uin);
        } else {
            header('Location: /login');
        }

        //get cart data
        $cart = Cart::getCart($id);
        $programs = json_decode($cart['programs'], true);

        //buy procces
        if (isset($_POST['submit'])) {
            //delete all from cart
            Cart::changeCart("[]", $id);

            foreach ($programs as $value) {
                //adding program to user
                $program_data = Program::getProgram($value);
                $trainer_data = Trainer::getDataById($program_data['trainer']);
                $lessons = json_decode($program_data['lessons']);
                $status = array();
                foreach ($lessons as $lesson) {
                     $status[] = 0;
                }
                $status = json_encode($status);
                Program::addCommon($id, $value, $status);

                //add money transaction
                $transaction_data['student'] = $id;
                $transaction_data['trainer'] = $program_data['trainer'];
                $transaction_data['amount'] = $trainer_data['price'];
                $transaction_data['program'] = $value;
                Transactions::addSome($transaction_data);
            }
            //redirect
            header('Location: /student');
        //cart preview
        } else {
            //preparing data
            $program_avatar_path = '/upload/images/programs/avatar/';
            $programs_data = array();
            $total = 0;
            foreach ($programs as $key => $value) {
                $programs_data[$key] = Program::getProgramPreview($value);
                if (file_exists(ROOT.$program_avatar_path.$value.'.jpg')) $programs_data[$key]['avatar'] = $program_avatar_path.$value.'.jpg';
                else $programs_data[$key]['avatar'] = $program_avatar_path.'0.jpg';
                $total += floatval($programs_data[$key]['cost']);
            }
        }

        //view connection
        require_once(ROOT . '/views/explore/cart.php');
        return true;
    }

}