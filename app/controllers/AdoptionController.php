<?php

namespace App\Controllers;

use App\Models\AdoptionModel;
use App\Models\QuestionModel;
use App\Models\PetModel;

class AdoptionController extends Controller
{
    private $adoptionModel;
    private $questionModel;
    private $petModel;

    public function __construct()
    {
        $this->adoptionModel = new AdoptionModel();
        $this->questionModel = new QuestionModel();
        $this->petModel = new PetModel();
    }

    public function index()
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $userId = $_SESSION['user_id'];
        $adoptions = $this->adoptionModel->getByUserId($userId);
        $this->view('admin/myadoptions', ['adoptions' => $adoptions]);
    }

    public function request($pet_id)
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $questions = $this->questionModel->getAllActiveQuestions();
        $this->view('adoptions/request', ['questions' => $questions, 'pet_id' => $pet_id]);
    }

    public function store()
    {
        // Recupera o pet_id do formulário
        $pet_id = $_POST['pet_id'];
    
        $data = [
            'user_id' => $_SESSION['user_id'],
            'pet_id' => $pet_id,
            'status' => 'em analise',
            'answers' => $_POST['answers']
        ];
    
        $adoptionId = $this->adoptionModel->request($data);
    
        // Redireciona para a página de sucesso ou outra página adequada
        header('Location: /adoption/success');
        exit();
    }

    public function success()
    {
        $this->view('adoptions/success');
    }

    public function show($id)
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $adoption = $this->adoptionModel->getById($id, 'adoption_id');

        if (!$adoption) {
            $this->view('errors/404');
            return;
        }

        $pet = $this->petModel->getById($adoption['pet_id']);
        $answers = $this->adoptionModel->getAnswersByAdoptionId($id);
    
        $this->view('adoptions/show', [
            'adoption' => $adoption,
            'pet' => $pet,
            'answers' => $answers
        ]);
    }

    public function myAdoptions() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header('Location: /user/login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $adoptions = $this->adoptionModel->getByUserId($userId);
        
        $this->view('admin/myadoptions', ['adoptions' => $adoptions]);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->isLoggedIn()) {
                $this->redirect('/user/login');
            }

            $data = [
                'status' => $_POST['status'],
                'updated_at' => date('Y-m-d H:i:s')
            ];

            if ($this->adoptionModel->update($id, $data, 'adoption_id')) {
                $this->setFlash('success', 'Pedido de adoção atualizado com sucesso!');
            } else {
                $this->setFlash('error', 'Erro ao atualizar pedido de adoção.');
            }

            $this->redirect('/admin/myadoptions');
        } else {
            $this->redirect('/admin/myadoptions');
        }
    }

    public function updateStatus() {
        $adoption_id = $_POST['adoption_id'];
        $status = $_POST['status'];

        if ($this->adoptionModel->updateStatus($adoption_id, $status)) {
            // Redirecionar para uma página de sucesso ou mostrar uma mensagem
            // header('Location: /adoption/success');
            $this->setFlash('success', 'Pedido de adoção atualizado com sucesso!');
        } else {
            // Redirecionar para uma página de erro ou mostrar uma mensagem
            // header('Location: /adoption/error');
            $this->setFlash('error', 'Erro ao atualizar pedido de adoção.');
        }
    }

    public function cancel($id)
{
    $this->adoptionModel->updateStatus($id, 'cancelado');
    echo json_encode(['success' => true]);
}

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->isLoggedIn()) {
                $this->redirect('/user/login');
            }

            if ($this->adoptionModel->delete($id, 'adoption_id')) {
                $this->setFlash('success', 'Pedido de adoção excluído com sucesso!');
            } else {
                $this->setFlash('error', 'Erro ao excluir pedido de adoção.');
            }

            $this->redirect('/admin/myadoptions');
        }
    }
}
