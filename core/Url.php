<?php
  class Url {

    public static function post($key)
    {
      // Check if there is a post variable, return is this isset
      return (isset($_POST[$key])) ? $_POST[$key] : false;
    }

    public static function get($key)
    {
      // Check if there is a get variable, return is this isset
      return (isset($_GET[$key])) ? urldecode($_GET[$key]) : false;
    }

  }
