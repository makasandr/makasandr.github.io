<?php

class TrainerController
{

    //trainer page
    public function actionPage($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        $my_page = 0;
        if (!$id) {
            if ($user === 2) {
                $id = Trainer::getIdByUin($uin);
                $title = "My page";
                $my_page = 1;
                $user_data = Trainer::getDataById($id);
            } else header('Location: /student');
        } else {
            if ($user === 2) header('Location: /trainer');
            else {
                $user_data = Trainer::getDataById($id);
                $student = Student::getIdByUin($uin);
                $title = $user_data['name'].' '.$user_data['surname'];
                $is_trainer = Student::isTrainer($student, $id);
            }
        }

        //User data prepearing
            //profile images
        $user_data['bg'] = '/upload/images/trainers/bg/';
        if (file_exists(ROOT.$user_data['bg'].$id.'.jpg')) $user_data['bg'] .= $id.'.jpg';
        else $user_data['bg'] .= '0.jpg';
        $user_data['avatar'] = '/upload/images/trainers/avatar/';
        if (file_exists(ROOT.$user_data['avatar'].$id.'.jpg')) $user_data['avatar'] .= $id.'.jpg';
        else $user_data['avatar'] .= '0.jpg';

            //students
        $main_students = Trainer::getMainStudents($id);
        $secondary_students = Trainer::getSecondaryStudents($id);
        $students_info = array_merge($main_students, $secondary_students);

            //"about me" preview
        $about = $user_data['about'];
        $about_preview = $about;

            //photos
        $photos = Photos::getTrainerPhotos($id, 0, 100);

            //programs
        $programs = Program::getTrainerPrograms($id);

            //targets
        $targets = Targets::getTrainerTargets($id);

            //rating and reviews
        $rating = Review::getRating($id);
        $reviews = Review::getReviews($id, 0, 10);

            //blog
        $prev_date = time() - (86400*100);
        $blog = Blogs::getMessagesForDate($id, $prev_date, time());
        if ($students_info) {
            foreach ($students_info as $student_id) {
                $blog = $blog + Blogs::getMessagesForDateStud($student_id['id'], $prev_date, time());
            }
        }
        krsort($blog);

            //private
        $private = Priv::getMessagesFromTrainer($id, 0, 100);

            //notes
        $notes = Note::getTrainerNotes($id, 0, 100);

        //view connection
        require_once(ROOT . '/views/trainer/index.php');
        return true;
    }

    //personal lellons list (ajax)
    public function actionPersonal($student)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        //data preparing
        $empty = 0;
        $lessons = Program::getPrivateLessons($student);
        $i = 0;
        if (!empty($lessons['lessons'])) {
            foreach ($lessons['lessons'] as $key => $lesson) {
                $lesson_data = Program::getLessonPreview($lesson);
                if ($lesson_data['trainer'] == $id) {
                    $videos[$i]['id'] = $lesson;
                    $videos[$i]['status'] = intval($lessons['status'][$key]);
                    $lesson_preview_path = '/upload/images/lessons/preview/';
                    $videos[$i]['name'] = $lesson_data['name'];
                    if (strlen($lesson_data['about']) > 50) $short_about = substr($lesson_data['about'], 0, 50).'...';
                    else $short_about = $lesson_data['about'];
                    $videos[$i]['about'] = $short_about;
                    if (file_exists(ROOT.$lesson_preview_path.$lesson.'.jpg')) $preview = $lesson_preview_path.$lesson.'.jpg';
                    else $preview = $lesson_preview_path.'0.jpg';
                    $videos[$i]['preview'] = $preview;
                    $i++;
                }
            }
        } else $empty = 1;
        
        //view connection
        require_once(ROOT . '/views/trainer/personal.php');
        return true;
    }

    //adding user to subscribers
    public function actionAdd($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $my_page = 0;
        if ($user === 2) die('Access deny.');
        else {
            $student = Student::getIdByUin($uin);
            $user_data = Student::getDataById($student);
            $trainer_data = Trainer::getDataById($id);
            if (Student::isTrainer($student, $id)) die('Access deny.');
        }

        
        //adding procces
        $trainers = json_decode($user_data['trainers'], true);
        array_unshift($trainers, $id);
        $trainers = json_encode($trainers);
        Trainer::revriteTrainers($student, $trainers);

        $transaction_data['student'] = $student;
        $transaction_data['trainer'] = $id;
        $transaction_data['amount'] = $trainer_data['price'];
        $transaction_data['program'] = 0;
        Transactions::addSome($transaction_data);

        //view connection
        header('Location: /trainer/'.$id);
        return true;
    }

    //delete user from subscribers list
    public function actionDel($id)
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
            $trainer = Trainer::getIdByUin($uin);
            $student_data = Student::getDataById($id);
            if (!Student::isTrainer($id, $trainer)) die('Access deny.');
        }

        //deleting procces
        $trainers = json_decode($student_data['trainers'], true);
        $output = array();
        if (isset($trainers[0])) {
            foreach ($trainers as $value) {
                if ($value != $trainer) {
                    $output[] = $value;
                }
            }
        }
        $trainers = json_encode($output);
        Trainer::revriteTrainers($id, $trainers);

        //redirect
        header('Location: /trainer');
        return true;
    }

    //photo upload in gallery
    public function actionPhoto($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id != $id) {
                die('Access deny.');
            }
        } else die('Access deny.');

        if (!isset($_POST['submit'])) {
            die('Access deny.');
        }

        $about = htmlspecialchars($_POST['about']);

        //convert image format
        function convertImage($originalImage, $outputImage) {
            // jpg, png, gif or bmp?
            $exploded = explode('.',$originalImage);
            $ext = $exploded[count($exploded) - 1]; 

            if (preg_match('/jpg|jpeg/i',$ext))
                $imageTmp=imagecreatefromjpeg($originalImage);
            else if (preg_match('/png/i',$ext))
                $imageTmp=imagecreatefrompng($originalImage);
            else if (preg_match('/gif/i',$ext))
                $imageTmp=imagecreatefromgif($originalImage);
            else if (preg_match('/bmp/i',$ext))
                $imageTmp=imagecreatefrombmp($originalImage);
            else
                return 0;

            imagejpeg($imageTmp, $outputImage, 80);
            imagedestroy($imageTmp);

            return 1;
        }

        //creating miniature of image
        function createMin($filename, $target_filename, $pattern_size) {
            $size = getimagesize($filename);
            $ratio = $size[0]/$size[1];
            if( $ratio > 1) {
                $width = $pattern_size;
                $height = $pattern_size/$ratio;
            }
            else {
                $width = $pattern_size*$ratio;
                $height = $pattern_size;
            }
            $src = imagecreatefromstring(file_get_contents($filename));
            $dst = imagecreatetruecolor($width,$height);
            imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
            imagedestroy($src);
            imagejpeg($dst, $target_filename, 80);
            imagedestroy($dst);
        }

        //uploading files
        if ($result = Photos::addPhoto(NULL, 0, $about, $id)) {
            if (is_uploaded_file($_FILES['photo']["tmp_name"])) {
                move_uploaded_file($_FILES['photo']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/galleries/".$_FILES['photo']["name"]);
                if (convertImage($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$_FILES['photo']["name"], $_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$result.".jpg")) {
                    createMin($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$result.".jpg", $_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$result."_p.jpg", 500);
                } else {
                    Photos::delPhoto($result);
                }
                unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$_FILES['photo']["name"]);
            }
        }

        //redirect
        header('Location: /trainer/'.$id);
        return true;
    }

    //delete photo from gallery
    public function actionDel_photo($photo_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $photo = Photos::getPhoto($photo_id);
        if ($user === 2) {
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id != $photo['trainer']) {
                die('Access deny.');
            }
        } else die('Access deny.');

        //deleting process
        if (Photos::delPhoto($photo_id)) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$photo_id.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$photo_id."_p.jpg");
        }      
        return true;
    }

    //gallery photo preview
    public function actionView_photo($photo_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $my_page = 0;
        $photo = Photos::getPhoto($photo_id);
        if ($user === 2) {
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id == $photo['trainer']) {
                $my_page = 1;
            } else die('Access deny.');
        }

        //navigations links set
        $prev = Photos::getTrainerPrevId($photo_id, $my_id);
        $next = Photos::getTrainerNextId($photo_id, $my_id);
     
        //view connection
        require_once(ROOT . '/views/trainer/photo.php');
        return true;
    }

    //get tasks (ajax)
    public function actionTasks($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $my_page = 0;
        if ($user === 2) {
            $my_page = 1;
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id != $id) die('Access deny.');
        } else die('Access deny.');

        if (!isset($_POST['day'])) die('Access deny.');
        $day = strtotime($_POST['day']);

        //data preparing
        $tasks = Task::getTasks($id, $day);
        if ($tasks) {
            foreach ($tasks as $key => $value) {
                if (!empty($value['students'])) {
                    foreach ($value['students'] as $student) {
                        if (!isset($students_info[$student])) {
                            $students_info[$student] = Student::getShortInfoById($student);
                            $student_avatar_path = '/upload/images/students/avatar/';
                            if (file_exists(ROOT.$student_avatar_path.$student.'.jpg')) $avatar = $student_avatar_path.$student.'.jpg';
                            else $avatar = $student_avatar_path.'0.jpg';
                            $students_info[$student]['avatar'] = $avatar;
                        }
                    }
                }
            }
        }  
        //view connection
        require_once(ROOT . '/views/trainer/tasks.php');
        return true;
    }

    //add task
    public function actionNewtask()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        //data preparing
        $data['name'] = htmlspecialchars($_POST['name']);
        $data['students'] = json_encode($_POST['students']);

        $day = strtotime($_POST['day']);

        $time = explode(':', $_POST['time']);
        $timeinsec = 3600*intval($time[0]);
        $timeinsec += 60*intval($time[1]);

        $data['date'] = $day+$timeinsec;

        Task::addTask($id, $data);
        //redirect
        header('Location: /trainer');
        return true;
    }

    //delete task
    public function actionDeltask($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');
        //deleting task
        Task::delTask($del_id);
        //redirect
        header('Location: /trainer');
        return true;
    }

    //new blog message
    public function actionNewblog()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $message = htmlspecialchars($_POST['message']);

        if ($result = Blogs::addBlog($id, $message)) {
            //code for file names
            function generateCode() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            //convert image format
            function convertImage($originalImage, $outputImage) {
                // jpg, png, gif or bmp?
                $exploded = explode('.',$originalImage);
                $ext = $exploded[count($exploded) - 1]; 

                if (preg_match('/jpg|jpeg/i',$ext))
                    $imageTmp=imagecreatefromjpeg($originalImage);
                else if (preg_match('/png/i',$ext))
                    $imageTmp=imagecreatefrompng($originalImage);
                else if (preg_match('/gif/i',$ext))
                    $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                else
                    return 0;

                imagejpeg($imageTmp, $outputImage, 80);
                imagedestroy($imageTmp);

                return 1;
            }

            //creating miniature of image
            function createMin($filename, $target_filename, $pattern_size) {
                $size = getimagesize($filename);
                $ratio = $size[0]/$size[1];
                if( $ratio > 1) {
                    $width = $pattern_size;
                    $height = $pattern_size/$ratio;
                }
                else {
                    $width = $pattern_size*$ratio;
                    $height = $pattern_size;
                }
                $src = imagecreatefromstring(file_get_contents($filename));
                $dst = imagecreatetruecolor($width,$height);
                imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
                imagedestroy($src);
                imagejpeg($dst, $target_filename, 80);
                imagedestroy($dst);
            }

            $total = count($_FILES['images']['name']);

            //uploading files
            for($i=0; $i<$total; $i++) {
                $code = generateCode();
                if (is_uploaded_file($_FILES['images']["tmp_name"][$i])) {
                    move_uploaded_file($_FILES['images']["tmp_name"][$i], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/blogs/".$_FILES['images']["name"][$i]);
                    if (convertImage($_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$_FILES['images']["name"][$i], $_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$result.$code.".jpg")) {
                        createMin($_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$result.$code.".jpg", $_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$result.$code."_p.jpg", 400);
                        Blogs::addImage($result, $code);
                    }
                    unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$_FILES['images']["name"][$i]);
                }
            }
        }
        //scroll set
        $_SESSION['slide_to'] = 1;
        //redirect
        header('Location: /trainer');
        return true;
    }

    //deleting blog message
    public function actionDelblog($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        //deleting procces
        $images = Blogs::getImages($del_id);
        foreach ($images as $value) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$value.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/blogs/".$value."_p.jpg");
        }
        Blogs::delBlog($del_id);
        //scroll set
        $_SESSION['slide_to'] = 1;
        //redirect
        header('Location: /trainer');
        return true;
    }

    //add review
    public function actionNewreview($trainer_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            die('Access deny.');
        } else {
            $id = Student::getIdByUin($uin);
            if (Review::checkReview($id)) {
                die('Access deny.');
            }
        };

        if (!isset($_POST['submit'])) die('Access deny.');

        //data preparing
        $data['student'] = $id;
        $data['trainer'] = $trainer_id;
        $data['rating'] = htmlspecialchars($_POST['stars']);
        $data['review'] = htmlspecialchars($_POST['review']);

        Review::addReview($data);
        //scroll set
        $_SESSION['slide_to'] = 3;
        //redirect
        header('Location: /trainer/'.$trainer_id);
        return true;
    }

    //delete review
    public function actionDelreview($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            die('Access deny.');
        } else {
            $id = Student::getIdByUin($uin);
            $review_data = Review::getReview($del_id);
            if ($id != $review_data['student']) {
                die('Access deny.');
            }
        };
        //deleting procces
        Review::delReview($del_id);
        //scroll set
        $_SESSION['slide_to'] = 3;
        //redirect
        header('Location: /trainer/'.$review_data['trainer']);
        return true;
    }

    //new private message
    public function actionNewpriv()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $data['student'] = htmlspecialchars($_POST['student']);
        if (isset($_POST['conf'])) {
            $data['type'] = 1;
        } else {
            $data['type'] = 0;
        }
        $data['message'] = htmlspecialchars($_POST['message']);

        if ($result = Priv::addPriv($id, $data)) {
            //code for file names
            function generateCode() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            //convert image format
            function convertImage($originalImage, $outputImage) {
                // jpg, png, gif or bmp?
                $exploded = explode('.',$originalImage);
                $ext = $exploded[count($exploded) - 1]; 

                if (preg_match('/jpg|jpeg/i',$ext))
                    $imageTmp=imagecreatefromjpeg($originalImage);
                else if (preg_match('/png/i',$ext))
                    $imageTmp=imagecreatefrompng($originalImage);
                else if (preg_match('/gif/i',$ext))
                    $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                else
                    return 0;

                imagejpeg($imageTmp, $outputImage, 80);
                imagedestroy($imageTmp);

                return 1;
            }

            //creating miniature of image
            function createMin($filename, $target_filename, $pattern_size) {
                $size = getimagesize($filename);
                $ratio = $size[0]/$size[1];
                if( $ratio > 1) {
                    $width = $pattern_size;
                    $height = $pattern_size/$ratio;
                }
                else {
                    $width = $pattern_size*$ratio;
                    $height = $pattern_size;
                }
                $src = imagecreatefromstring(file_get_contents($filename));
                $dst = imagecreatetruecolor($width,$height);
                imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
                imagedestroy($src);
                imagejpeg($dst, $target_filename, 80);
                imagedestroy($dst);
            }

            $total = count($_FILES['images']['name']);

            //uploading files
            for($i=0; $i<$total; $i++) {
                $code = generateCode();
                if (is_uploaded_file($_FILES['images']["tmp_name"][$i])) {
                    move_uploaded_file($_FILES['images']["tmp_name"][$i], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/private/".$_FILES['images']["name"][$i]);
                    if (convertImage($_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$_FILES['images']["name"][$i], $_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$result.$code.".jpg")) {
                        createMin($_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$result.$code.".jpg", $_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$result.$code."_p.jpg", 400);
                        Priv::addImage($result, $code);
                    }
                    unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$_FILES['images']["name"][$i]);
                }
            }
        }
        //scroll set
        $_SESSION['slide_to'] = 2;
        //redirect
        header('Location: /trainer');
        return true;
    }

    //private message cLLback
    public function actionCallback($type, $user_id, $id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user == 2) {
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id != $user_id) die('Access deny.');
        } else die('Access deny.');

        if ($type == 1) {
            Priv::setYes($id);
        } else {
            Priv::setNo($id);
        }       
        return true;
    }

    //delete private message
    public function actionDelpriv($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        //deleting procces
        $images = Priv::getImages($del_id);
        foreach ($images as $value) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$value.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/private/".$value."_p.jpg");
        }
        Priv::delPriv($del_id);
        //scroll set
        $_SESSION['slide_to'] = 2;
        //redirect
        header('Location: /trainer');
        return true;
    }

    //new note
    public function actionNewnote()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $note = htmlspecialchars($_POST['message']);

        if ($result = Note::addNoteTrain($id, $note)) {
            //code for file names
            function generateCode() {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < 10; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }

            //convert image format
            function convertImage($originalImage, $outputImage) {
                // jpg, png, gif or bmp?
                $exploded = explode('.',$originalImage);
                $ext = $exploded[count($exploded) - 1]; 

                if (preg_match('/jpg|jpeg/i',$ext))
                    $imageTmp=imagecreatefromjpeg($originalImage);
                else if (preg_match('/png/i',$ext))
                    $imageTmp=imagecreatefrompng($originalImage);
                else if (preg_match('/gif/i',$ext))
                    $imageTmp=imagecreatefromgif($originalImage);
                else if (preg_match('/bmp/i',$ext))
                    $imageTmp=imagecreatefrombmp($originalImage);
                else
                    return 0;

                imagejpeg($imageTmp, $outputImage, 80);
                imagedestroy($imageTmp);

                return 1;
            }

            //creating miniature of image
            function createMin($filename, $target_filename, $pattern_size) {
                $size = getimagesize($filename);
                $ratio = $size[0]/$size[1];
                if( $ratio > 1) {
                    $width = $pattern_size;
                    $height = $pattern_size/$ratio;
                }
                else {
                    $width = $pattern_size*$ratio;
                    $height = $pattern_size;
                }
                $src = imagecreatefromstring(file_get_contents($filename));
                $dst = imagecreatetruecolor($width,$height);
                imagecopyresampled($dst,$src,0,0,0,0,$width,$height,$size[0],$size[1]);
                imagedestroy($src);
                imagejpeg($dst, $target_filename, 80);
                imagedestroy($dst);
            }

            $total = count($_FILES['images']['name']);

            //uploading files
            for($i=0; $i<$total; $i++) {
                $code = generateCode();
                if (is_uploaded_file($_FILES['images']["tmp_name"][$i])) {
                    move_uploaded_file($_FILES['images']["tmp_name"][$i], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/notes/".$_FILES['images']["name"][$i]);
                    if (convertImage($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$_FILES['images']["name"][$i], $_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$result.$code.".jpg")) {
                        createMin($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$result.$code.".jpg", $_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$result.$code."_p.jpg", 400);
                        Note::addImage($result, $code);
                    }
                    unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$_FILES['images']["name"][$i]);
                }
            }
        }
        //scroll set
        $_SESSION['slide_to'] = 4;
        //redirect
        header('Location: /trainer');
        return true;
    }

    //delete note
    public function actionDelnote($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
            if (Note::checkMessageTrain($del_id) != $id) die('Access deny.');
        } else die('Access deny.');

        //deleting procces
        $images = Note::getImages($del_id);
        foreach ($images as $value) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$value.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$value."_p.jpg");
        }
        Note::delNote($del_id);
        //scroll set
        $_SESSION['slide_to'] = 4;
        //redirect
        header('Location: /trainer');
        return true;
    }

    public function actionEdit()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //page type, get user data
        if ($user === 2) {
            $id = Trainer::getIdByUin($uin);
            $title = "Edit personal data";
            $user_data = Trainer::getDataById($id);
        } else header('Location: /student');

        //Data prepearing
            //profile images
        $user_data['bg'] = '/upload/images/trainers/bg/';
        if (file_exists(ROOT.$user_data['bg'].$id.'.jpg')) $user_data['bg'] .= $id.'.jpg';
        else $user_data['bg'] .= '0.jpg';
        $user_data['avatar'] = '/upload/images/trainers/avatar/';
        if (file_exists(ROOT.$user_data['avatar'].$id.'.jpg')) $user_data['avatar'] .= $id.'.jpg';
        else $user_data['avatar'] .= '0.jpg';

            //"about me" preview
        $about = $user_data['about'];

        //Data processing
        if (isset($_POST['submit'])) {
            if (!empty($_POST['name'])) {
                $data['name'] = htmlspecialchars($_POST['name']);
            } else $errors['name'] = 1;
            if (!empty($_POST['surname'])) {
                $data['surname'] = htmlspecialchars($_POST['surname']);
            } else $errors['surname'] = 1;
            $data['status'] = htmlspecialchars($_POST['status']);
            $data['fb'] = htmlspecialchars($_POST['fb']);
            $data['instagram'] = htmlspecialchars($_POST['instagram']);
            if (!empty($_POST['price'])) {
                $data['price'] = floatval($_POST['price']);
            } else $errors['price'] = 1;
            if (!empty($_POST['payment'])) {
                $data['payment'] = htmlspecialchars($_POST['payment']);
            } else $errors['payment'] = 1;
            if (!empty($_POST['phone'])) {
                $data['phone'] = htmlspecialchars($_POST['phone']);
            } else $errors['phone'] = 1;
            if (!empty($_POST['mail'])) {
                $data['mail'] = htmlspecialchars($_POST['mail']);
            } else $errors['mail'] = 1;

            $data['answers'] = htmlspecialchars($_POST['about']);

            if (!$result = Trainer::editTrainer($data, $id)) {
                $error['submit'] = 1;
            } else {
                //uploading files
                if ($_FILES['bg']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['bg']["tmp_name"])) {
                        move_uploaded_file($_FILES['bg']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/trainers/bg/".$id.".jpg");
                    }
                }

                if ($_FILES['avatar']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['avatar']["tmp_name"])) {
                        move_uploaded_file($_FILES['avatar']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/trainers/avatar/".$id.".jpg");
                    }
                }
                header('Location: /login');
            }
        }

        //view connection
        require_once(ROOT . '/views/trainer/edit.php');
        return true;
    }

}