<?php
  spl_autoload_register(function($class)
  {

    if(file_exists(CORE . $class . ".php"))
    {
      require_once CORE . $class . ".php";
    }
    elseif(file_exists(APP . "controllers/" . $class . ".php"))
    {
      require_once(APP . "controllers/" . $class . ".php");
    }
    elseif(file_exists(APP . "models/" . $class . ".php"))
    {
      require_once(APP . "models/" . $class . ".php");
    }

  });
