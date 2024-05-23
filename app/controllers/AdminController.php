<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DonationModel;
use App\Models\AdoptionModel;

class AdminController extends Controller {
    
    public function dashboard() {
        // Renderizar a view do dashboard
        $this->view('admin/dashboard');
    }

    public function myDonations() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $donationModel = new DonationModel();
        $donations = $donationModel->getByUserId($userId);

        $this->view('admin/mydonations', ['donations' => $donations]);
    }

    public function myAdoptions() {
        if (!isset($_SESSION['user_id'])) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $adoptionModel = new AdoptionModel();
        $adoptions = $adoptionModel->getByUserId($userId);

        $this->view('admin/myadoptions', ['adoptions' => $adoptions]);
    }

}
