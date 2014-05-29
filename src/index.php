<?php
$APP_SETTING = array();
$APP_SETTING["header"] = "template/_header";
$APP_SETTING["footer"] = "template/_footer";
$APP_SETTING["default_view"] = "home";
$APP_SETTING["default_404_view"] = "include/404";

$GLOBALS['app_setting'] = $APP_SETTING;
/**
 * Write $APP_SETTING to GLOBAL Variable
 * TODO: Make APP_SETTING modifiable on runtime.
 * Is it a good idea?
 */

$view = (isset($_GET['view'])) ? $_GET['view'] : $GLOBALS['app_setting']["default_view"];

if (!file_exists('./view/' . $view . '.php') && !file_exists('./logic/' . $view . '.php')) {
    $view = $GLOBALS['app_setting']["default_404_view"];
}

session_start();

if (isset($_GET['logic']) && $view != '404') {
    includeLogic($view);
} else {
    includeView($view);
}

/* www.example.com/?view=home and www.example.com/?logic&view=submitForm */