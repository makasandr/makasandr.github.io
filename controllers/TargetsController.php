<?php

class TargetsController
{

    //delete target
    public function actionDel($user_type, $id, $category, $target)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            if ($user_type == 1) {
                $my_id = Student::getIdByUin($uin);
                if ($my_id != $id) die('Access deny.');
            } else die('Access deny.');
        } else {
            $trainer = Trainer::getIdByUin($uin);
            if ($user_type == 1) {
                $user_data = Student::getDataById($id);
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                } else {
                    die('Access deny.');
                }
            } else {
                if ($trainer != $id) die('Access deny.');
            }
        }

        $new_list = array();
        if ($user_type == 1) {
            $targets = Targets::getStudentTargets($id);
            if ($category == 1) {
                foreach ($targets['physical'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    }
                }
            } elseif ($category == 2) {
                foreach ($targets['personal'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    }
                }
            } else {
                foreach ($targets['other'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    }
                }
            }
            if (Targets::revriteStudent($id, $category, json_encode($new_list))) return true;
        } else {
            $targets = Targets::getTrainerTargets($id);
            foreach ($targets as $key => $value) {
                if ($target != $key) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                }
            }
            if (Targets::revriteTrainer($id, json_encode($new_list))) return true;
        }
        
        return false;
    }

    //set target done
    public function actionDone($user_type, $id, $category, $target)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            if ($user_type == 1) {
                $my_id = Student::getIdByUin($uin);
                if ($my_id != $id) die('Access deny.');
            } else die('Access deny.');
        } else {
            $trainer = Trainer::getIdByUin($uin);
            if ($user_type == 1) {
                $user_data = Student::getDataById($id);
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                } else {
                    die('Access deny.');
                }
            } else {
                if ($trainer != $id) die('Access deny.');
            }
        }

        $new_list = array();
        if ($user_type == 1) {
            $targets = Targets::getStudentTargets($id);
            if ($category == 1) {
                foreach ($targets['physical'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                        $new_list[] = $output_target;
                    }
                }
            } elseif ($category == 2) {
                foreach ($targets['personal'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                        $new_list[] = $output_target;
                    }
                }
            } else {
                foreach ($targets['other'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                        $new_list[] = $output_target;
                    }
                }
            }
            if (Targets::revriteStudent($id, $category, json_encode($new_list))) return true;
        } else {
            $targets = Targets::getTrainerTargets($id);
            foreach ($targets as $key => $value) {
                if ($target != $key) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                } else {
                    $output_target = '!'.$value['target'].'|'.$value['date'];
                    $new_list[] = $output_target;
                }
            }
            if (Targets::revriteTrainer($id, json_encode($new_list))) return true;
        }
        
        return false;
    }

    //new target
    public function actionNew($user_type, $id, $category)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            if ($user_type == 1) {
                $my_id = Student::getIdByUin($uin);
                if ($my_id != $id) die('Access deny.');
            } else die('Access deny.');
        } else {
            $trainer = Trainer::getIdByUin($uin);
            if ($user_type == 1) {
                $user_data = Student::getDataById($id);
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                } else {
                    die('Access deny.');
                }
            } else {
                if ($trainer != $id) die('Access deny.');
            }
        }

        $new_target = htmlspecialchars($_POST['target']);
        $new_date = htmlspecialchars($_POST['date']);
        $new_list = array();
        if ($user_type == 1) {
            $targets = Targets::getStudentTargets($id);
            if ($category == 1) {
                foreach ($targets['physical'] as $key => $value) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                }
            } elseif ($category == 2) {
                foreach ($targets['personal'] as $key => $value) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                }
            } else {
                foreach ($targets['other'] as $key => $value) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                }
            }
            $new_list[] = $new_target.'|'.$new_date;
            Targets::revriteStudent($id, $category, json_encode($new_list));
        } else {
            $targets = Targets::getTrainerTargets($id);
            foreach ($targets as $key => $value) {
                if ($value['done']) {
                    $output_target = '!'.$value['target'].'|'.$value['date'];
                } else {
                    $output_target = $value['target'].'|'.$value['date'];
                }
                $new_list[] = $output_target;
            }
            $new_list[] = $new_target.'|'.$new_date;
            Targets::revriteTrainer($id, json_encode($new_list));
        }
        if ($user_type == $user) {
            header('Location: /login');
        } elseif ($user_type == 1) {
            header('Location: /student/'.$id);
        } elseif ($user_type == 2) {
            header('Location: /trainer/'.$id);
        }
        return false;
    }

    //edit target
    public function actionEdit($user_type, $id, $category, $target)
    {
        //UIN check
        if (isset($_SESSION['uin'])) {
            $uin = $_SESSION['uin'];
            $user = Student::checkUin($uin);
            if (!$user) die('Access deny.');
        } else die('Access deny.');

        //page type, get user data
        if ($user === 1) {
            if ($user_type == 1) {
                $my_id = Student::getIdByUin($uin);
                if ($my_id != $id) die('Access deny.');
            } else die('Access deny.');
        } else {
            $trainer = Trainer::getIdByUin($uin);
            if ($user_type == 1) {
                $user_data = Student::getDataById($id);
                if ($user_data['main_trainer'] == $trainer) {
                    $main_trainer = 1; 
                } else {
                    die('Access deny.');
                }
            } else {
                if ($trainer != $id) die('Access deny.');
            }
        }

        $new_target = htmlspecialchars($_POST['target']);
        $new_date = htmlspecialchars($_POST['date']);
        $new_list = array();
        if ($user_type == 1) {
            $targets = Targets::getStudentTargets($id);
            if ($category == 1) {
                foreach ($targets['physical'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = $new_target.'|'.$new_date;
                        $new_list[] = $output_target;
                    }
                }
            } elseif ($category == 2) {
                foreach ($targets['personal'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = $new_target.'|'.$new_date;
                        $new_list[] = $output_target;
                    }
                }
            } else {
                foreach ($targets['other'] as $key => $value) {
                    if ($target != $key) {
                        if ($value['done']) {
                            $output_target = '!'.$value['target'].'|'.$value['date'];
                        } else {
                            $output_target = $value['target'].'|'.$value['date'];
                        }
                        $new_list[] = $output_target;
                    } else {
                        $output_target = $new_target.'|'.$new_date;
                        $new_list[] = $output_target;
                    }
                }
            }
            if (Targets::revriteStudent($id, $category, json_encode($new_list))) return true;
        } else {
            $targets = Targets::getTrainerTargets($id);
            foreach ($targets as $key => $value) {
                if ($target != $key) {
                    if ($value['done']) {
                        $output_target = '!'.$value['target'].'|'.$value['date'];
                    } else {
                        $output_target = $value['target'].'|'.$value['date'];
                    }
                    $new_list[] = $output_target;
                } else {
                    $output_target = $new_target.'|'.$new_date;
                    $new_list[] = $output_target;
                }
            }
            if (Targets::revriteTrainer($id, json_encode($new_list))) return true;
        }
        
        return false;
    }

}