<?php
  class Load {

    public static function view($view, $args = array())
    {
      // Extract all of the values inside the args array
      extract($args);

      // Explode the array by the comma
      $check = explode(",", $view);

      // Check if the second element isset
      if(!isset($check[1]))
      {
        $view .= ".php";
      }

      // Require the view with the template included
      require_once APP . "views/template/header.php";
      require_once APP . "views/" . $view;
      require_once APP . "views/template/footer.php";
    }

  }
