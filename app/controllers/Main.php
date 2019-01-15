<?php

class Main {

    public function __construct()
    {
        $this->model = new Admin_model;
    }

    public function index()
    {
        $data["home"] = "MvZ PHP Framework";
        Load::view("main", $data);
    }

}
