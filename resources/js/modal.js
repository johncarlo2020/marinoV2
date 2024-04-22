const selectedPlan = document.getElementById('selectedPlan');


function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add('show');
}

function closeModal(id) {
    const modal = document.getElementById(id);
    modal.classList.remove('show');
}

function handleLoadTypeChange() {
    const amountAndPackage = document.getElementById('amountAndPackage');
    const planContainer = document.getElementById('planContainer');
    const packageContainer = document.getElementById('packageContainer');

    var loadType = document.getElementById('loadType');
    loadType.addEventListener('change', function() {
        selectedPlan.classList.add('d-none');
        if (loadType.value === 'amount') {
            amountAndPackage.classList.remove('d-none');
            planContainer.classList.remove('d-none');
            packageContainer.classList.add('d-none');
        } else if (loadType.value === 'package') {
            amountAndPackage.classList.remove('d-none');
            packageContainer.classList.remove('d-none');
            planContainer.classList.add('d-none');
        }else {
            amountAndPackage.classList.add('d-none');
            planContainer.classList.add('d-none');
            packageContainer.classList.add('d-none');
        }

    });
}

function handleRadioButtonClick(radioButton) {
    //get data set name
    var name = radioButton.getAttribute('data-name');
    console.log(name);
    //remove d-none class from selectedPlan
    selectedPlan.classList.remove('d-none');
    selectedPlan.innerHTML = name;
}

function getSelectedPaymentTypes() {
    const paymentTypes = document.getElementById('paymentTypes');
    const paymentOption = document.getElementById('paymentOption');
    paymentTypes.addEventListener('change', function() {
      if(!paymentTypes.value || paymentTypes.value === 'credit'){
        paymentOption.value = '';
        paymentOption.setAttribute('disabled', 'disabled');
        return;
        }

        const options = paymentOption.querySelectorAll('option');
        options.forEach(option => {
            if (option.dataset.type === paymentTypes.value || option.dataset.type === 'credit') {
                option.classList.remove('d-none');
            } else {
                option.classList.add('d-none');
            }
        });

        paymentOption.removeAttribute('disabled');
    });
}

function checkConfirmation(checkbox) {
    const nearestSubmitButton = checkbox.closest('form').querySelector('button[type="submit"]');
    if (checkbox.checked && nearestSubmitButton) {
        nearestSubmitButton.removeAttribute('disabled');
    } else {
        nearestSubmitButton.setAttribute('disabled', 'disabled');
    }
}

handleLoadTypeChange();
getSelectedPaymentTypes();

window.openModal = openModal;
window.closeModal = closeModal;
window.handleLoadTypeChange = handleLoadTypeChange;
window.handleRadioButtonClick = handleRadioButtonClick;
window.getSelectedPaymentTypes = getSelectedPaymentTypes;
window.checkConfirmation = checkConfirmation;
