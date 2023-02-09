<?php

use lib\BaseController;

class HomeController extends BaseController
{
public function __construct()
{
    session_start();

    $this->Auth($this->getRedirectLogin());
}

# mostrar la vista de Dashboard

public function index()
{

    $this->view_("Home/DashboardView.php");
}
}