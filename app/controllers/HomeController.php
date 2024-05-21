<?php

namespace App\Controllers;

use App\Models\PetModel;

class HomeController extends Controller {
    private $petModel;

    public function __construct()
    {
        $this->petModel = new PetModel();
    }


    public function index() {
        $pets = $this->petModel->getAllPets();
        $this->view('home/index', ['pets' => $pets]);
    }
}