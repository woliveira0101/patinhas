<?php

namespace App\Controllers;

use App\Models\AdoptionModel;
use App\Models\QuestionAnswerModel;
use App\Models\FormQuestionModel;

class AdoptionController extends Controller
{
    private $adoptionModel;
    private $questionAnswerModel;
    private $formQuestionModel;

    public function __construct()
    {
        $this->adoptionModel = new AdoptionModel();
        $this->questionAnswerModel = new QuestionAnswerModel();
        $this->formQuestionModel = new FormQuestionModel();
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

    public function create($pet_id)
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $questions = $this->formQuestionModel->getAll();
        $this->view('adoptions/form_adocao', ['questions' => $questions, 'pet_id' => $pet_id]);
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (!$this->isLoggedIn()) {
                $this->redirect('/user/login');
            }

            $data = [
                'user_id' => $_SESSION['user_id'],
                'pet_id' => $_POST['pet_id'],
                'status' => 'pendente',
                'adoption_date' => date('Y-m-d H:i:s')
            ];

            $adoptionId = $this->adoptionModel->create($data);

            foreach ($_POST['answers'] as $questionId => $answerContent) {
                $this->questionAnswerModel->create([
                    'adoption_id' => $adoptionId,
                    'question_id' => $questionId,
                    'answer_content' => $answerContent
                ]);
            }

            $this->setFlash('success', 'Pedido de adoção enviado com sucesso!');
            $this->redirect('/admin/myadoptions');
        } else {
            $this->redirect('/pets');
        }
    }

    public function show($id)
    {
        if (!$this->isLoggedIn()) {
            $this->redirect('/user/login');
        }

        $adoption = $this->adoptionModel->getById($id, 'adoption_id');
        if ($adoption) {
            $this->view('adoptions/show', ['adoption' => $adoption]);
        } else {
            $this->setFlash('error', 'Pedido de adoção não encontrado.');
            $this->redirect('/admin/myadoptions');
        }
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
