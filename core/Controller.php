<?php
  class Controller {

      public function debug($data)
      {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        exit();
      }

      public function sanitize($data)
      {
          $data = trim($data);
          $data = stripslashes($data);
          $data = htmlspecialchars($data);

          return $data;
      }

      public function redirect($location)
      {
          header("Location: " . ROOT . $location);
          exit();
      }

  }
