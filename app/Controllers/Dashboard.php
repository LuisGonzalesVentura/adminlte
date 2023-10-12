<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index(){
        $data["titulo"] = "Bienvenido al sitema";
        return view("Dashboard/index", $data);
    }
}