import * as bootstrap from 'bootstrap';
const toast =  new bootstrap.Toast(document.querySelector('.toast'));

function showToast(title, message, icon, date) {
    const toastIcon = document.getElementById("toastIcon");
    const toastTitle = document.getElementById("toastTitle");
    const toastMessage = document.getElementById("toastMessage");
    const toastDate = document.getElementById("toastDate");
    toast._config.delay = 5000;

    toastTitle.innerHTML = title;
    toastMessage.innerHTML = message;
    toastDate.innerHTML = date;
    toast.show();
}

window.showToast = showToast;

