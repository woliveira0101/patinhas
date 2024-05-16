<?php

require_once __DIR__ . '/../models/PetModel.php';

class PetController extends Controller
{
    private $petModel;

    public function __construct()
    {
        $this->petModel = new PetModel();
    }

    public function index()
    {
        // Implementar lógica para exibir todos os pets
        $pets = $this->petModel->getAllPets();
        // Exemplo: include_once __DIR__ . '/../views/pets/index.php';
    }

    public function show($id)
    {
        // Implementar lógica para exibir um pet específico
        $pet = $this->petModel->getPetById($id);
        // Exemplo: include_once __DIR__ . '/../views/pets/show.php';
    }

    public function create()
    {
        // Implementar lógica para exibir o formulário de criação de pet
        // Exemplo: include_once __DIR__ . '/../views/pets/create.php';
    }

    public function store($data)
    {
        // Implementar lógica para armazenar um novo pet no banco de dados
        $this->petModel->createPet($data);
        // Redirecionar para a página de listagem de pets após a criação
        header('Location: /pets');
        exit();
    }

    public function edit($id)
    {
        // Implementar lógica para exibir o formulário de edição de pet
        $pet = $this->petModel->getPetById($id);
        // Exemplo: include_once __DIR__ . '/../views/pets/edit.php';
    }

    public function update($id, $data)
    {
        // Implementar lógica para atualizar um pet no banco de dados
        $this->petModel->updatePet($id, $data);
        // Redirecionar para a página de listagem de pets após a atualização
        header('Location: /pets');
        exit();
    }

    public function delete($id)
    {
        // Implementar lógica para excluir um pet do banco de dados
        $this->petModel->deletePet($id);
        // Redirecionar para a página de listagem de pets após a exclusão
        header('Location: /pets');
        exit();
    }
}
