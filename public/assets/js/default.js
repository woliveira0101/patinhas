document.addEventListener('DOMContentLoaded', function() {
    // Função para mostrar o formulário de endereço
    function showAddressForm() {
        const addressFormContainer = document.getElementById('addressFormContainer');

        if (!document.getElementById('addressForm')) {
            fetch('/address/registration')
                .then(response => response.text())
                .then(data => {
                    addressFormContainer.innerHTML = data;
                });
        }
    }

    function deleteDonation(donationId) {
        if (confirm('Você tem certeza que deseja excluir esta doação?')) {
            fetch('/donation/delete/' + donationId, {
                method: 'DELETE'
            }).then(response => {
                if (response.ok) {
                    window.location.reload();
                } else {
                    response.json().then(data => {
                        alert('Erro ao excluir a doação: ' + data.status);
                    });
                }
            }).catch(error => {
                alert('Erro ao excluir a doação: ' + error);
            });
        }
    }
    
    // Função para visualizar prévias de imagens no formulário de doação
    const fotosPetInput = document.getElementById('fotosPet');
    if (fotosPetInput) {
        fotosPetInput.addEventListener('change', function() {
            const previewContainer = document.getElementById('imagePreview');
            if (previewContainer) {
                previewContainer.innerHTML = ''; // Limpar prévias anteriores
                Array.from(this.files).forEach(file => {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const colDiv = document.createElement('div');
                        colDiv.classList.add('col-3', 'mb-3');
                        const img = document.createElement('img');
                        img.src = e.target.result;
                        img.classList.add('img-thumbnail');
                        colDiv.appendChild(img);
                        previewContainer.appendChild(colDiv);
                    };
                    reader.readAsDataURL(file);
                });
            }
        });
    }

    // Função para lidar com o campo "Outra" nas necessidades especiais
    const outraCheckbox = document.getElementById('outra');
    if (outraCheckbox) {
        outraCheckbox.addEventListener('change', function() {
            const outrasNecessidades = document.getElementById('outrasNecessidades');
            if (outrasNecessidades) {
                outrasNecessidades.disabled = !this.checked;
                if (!this.checked) {
                    outrasNecessidades.value = ''; // Apagar o conteúdo se o checkbox for desmarcado
                }
            }
        });
    }

    // Função para submeter o formulário de doação
    const donationForm = document.getElementById('donationForm');
    if (donationForm) {
        donationForm.addEventListener('submit', function(event) {
            const checkboxes = document.querySelectorAll('input[name="necessidadesEspeciaisPet[]"]:checked');
            let necessidades = [];
            checkboxes.forEach((checkbox) => {
                if (checkbox.value !== 'Outra') {
                    necessidades.push(checkbox.value);
                }
            });
            const outrasNecessidades = document.getElementById('outrasNecessidades');
            if (outrasNecessidades && outrasNecessidades.value.trim()) {
                necessidades.push(outrasNecessidades.value.trim());
            }
            const necessidadesStr = necessidades.join(';');
            
            // Adicionar um campo hidden ao formulário com a string concatenada
            const necessidadesInput = document.createElement('input');
            necessidadesInput.type = 'hidden';
            necessidadesInput.name = 'special_care';
            necessidadesInput.value = necessidadesStr;
            this.appendChild(necessidadesInput);

            // Remover os campos de necessidades especiais e outras necessidades para evitar envio separado
            checkboxes.forEach((checkbox) => {
                checkbox.name = '';
            });
            if (outrasNecessidades) {
                outrasNecessidades.name = '';
            }
        });
    }

    // Função para cancelar adoção
    const cancelButtons = document.querySelectorAll('.btn-cancel-adoption');
    cancelButtons.forEach(button => {
        button.addEventListener('click', function() {
            const adoptionId = this.getAttribute('data-adoption-id');
            if (confirm('Tem certeza de que deseja cancelar esta adoção?')) {
                fetch(`/adoption/cancel/${adoptionId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload(); // Recarregar a página após o cancelamento
                    } else {
                        alert('Erro ao cancelar adoção.');
                    }
                });
            }
        });
    });

// Função para alterar a senha
const changePasswordForm = document.getElementById('changePasswordForm');
if (changePasswordForm) {
    changePasswordForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const currentPassword = document.getElementById('currentPassword').value;
        const newPassword = document.getElementById('newPassword').value;
        const confirmNewPassword = document.getElementById('confirmNewPassword').value;

        if (newPassword !== confirmNewPassword) {
            alert('As novas senhas não coincidem.');
            return;
        }

        fetch('/user/changepassword', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: `current_password=${encodeURIComponent(currentPassword)}&new_password=${encodeURIComponent(newPassword)}`
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Senha alterada com sucesso.');
                location.reload();
            } else {
                alert('Erro ao alterar a senha: ' + data.message);
            }
        }).catch(error => {
            alert('Erro ao alterar a senha: ' + error.message);
        });
    });
}
});
