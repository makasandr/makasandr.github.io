<?php

class StudentController
{

    //student page
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
            if ($user === 1) {
                $id = Student::getIdByUin($uin);
                $title = "My page";
                $my_page = 1;
                $user_data = Student::getDataById($id);
                $trainers_ids = json_decode($user_data['trainers'], true);
            } else header('Location: /trainer');
        } else {
            if ($user === 1) header('Location: /student');
            else {
                $user_data = Student::getDataById($id);
                $trainers_ids = json_decode($user_data['trainers'], true);
                $trainer = Trainer::getIdByUin($uin);
                $title = $user_data['name'].' '.$user_data['surname'];

                foreach ($trainers_ids as $value) {
                    if ($trainer == $value) $main_trainer = 0;
                }
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                }
            }
        }

        //User data prepearing
            //profile images
        $user_data['bg'] = '/upload/images/students/bg/';
        if (file_exists(ROOT.$user_data['bg'].$id.'.jpg')) $user_data['bg'] .= $id.'.jpg';
        else $user_data['bg'] .= '0.jpg';
        $user_data['avatar'] = '/upload/images/students/avatar/';
        if (file_exists(ROOT.$user_data['avatar'].$id.'.jpg')) $user_data['avatar'] .= $id.'.jpg';
        else $user_data['avatar'] .= '0.jpg';

            //trainers info
        $main_trainer_data = Trainer::getShortInfoById($user_data['main_trainer']);
        $trainers_avatar_path = '/upload/images/trainers/avatar/';
        if (file_exists($trainers_avatar_path.$main_trainer_data['id'].'.jpg')) $main_trainer_data['avatar'] = $trainers_avatar_path.$main_trainer_data['id'].'.jpg';
        else $main_trainer_data['avatar'] = $trainers_avatar_path.'0.jpg';
        if ($trainers_ids) {
            $i = 0;
            foreach ($trainers_ids as $trainer_id) {
                $trainers_data[$i] = Trainer::getShortInfoById($trainer_id);
                if (file_exists($trainers_avatar_path.$trainers_data[$i]['id'].'.jpg')) $trainers_data[$i]['avatar'] = $trainers_avatar_path.$trainers_data[$i]['id'].'.jpg';
                else $trainers_data[$i]['avatar'] = $trainers_avatar_path.'0.jpg';
                $i++;
            }
        }

            //progress line
        $common_progress = Program::getCommonProgress($id, $user_data['level']);
        $personal_progress = Program::getPersonalProgress($id, $user_data['level']);
        $progress = $common_progress + $personal_progress;
        $top_progress = Program::getTopProgress($user_data['level']);
        if ($top_progress) {
            $progress_line = round((1/$top_progress)*$progress, 2);
        }
        if (!isset($progress_line) || $progress_line > 1) $progress_line = 1;

            //"about me" preview
        $about = $user_data['about'];
        //$about_preview = $output = array_slice($about, 0, 5);

            //awards preview
        $awards = Awards::getSome($id, 3);

            //programs
        $programs = Program::getStudentPrograms($id);
        $personal_program_data = Program::getPersonalProgressData($id);
        $recomended = Program::getRecomendatinsCount($id);

            //targets
        $targets = Targets::getStudentTargets($id);

            //photos
        $last_ins = Photos::getStudentLastPhoto($id, 1);
        $ins_count = Photos::getStudentPhotoCount($id, 1);
        $last_ach = Photos::getStudentLastPhoto($id, 2);
        $ach_count = Photos::getStudentPhotoCount($id, 2);
        $last_wm = Photos::getStudentLastPhoto($id, 3);
        $wm_count = Photos::getStudentPhotoCount($id, 3);

            //private
        if ($my_page) {
            $private = Priv::getStudentMessages($id, 0, 100);
        } else {
            $private = Priv::getStudentMessagesFromTrainer($id, $trainer, 0, 100);
        }

            //trainers blogs
        $prev_date = time() - (86400*100);
        $blogs = Blogs::getMessagesForDate($user_data['main_trainer'], $prev_date, time());
        if ($trainers_ids) {
            foreach ($trainers_ids as $trainer_id) {
                $blogs = $blogs + Blogs::getMessagesForDate($trainer_id, $prev_date, time());
            }
        }
        $blogs = $blogs + Blogs::getMessagesForDateStud($id, $prev_date, time());
        krsort($blogs);

            //notes
        if ($my_page) {
            $notes = Note::getStudentNotes($id, 0, 100);
        }

        //view connection
        require_once(ROOT . '/views/student/index.php');
        return true;
    }

    //list of user awards (ajax)
    public function actionAwards($student, $award)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if ($id != $student) die('Access deny.');
        } else {
            $user_data = Student::getDataById($student);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);
            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            }
            if (!isset($main_trainer)) die('Access deny.');
        }

        //get awards
        $awards = Awards::getSome($student, 0);
        if (!$award) {
            $keys = array_keys($awards);
            $award = $keys[0];
        }

        //view connection
        require_once(ROOT . '/views/student/awards.php');
        return true;
    }

    //add award to student
    public function actionAdd_award($student)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) header('Location: /login');
        else {
            $user_data = Student::getDataById($student);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);
            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            }
            if (!isset($main_trainer)) header('Location: /login');
        }

        //data proccesing
        $data['student'] = $student;
        $data['trainer'] = $trainer;
        $data['message'] = htmlspecialchars($_POST['message']);
        $data['type'] = htmlspecialchars($_POST['type']);
        Awards::addSome($data);

        //redirect
        header('Location: /student/'.$student);
        return true;
    }

    //videos list from program (ajax)
    public function actionVideos($id, $program)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $id) die('Access deny.');
        } else {
            $user_data = Student::getDataById($id);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);

            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            } elseif (!isset($main_trainer)) {
                die('Access deny.');
            }
        }

        //get lessons list
        $empty = 0;
        if ($program) {
            $lessons = Program::getLessons($program);
            $status = Program::getProgramStatus($id, $program);
            $i = 0;
            if (!empty($lessons)) {
                foreach ($lessons as $key => $lesson) {
                    $videos[$i]['id'] = $lesson;
                    $videos[$i]['status'] = $status[$key];
                    $i++;
                }
            } else $empty = 1;
        } else {
            $lessons = Program::getPrivateLessons($id);
            $i = 0;
            if (!empty($lessons['lessons'])) {
                foreach ($lessons['lessons'] as $key => $lesson) {
                    $videos[$i]['id'] = $lesson;
                    $videos[$i]['status'] = intval($lessons['status'][$key]);
                    $i++;
                }
            } else $empty = 1;
        }
        
        //prepare data for each lesson
        if (!$empty) {
            $lesson_preview_path = '/upload/images/lessons/preview/';
            $last_status = 0;
            $first = 1;
            foreach ($videos as $key => $video) {
                $video_data = Program::getLessonPreview($video['id']);
                if (intval($video_data['date']) < time()) {
                    $videos[$key]['name'] = $video_data['name'];
                    if (strlen($video_data['about']) > 50) $short_about = substr($video_data['about'], 0, 50).'...';
                    else $short_about = $video_data['about'];
                    $videos[$key]['about'] = $short_about;
                    $videos[$key]['promo'] = $video_data['promo'];
                    if (file_exists(ROOT.$lesson_preview_path.$video['id'].'.jpg')) $preview = $lesson_preview_path.$video['id'].'.jpg';
                    else $preview = $lesson_preview_path.'0.jpg';
                    $videos[$key]['preview'] = $preview;
                    if ($video['status']) {
                        $videos[$key]['status_text'] = "Done";
                        $videos[$key]['status'] = 2;
                        $first = 0;
                    } elseif (!$first) {
                        if ($program) {
                            if ($last_status) {
                                if (time()-86400 > $last_status) {
                                    $videos[$key]['status'] = 1;
                                } else {
                                    $to_unlock = ceil(24-((time()-$last_status)/3600));
                                    $videos[$key]['status_text'] = $to_unlock." hours to unlock";
                                    $videos[$key]['status'] = 0;
                                }
                            } else {
                                $videos[$key]['status_text'] = "Locked";
                                $videos[$key]['status'] = 0;
                            }
                        } else {
                            $videos[$key]['status'] = 1;
                        }
                    } else {
                        $videos[$key]['status'] = 1;
                        $first = 0;
                    }
                    $last_status = $video['status'];
                } else {
                    unset($videos[$key]);
                }
            }
        }
        
        //view connection
        require_once(ROOT . '/views/student/videos.php');
        return true;
    }

    //image gallery (ajax)
    public function actionGallery($id, $type)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $id) die('Access deny.');
        } else {
            $user_data = Student::getDataById($id);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);

            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            } elseif (!isset($main_trainer)) {
                die('Access deny.');
            }
        }

        //data preparing
        $photos = Photos::getStudentPhotos($id, $type, 0, 100);
        $count = Photos::getStudentPhotoCount($id, $type);

        //folder
        if ($type == 1) {
            $type_abr = "ins";
        } elseif ($type == 2) {
            $type_abr = "ach";
        } else {
            $type_abr = "wm";
        }

        //view connection
        require_once(ROOT . '/views/student/gallery.php');
        return true;
    }

    //photo upload
    public function actionPhoto($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $id) die('Access deny.');
        } else {
            $user_data = Student::getDataById($id);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);

            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            } elseif (!isset($main_trainer)) {
                die('Access deny.');
            }
        }

        if (!isset($_POST['submit'])) {
            die('Access deny.');
        }

        $type = htmlspecialchars($_POST['type']);
        $about = htmlspecialchars($_POST['about']);
        if (!isset($trainer)) {
            $trainer = NULL;
        }

        //format convertation
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

        //creating miniature
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

        if ($result = Photos::addPhoto($id, $type, $about, $trainer)) {
            //work with file
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
        header('Location: /student/'.$id);
        return true;
    }

    //delete photo
    public function actionDel_photo($photo_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //view connection
        $photo = Photos::getPhoto($photo_id);
        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $photo['student']) die('Access deny.');
        } {
            $my_id = Trainer::getIdByUin($uin);
            if ($my_id != $photo['trainer']) die('Access deny.');
        }

        //deleting procces
        if (Photos::delPhoto($photo_id)) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$photo_id.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/galleries/".$photo_id."_p.jpg");
        }

        //redirect
        header('Location: /student/'.$photo['student']);    
        return true;
    }

    //photo preview window (ajax)
    public function actionView_photo($photo_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        $photo = Photos::getPhoto($photo_id);
        if (isset($photo['trainer'])) {
            $trainers_data = Trainer::getShortInfoById($photo['trainer']);
            $photo['name'] = $trainers_data['name'];
            $photo['surname'] = $trainers_data['surname'];
        }

        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $photo['student']) die('Access deny.');
        } else {
            $my_id = $photo['student'];
            $user_data = Student::getDataById($my_id);
            $trainers_ids = json_decode($user_data['trainers'], true);
            $trainer = Trainer::getIdByUin($uin);

            foreach ($trainers_ids as $value) {
                if ($trainer == $value) $main_trainer = 0;
            }
            if ($user_data['main_trainer'] == $trainer) {
                $main_trainer = 1; 
            } elseif (!isset($main_trainer)) {
                die('Access deny.');
            }
        }

        $prev = Photos::getStudentPrevId($photo_id, $my_id, $photo['category']);
        $next = Photos::getStudentNextId($photo_id, $my_id, $photo['category']);
     
        //view connection
        require_once(ROOT . '/views/student/photo.php');
        return true;
    }

    //private message callback
    public function actionCallback($type, $user_id, $id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $my_id = Student::getIdByUin($uin);
            if ($my_id != $user_id) die('Access deny.');
        } else die('Access deny.');

        if ($type == 1) {
            Priv::setYes($id);
        } else {
            Priv::setNo($id);
        }       
        return true;
    }

    //level raising
    public function actionRaise($id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($id) {
            if ($user === 1) die('Access deny.');
            else {
                $user_data = Student::getDataById($id);
                $trainers_ids = json_decode($user_data['trainers'], true);
                $trainer = Trainer::getIdByUin($uin);
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                }
            }
        } else die('Access deny.');

        if (isset($main_trainer)) {
            $next_level = intval($user_data['main_trainer']) + 1;
            Student::raise($next_level, $id);
            header('Location: /student/'.$id);
        }       
        return true;
    }

    //page edit
    public function actionEdit()
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) header('Location: /login');
        } else header('Location: /login');

        //Page initiation
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            $title = "Edit personal data";
            $user_data = Student::getDataById($id);
        } else header('Location: /trainer');

        //Data prepearing
            //profile images
        $user_data['bg'] = '/upload/images/students/bg/';
        if (file_exists($user_data['bg'].$id.'.jpg')) $user_data['bg'] .= $id.'.jpg';
        else $user_data['bg'] .= '0.jpg';
        $user_data['avatar'] = '/upload/images/students/avatar/';
        if (file_exists($user_data['avatar'].$id.'.jpg')) $user_data['avatar'] .= $id.'.jpg';
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
            if (!empty($_POST['phone'])) {
                $data['phone'] = htmlspecialchars($_POST['phone']);
            } else $errors['phone'] = 1;
            if (!empty($_POST['mail'])) {
                $data['mail'] = htmlspecialchars($_POST['mail']);
            } else $errors['mail'] = 1;

            $data['answers'] = htmlspecialchars($_POST['about']);

            if (!$result = Student::editStudent($data, $id)) {
                $error['submit'] = 1;
            } else {
                if ($_FILES['bg']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['bg']["tmp_name"])) {
                        move_uploaded_file($_FILES['bg']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/students/bg/".$id.".jpg");
                    }
                }

                if ($_FILES['avatar']['type'] == "image/jpeg") {
                    if (is_uploaded_file($_FILES['avatar']["tmp_name"])) {
                        move_uploaded_file($_FILES['avatar']["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/upload/images/students/avatar/".$id.".jpg");
                    }
                }
                header('Location: /login');
            }
        }

        //view connection
        require_once(ROOT . '/views/student/edit.php');
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
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $message = htmlspecialchars($_POST['message']);

        if ($result = Blogs::addBlogStud($id, $message)) {
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
        header('Location: /student');
        return true;
    }

    //delete blog message
    public function actionDelblog($del_id)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if (Blogs::checkMessageStud($del_id) != $id) die('Access deny.');
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
        header('Location: /student');
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
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $data['trainer'] = htmlspecialchars($_POST['trainer']);
        if (isset($_POST['conf'])) {
            $data['type'] = 1;
        } else {
            $data['type'] = 0;
        }
        $data['message'] = htmlspecialchars($_POST['message']);
        if ($result = Priv::addPrivStud($id, $data)) {
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
        header('Location: /student');
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
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if (Priv::checkMessageStud($del_id) != $id) die('Access deny.');
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
        header('Location: /student');
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
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
        } else die('Access deny.');

        if (!isset($_POST['submit'])) die('Access deny.');

        $note = htmlspecialchars($_POST['message']);

        if ($result = Note::addNoteStud($id, $note)) {
            //creating miniature of image
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
        $_SESSION['slide_to'] = 3;
        //redirect
        header('Location: /student');
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
        if ($user === 1) {
            $id = Student::getIdByUin($uin);
            if (Note::checkMessageStud($del_id) != $id) die('Access deny.');
        } else die('Access deny.');

        //deleting procces
        $images = Note::getImages($del_id);
        foreach ($images as $value) {
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$value.".jpg");
            unlink($_SERVER['DOCUMENT_ROOT']."/upload/images/notes/".$value."_p.jpg");
        }
        Note::delNote($del_id);
        //scroll set
        $_SESSION['slide_to'] = 3;
        //redirect
        header('Location: /student');
        return true;
    }

}