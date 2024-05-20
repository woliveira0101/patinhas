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
