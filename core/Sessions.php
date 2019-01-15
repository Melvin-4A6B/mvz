<?php
  class Session {

    public function __construct()
    {
      // Check if a session is already started
      if(!isset($_SESSION))
      {
        // If not, start it
        session_start();
      }

      // Loop through all cookies
      foreach($_COOKIE as $key => $value)
      {

        // Check if the session has a key
        if(!isset($_SESSION[$key]))
        {

          // Decode the cookie value
          json_decode($value);

          // Check if there is no error
          if(json_last_error() == JSON_ERROR_NONE)
          {
            // Set the session key equal to the decoded value
            $_SESSION[$key] = json_decode($value);
          }
          else
          {
            // Set the session key equal to the normal value
            $_SESSION[$key] = $value;
          }

        }

      }

    }

    public static function get($key)
    {

      if(isset($_SESSION[Session::generateSessionKey($key)]))
      {
        return $_SESSION[Session::generateSessionKey($key)];
      }
      else
      {
        return false;
      }

    }

    public static function set($key, $value, $ttl = 0)
    {

      $_SESSION[Session::generateSessionKey($key)] = $value;

      if($ttl !== 0)
      {

        if(is_object($value) || is_array($value))
        {
          $value = json_encode($value);
        }

        setcookie(Session::generateSessionKey($key), $value, (time() + $ttl), "/", $_SERVER["HTTP_HOST"]);
      }

    }

    public static function kill($key)
    {

      if(isset($_SESSION[Session::generateSessionKey[$key]]))
      {
        unset($_SESSION[Session::generateSessionKey[$key]]);
      }

      if(isset($_COOKIE[Session::generateSessionKey[$key]]))
      {
        setcookie(Session::generateSessionKey($key), "", (time() - 5000), "/", $_SERVER["HTTP_HOST"]);
      }

    }

    public static function endSession()
    {

      foreach($_SESSION as $key => $value)
      {
        unset($_SESSION[$key]);
      }

      foreach($_COOKIE as $key => $value)
      {
        setcookie($key, "", (time() - 5000), "/", $_SERVER["HTTP_HOST"]);
      }

      session_destroy();
    }

    public static function generateSessionKey($key)
    {

      $append = $GLOBALS["config"]["appName"];
      $version = $GLOBALS["config"]["version"];

      return md5($key.$append.$version);
    }

  }
