<?php

class SiteController
{
    //timezone set
    public function actionTimezone()
    {
        if (isset($_POST['timezone'])) {
            $_SESSION['timezone'] = htmlspecialchars($_POST['timezone']);
        } else require_once(ROOT . '/views/timezone.php');
        return true;
    }

    //cover
    public function actionCover()
    {
        //timezone set
        if (!isset($_SESSION['timezone'])) {
            require_once(ROOT . '/views/timezone.php');
        }
        //page title
        $title = "Lionello Massimo";

        //view connection
        require_once(ROOT . '/views/cover.php');
        return true;
    }

    //main page
    public function actionIndex()
    {
        $title = "Lionello Massimo";

        require_once(ROOT . '/views/index.php');
        return true;
    }

    //nam page
    public function actionMan()
    {
        $title = "Man | Lionello Massimo";

        require_once(ROOT . '/views/man.php');
        return true;
    }

    //woman page
    public function actionWoman()
    {
        $title = "Woman | Lionello Massimo";

        require_once(ROOT . '/views/woman.php');
        return true;
    }

    public function actionBg()
    {
        $title = "Boys & Girls | Lionello Massimo";

        require_once(ROOT . '/views/bg.php');
        return true;
    }

    //about page
    public function actionAbout()
    {
        $title = "About | Lionello Massimo";

        require_once(ROOT . '/views/about.php');
        return true;
    }

    //special page
    public function actionSpecial()
    {
        $title = "Specisal | Lionello Massimo";

        require_once(ROOT . '/views/special.php');
        return true;
    }

    //help page
    public function actionHelp()
    {
        $title = "Help | Lionello Massimo";

        require_once(ROOT . '/views/help.php');
        return true;
    }

    //send mail
    public function actionMail()
    {
        $check = false;
        if (isset($_POST['contact']) && !empty($_POST['contact'])) {
            if (isset($_SESSION['time'])) $sec = time() - $_SESSION['time'];
            if (!isset($_SESSION['time']) || $sec > 300) $check = true;
            else echo '<i class="size-extra center fa fa-exclamation-triangle bottom-mg-half block red"></i>You can send next message after '.(300-$sec).' seconds';
        } else echo '<i class="size-extra center fa fa-exclamation-triangle bottom-mg-half block red"></i>Please type your contact data';

        if ($check) {
            //mail of the addressat
            $to = "example@server.domain";

            $contact = htmlspecialchars($_POST['contact']);
            $social = htmlspecialchars($_POST['social']);
            $message = htmlspecialchars($_POST['message']);
            if (empty($social)) $social = "No link.";
            if (empty($message)) $message = "No message.";

            @$mail = mail($to, "Callback request from lionnelomassimo.com", "Contact data: ".$contact."\nSocial link: ".$social."\n Message: ".$message, "Content-Type: text/plain; charset=UTF-8");

            if ($mail) echo '<i class="top-mg-2 size-extra center fa fa-check bottom-mg-half block gray"></i>Thanks! We contact you soon';
            else echo '<i class="top-mg-2 size-extra center fa fa-exclamation-triangle bottom-mg-half block red"></i>Error on server. Please try again later';

            $_SESSION['time'] = time();
        }

        return true;
    }

    //login page
    public function actionLogin()
    {
        //timezone set
        if (!isset($_SESSION['timezone'])) {
            require_once(ROOT . '/views/timezone.php');
        }

        $title = "Authorization";
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if ($user == 1) {
                header('Location: /student');
            } elseif ($user == 2) {
                header('Location: /trainer');
            }
        } elseif (isset($_POST['submit'])) {
            $uin = htmlspecialchars($_POST['uin']);
            $user = Student::checkUin($uin);
            if ($user == 1) {
                $_SESSION['uin'] = $_POST['uin'];
                header('Location: /student');
            } elseif ($user == 2) {
                $_SESSION['uin'] = $_POST['uin'];
                header('Location: /trainer');
            } elseif (!$user) {
                $errors['uin'] = 1;
            }
        }

        //view connection
        require_once(ROOT . '/views/login.php');
        return true;
    }

    //exit procces
    public function actionLogout()
    {
        unset($_SESSION['uin']);
        header('Location: /login');
        return true;
    }

}