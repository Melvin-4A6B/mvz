<?php
require_once("config.php");

define("TITLE", $GLOBALS["config"]["appName"]);
define("AUTHOR", $GLOBALS["config"]["author"]);
define("ROOT", $GLOBALS["config"]["path"]["root"]);
define("APP", $GLOBALS["config"]["path"]["app"]);
define("CORE", $GLOBALS["config"]["path"]["core"]);
define("CONTROLLER", $GLOBALS["config"]["default"]["controller"]);
define("METHOD", $GLOBALS["config"]["default"]["method"]);
define("HOST", $GLOBALS["config"]["database"]["host"]);
define("DB", $GLOBALS["config"]["database"]["name"]);
define("USER", $GLOBALS["config"]["database"]["username"]);
define("PASS", $GLOBALS["config"]["database"]["password"]);
define("DSN", "mysql:host=" . HOST . ";dbname=" . DB);
