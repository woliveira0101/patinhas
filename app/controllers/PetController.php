<?php

namespace App\Controllers;

use App\Models\PetModel;


class PetController extends Controller
{
    private $petModel;

    public function __construct()
    {
        $this->petModel = new PetModel();
    }

    public function index()
    {
    $filters = $_GET ?? [];
    $pets = $this->petModel->getFilteredPets($filters);
    $this->view('pets/index', ['pets' => $pets]);

    }

    public function show($id)
    {
        $pet = $this->petModel->getById($id, 'pet_id');
        $this->view('pets/show', ['pet' => $pet]);
    }

    public function create()
    {
        // Implementar lógica para exibir o formulário de criação de pet
        // Exemplo: include_once __DIR__ . '/../views/pets/create.php';
    }

    public function store($data)
    {
        $this->petModel->create($data);
        header('Location: /pets');
        exit();
    }

    public function edit($id)
    {
        $pet = $this->petModel->getById($id);
    }

    public function update($id, $data)
    {
        $this->petModel->update($id, $data);
        header('Location: /pets');
        exit();
    }

    public function delete($id)
    {
        $this->petModel->delete($id);
        header('Location: /pets');
        exit();
    }
}
