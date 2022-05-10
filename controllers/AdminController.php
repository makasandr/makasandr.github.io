<?php

class AdminController
{

    //main page
    public function actionPage()
    {
        //page title
        $title = "Admin panel";

        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                header('Location: /admin/login');
            }
        } else header('Location: /admin/login');

        //view connection
        require_once(ROOT . '/views/admin/index.php');
        return true;
    }

    //students list (ajax)
    public function actionStudents()
    {
        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                die('Access deny!');
            }
        } else die('Access deny!');

        //request check
        if (!isset($_POST['from']) || !isset($_POST['to']) || !isset($_POST['order'])) {
            die('Access deny!');
        }

        //students list
        $students = Student::getStudentsList($_POST['from'], $_POST['to'], $_POST['order']);

        //view connection
        require_once(ROOT . '/views/admin/students.php');
        return true;
    }

    //trainers list (ajax)
    public function actionTrainers()
    {
        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                die('Access deny!');
            }
        } else die('Access deny!');

        //request check
        if (!isset($_POST['from']) || !isset($_POST['to']) || !isset($_POST['order'])) {
            die('Access deny!');
        }

        //trainers list
        $trainers = Trainer::getTrainersList($_POST['from'], $_POST['to'], $_POST['order']);

        //view connection
        require_once(ROOT . '/views/admin/trainers.php');
        return true;
    }

    //student info (ajax)
    public function actionStudent_info($id)
    {
        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                die('Access deny!');
            }
        } else die('Access deny!');

        //getting student info
        $info = Student::getDataById($id);
        $info['programs'] = Transactions::getStudentTotalNum($id);
        $info['programs_cost'] = Transactions::getStudentTotalCommon($id);
        $info['programs_finished'] = Student::getFinishedPrograms($id);

        //preparing student info
        if ($info['programs']) {
            $info['finished_percent'] = round(100/intval($info['programs'])*intval($info['programs_finished']));
        }
        $info['private'] = Student::getCountPersonal($id);
        $info['private_done'] = Student::getFinishedPersonal($id);
        $info['subscribes'] = Transactions::getStudentTotalPrivateNum($id);
        $info['subscribes_cost'] = Transactions::getStudentTotalPrivate($id);
        $main_trainer = Trainer::getDataById($info['main_trainer']);
        $info['trainers_data'] = $main_trainer['name'].' '.$main_trainer['surname'].' (main)';
        $trainers = json_decode($info['trainers'], true);
        foreach ($trainers as $value) {
            $trainer = Trainer::getDataById($value);
            $info['trainers_data'] .= ', '.$trainer['name'].' '.$trainer['surname'];
        }

        //view connection
        require_once(ROOT . '/views/admin/student_info.php');
        return true;
    }

    //trainer info (ajax)
    public function actionTrainer_info($id)
    {
        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                die('Access deny!');
            }
        } else die('Access deny!');

        //getting trainer info
        $info = Trainer::getDataById($id);

        //preparing trainer info
        $info['rating'] = Review::getRating($id);
        $info['reviews'] = Review::getCount($id);
        $info['created'] = Trainer::getProgramsNum($id);
        $info['programs'] = Transactions::getTrainerTotalNum($id);
        $info['programs_cost'] = Transactions::getTrainerTotalCommon($id);
        $info['subscribes'] = Transactions::getTrainerTotalPrivateNum($id);
        $info['subscribes_cost'] = Transactions::getTrainerTotalPrivate($id);
        $info['blog'] = Blogs::getCount($id);
        $main_students = Trainer::getMainStudents($id);
        $secondary_students = Trainer::getSecondaryStudents($id);
        
        $i = 0;
        foreach ($main_students as $value) {
            if ($i) {
                $info['students'] .= ', '.$value['name'].' '.$value['surname'];
            } else {
                $info['students'] = $value['name'].' '.$value['surname'];
            }
            $i++;
        }

        $i = 0;
        foreach ($secondary_students as $value) {
            if ($i) {
                $info['active_subscribes'] .= ', '.$value['name'].' '.$value['surname'];
            } else {
                $info['active_subscribes'] = $value['name'].' '.$value['surname'];
            }
            $i++;
        }

        //view connection
        require_once(ROOT . '/views/admin/trainer_info.php');
        return true;
    }

    //new student, edit student
    public function actionStudent($id)
    {
        //page title
        $title = "New student";

        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                header('Location: /admin/login');
            }
        } else header('Location: /admin/login');

        //varibles preparing
        $data['name'] = "";
        $data['surname'] = "";
        $data['mail'] = "";
        $data['phone'] = "";
        $data['uin'] = "";
        $data['main_trainer'] = 0;

        //data proccesing
        if (isset($_POST['submit'])) {
            //data from form proccesing, errors check
            $data['name'] = htmlspecialchars($_POST['name']);
            if (empty($data['name'])) $errors['name'] = true;
            $data['surname'] = htmlspecialchars($_POST['surname']);
            if (empty($data['surname'])) $errors['surname'] = true;
            $data['mail'] = htmlspecialchars($_POST['mail']);
            if (empty($data['mail'])) $errors['mail'] = true;
            $data['phone'] = htmlspecialchars($_POST['phone']);
            if (empty($data['phone'])) $errors['phone'] = true;
            $data['uin'] = htmlspecialchars($_POST['uin']);
            if (!$id && User::checkUin($data['uin'])) $errors['uin'] = true;
            $data['main_trainer'] = htmlspecialchars($_POST['main_trainer']);

            //new or edit check
            if (!isset($errors)) {
                //edit
                if ($id) {
                    if (!Admin::changeStudent($data, $id)) $errors['submit'] = true;
                    else header('Location: /admin');
                //new
                } else {
                    if (!Admin::addStudent($data)) $errors['submit'] = true;
                    else header('Location: /admin');
                }
            }
        //edit page sets and data
        } elseif ($id) {
            //getting user data
            $data = Student::getDataById($id);
            //page title
            $title = "Edit student";
        }

        //get trainers list for dropdown list
        $trainers = Trainer::getShortInfo();

        //view connection
        require_once(ROOT . '/views/admin/student.php');
        return true;
    }

    //new trainer, edit trainer
    public function actionTrainer($id)
    {
        //page title
        $title = "New trainer";

        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if (!$admin) {
                header('Location: /admin/login');
            }
        } else header('Location: /admin/login');

        //varibles preparing
        $data['name'] = "";
        $data['surname'] = "";
        $data['mail'] = "";
        $data['phone'] = "";
        $data['price'] = "";
        $data['payment'] = "";
        $data['uin'] = "";

        //data proccesing
        if (isset($_POST['submit'])) {
            //data from form proccesing, errors check
            $data['name'] = htmlspecialchars($_POST['name']);
            if (empty($data['name'])) $errors['name'] = true;
            $data['surname'] = htmlspecialchars($_POST['surname']);
            if (empty($data['surname'])) $errors['surname'] = true;
            $data['mail'] = htmlspecialchars($_POST['mail']);
            if (empty($data['mail'])) $errors['mail'] = true;
            $data['phone'] = htmlspecialchars($_POST['phone']);
            if (empty($data['phone'])) $errors['phone'] = true;
            $data['price'] = htmlspecialchars($_POST['price']);
            if (empty($data['price'])) $errors['price'] = true;
            $data['payment'] = htmlspecialchars($_POST['payment']);
            if (empty($data['payment'])) $errors['payment'] = true;
            $data['uin'] = htmlspecialchars($_POST['uin']);
            if (!$id && User::checkUin($data['uin'])) $errors['uin'] = true;

            //new or edit check
            if (!isset($errors)) {
                //edit
                if ($id) {
                    if (!Admin::changeTrainer($data, $id)) $errors['submit'] = true;
                    else header('Location: /admin');
                //new
                } else {
                    if (!Admin::addTrainer($data)) $errors['submit'] = true;
                    else header('Location: /admin');
                }
            }
        //edit page sets and data
        } elseif ($id) {
            //getting user data
            $data = Trainer::getDataById($id);
            //page title
            $title = "Edit trainer";
        }

        //view connection
        require_once(ROOT . '/views/admin/trainer.php');
        return true;
    }

    //login page
    public function actionLogin()
    {
        //timezone set
        if (!isset($_SESSION['timezone'])) {
            require_once(ROOT . '/views/timezone.php');
        }

        //page title
        $title = "Admin authorization";

        //acces check
        if (isset($_SESSION['pass'])) {
            $pass = $_SESSION['pass'];
            $admin = Admin::checkPass($pass);
            if ($admin) {
                header('Location: /admin');
            }
        //if pass entered
        } elseif (isset($_POST['submit'])) {
            $pass = htmlspecialchars($_POST['pass']);
            //pass check
            $admin_check = Admin::checkPass($pass);

            if ($admin_check) {
                //write pass in session ant redirect
                $_SESSION['pass'] = $_POST['pass'];
                header('Location: /admin');
            } else {
                //if wrong pass
                $errors['pass'] = 1;
            }
        }

        //view connection
        require_once(ROOT . '/views/admin/login.php');
        return true;
    }

    //logut
    public function actionLogout()
    {
        //delete session
        unset($_SESSION['pass']);

        //redirect
        header('Location: /admin/login');
        return true;
    }

}
