<?php
require('../models/User.php');

$mode = (isset($_GET['mode'])) ? $_GET['mode'] : 'default';
$userId = (isset($_GET['user_id'])) ? $_GET['user_id'] : 0; // 0は誰でもない状態

$user = new User();

switch ($mode) {
    case 'show':
        $userInfo = $user->getInfo($userId);
        include_once '../views/show.php';
        break;
    case 'edit':
        $userInfo = $user->getInfo($userId);
        include_once '../views/edit.php';
        break;
    case 'update':
        $userInfoErrors = $user->infoErrors($_POST);
        if (count($userInfoErrors) > 0) {
            include_once '../views/edit.php';
            break;
            
        }
        if ($user->updateInfo($userId, $_POST)) {
            //include_once '../views/show.php';
            // include_onceだと画面更新するとまたupdateに飛んでしまうため
            // もしくはPOSTの有無を調べれば画面更新の判定はできる
            header('Location: http://localhost/ECsite/shop/controllers/user.php?mode=show&user_id=' . $userId);
            break;
        }
        include_once '../views/edit.php';
        break;

    case 'register':
        include_once '../views/register.php';
        break;

    case 'insert':
        $userInfoErrors = $user->infoErrors($_POST);
        if (count($userInfoErrors) > 0) {
            include_once '../views/register.php';
            break;       
        }
        $userId = $user->insertInfo($_POST);
        header('Location: http://localhost/ECsite/shop/controllers/user.php?mode=show&user_id=' . $userId);
            break;

    default:
        include_once '../index.php';
        break;
}


// case 'register':
//     if ($user->validateUserInfo($_POST) === false) {
//         include_once '../views/edit.php';
//         break;
//     }
//
//     if ($user->register($_POST)) {
//         include_once '../views/register_complete.php';
//         break;
//     }
//     include_once '../views/edit.php';
//     break;
