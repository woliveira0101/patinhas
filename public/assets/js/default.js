document.addEventListener('DOMContentLoaded', function() {
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

    document.getElementById('fotosPet').addEventListener('change', function() {
        const previewContainer = document.getElementById('imagePreview');
        previewContainer.innerHTML = ''; // Clear previous previews
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
    });
    
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
            
            // Adicione um campo hidden ao formulário com a string concatenada
            const necessidadesInput = document.createElement('input');
            necessidadesInput.type = 'hidden';
            necessidadesInput.name = 'special_care';
            necessidadesInput.value = necessidadesStr;
            this.appendChild(necessidadesInput);

            // Remova os campos de necessidades especiais e outras necessidades para evitar envio separado
            checkboxes.forEach((checkbox) => {
                checkbox.name = '';
            });
            if (outrasNecessidades) {
                outrasNecessidades.name = '';
            }
        });
    }
});
