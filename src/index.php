<?php
    $APP_SETTING = array();
    $APP_SETTING["header"] = "include/_header";
    $APP_SETTING["footer"] = "include/_footer";
    $APP_SETTING["default_view"] = "home";
    $APP_SETTING["default_404_view"] = "404";

    $view = "";

    if(isset($_GET['view'])){
        $view = $_GET['view'];
    } else {
        $view = $APP_SETTING["default_view"];
    }

    if(!file_exists('./view/'.$view.'.php' ) && !file_exists('./logic/'.$view.'.php')){
        $view = $APP_SETTING["default_404_view"];
    }

    session_start();
    if(file_exists("lastdb.txt")){
        $fh = fopen("lastdb.txt", 'r');
        $_SESSION['dblink'] = fread($fh, filesize('lastdb.txt'));
        fclose($fh);
    }
    include_once 'connect.php';
    include_once 'class/status.php';
    include_once 'class/db_handler.php';
    /*
     * Check Session of Current Database
     */
    $DB = new db_handler();
    if(isset($_SESSION['dblink']) && $_SESSION['dblink']!= ''){
        //create new link to database
        $DB = new db_handler($_SESSION['dblink']);
        if(!$DB->isValid()){
            $DB = NULL;
            $_SESSION['dblink'] = NULL;
            $_SESSION['sessionrunning'] = NULL;

        } else {
            if($DB->sessionrunning != 0){
                $_SESSION['sessionrunning'] = $DB->sessionrunning;
            } else if($DB->sessionrunning == 0) {
                unset($_SESSION['sessionrunning']);
            }
        }
    }
    if(isset($_GET['logic']) && $view != '404'){
        include './logic/'.$view.'.php';
    } else {
        include './view/'.$APP_SETTING["header"].'.php';
        include './view/'.$view.'.php';
        include './view/'.$APP_SETTING["footer"].'.php';
    }
    /* www.example.com/?view=home and www.example.com/?logic&view=submitForm */