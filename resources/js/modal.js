import refresh from "./refresh";

const selectedPlan = document.getElementById("selectedPlan");
const loadType = document.getElementById("loadType");
const amountAndPackage = document.getElementById("amountAndPackage");
const planContainer = document.getElementById("planContainer");
const packageContainer = document.getElementById("packageContainer");

function openModal(id) {
    const modal = document.getElementById(id);
    modal.classList.add("show");
}

function closeModal(id) {
    //reset form
    const modal = document.getElementById(id);
    modal.classList.remove("show");
    const form = modal.querySelector("form");
    selectedPlan.classList.add("d-none");
    // find the type submit button and disable it
    const submitButton = form.querySelector('button[type="submit"]');
    submitButton.setAttribute("disabled", "disabled");
    //get all div that has a class of error-message and remove them
    const errorMessages = form.querySelectorAll(".error-message");
    errorMessages.forEach((error) => {
        error.remove();
    });
    form.reset();
}

function handleLoadTypeChange() {
    handleLoadTypeSelection(loadType.value);
    loadType.addEventListener("change", function () {
        handleLoadTypeSelection(loadType.value);
    });
}

function handleFileUpload() {
    const formFile = document.getElementById("formFile");
    const selectedFile = document.getElementById("selectedFile");

    //add event listener to add the file name to the selectedfile
    formFile.addEventListener("change", function () {
        console.log(formFile.files[0].name);
        selectedFile.textContent = formFile.files[0].name;
    });
}

function handleLoadTypeSelection(value) {
    selectedPlan.classList.add("d-none");
    if (value === "amount") {
        amountAndPackage.classList.remove("d-none");
        planContainer.classList.remove("d-none");
        packageContainer.classList.add("d-none");
    } else if (value === "package") {
        amountAndPackage.classList.remove("d-none");
        packageContainer.classList.remove("d-none");
        planContainer.classList.add("d-none");
    } else {
        amountAndPackage.classList.add("d-none");
        planContainer.classList.add("d-none");
        packageContainer.classList.add("d-none");
    }
}

function handleRadioButtonClick(radioButton) {
    //get data set name
    var name = radioButton.getAttribute("data-name");
    //remove d-none class from selectedPlan
    selectedPlan.classList.remove("d-none");
    selectedPlan.innerHTML = name;
}

function getSelectedPaymentTypes() {
    const paymentTypes = document.getElementById("paymentTypes");
    const paymentOption = document.getElementById("paymentOption");
    const mediaInputContainer = document.getElementById("mediaInputContainer");

    paymentTypes.addEventListener("change", function () {
        if (!paymentTypes.value || paymentTypes.value === "credit") {
            paymentOption.value = "";
            paymentOption.setAttribute("disabled", "disabled");
            mediaInputContainer.classList.add("d-none");
            return;
        }

        const options = paymentOption.querySelectorAll("option");
        options.forEach((option) => {
            if (
                option.dataset.type === paymentTypes.value ||
                option.dataset.type === "credit"
            ) {
                option.classList.remove("d-none");
            } else {
                option.classList.add("d-none");
            }
        });
        mediaInputContainer.classList.remove("d-none");
        paymentOption.removeAttribute("disabled");
    });
}

function checkConfirmation(checkbox) {
    const nearestSubmitButton = checkbox
        .closest("form")
        .querySelector('button[type="submit"]');
    if (checkbox.checked && nearestSubmitButton) {
        nearestSubmitButton.removeAttribute("disabled");
    } else {
        nearestSubmitButton.setAttribute("disabled", "disabled");
    }
}

function handleInputTypes(inputName, type, form) {
    var selectedElement = null;
    var elementType = type === "select" ? "select" : "input";
    selectedElement = form.querySelector(`${elementType}[name="${inputName}"]`);
    return selectedElement;
}

function displayError(message, inputName, type, form, bottom = false) {
    const selectedElement = handleInputTypes(inputName, type, form);
    const existingError = selectedElement
        .closest(".input-text")
        .querySelector(".error-message");

    if (existingError) {
        existingError.remove();
    }

    addErrorContainer(selectedElement, message, bottom);
}

function addErrorContainer(selectedElement, message, bottom) {
    const parentElement = selectedElement.closest(".input-text");
    const errorContainer = document.createElement("div");
    errorContainer.classList.add("error-message");
    const errorMessage = document.createElement("span");
    errorMessage.classList.add("text-danger");
    errorMessage.textContent = message;
    errorContainer.appendChild(errorMessage);

    // Find the next sibling element
    const nextElement = selectedElement.nextSibling;

    // Insert the errorContainer before the next sibling element
    if (nextElement && !bottom) {
        parentElement.insertBefore(errorContainer, nextElement);
    } else {
        // If there is no next sibling, append the errorContainer at the end
        parentElement.appendChild(errorContainer);
    }
}

function removeErrorContainer(selectedElement) {
    const errorContainer = selectedElement
        .closest(".input-text")
        .querySelector(".error-message");
    if (errorContainer) {
        errorContainer.remove();
    }
}

function handleTopUpFormSubmit(event) {
    addNumberValidation("topUpAmount", "amount");
    document
        .getElementById("topupForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();
            var formData = new FormData(this);
            const payment_method = formData.get("payment_method");
            const formFile = document.getElementById("formFile");

            //if payment method is credit and no file is uploaded display error unless proceed
            if (payment_method !== "credit") {
                if (
                    formFile.files.length === 0 ||
                    formFile.files[0] === undefined
                ) {
                    displayError(
                        "Please upload a proof of payment",
                        "transaction_receipt",
                        "file",
                        this,
                        true
                    );
                    return;
                }
            }
            handleTopUpFormRequest(formData);
        });
}

function handleTopUpFormRequest(formData) {
    $.ajax({
        url: "topup",
        type: "POST",
        data: formData,
        processData: false, // Prevent jQuery from automatically transforming the data into a query string
        contentType: false, // Set contentType to false, as FormData already encodes the data
        success: function (response) {
            const { message, date } = response;
            const convertedDate = new Date(date).toLocaleDateString();
            closeModal("topUpModal");
            showToast(
                message,
                "Your request has been successfully submitted",
                "test",
                convertedDate
            );

            refresh();
        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
        },
    });
}

function handleNetworkChange() {
    const network = document.getElementById("networkType");
    const packageType = document.getElementById("packageType");

    isLoadtypeDisable(network.value);

    network.addEventListener("change", function () {
        isLoadtypeDisable(network.value);
    });
}

function isLoadtypeDisable(id) {
    if (id === "1") {
        loadType.removeAttribute("disabled");
        handleLoadTypeSelection(loadType.value);
        return;
    }
    loadType.value = "amount";
    loadType.disabled = "disabled";
    handleLoadTypeSelection(loadType.value);
}

function addNumbereOfUser() {
    const personalNumber = document.getElementById("personalNumber");
    const number = document.getElementById("number");

    //add event listener to personal number checkbox and log the checked state
    personalNumber.addEventListener("change", function () {
        if (!this.checked) {
            number.value = null;
            return;
        }
        number.value = personalNumber.dataset.number;
    });
}

function loadSubmit(formData) {
    const form = document.getElementById("loadForm");
    form.classList.add("d-none");
    const loader = document.getElementById("loader");
    loader.classList.remove("d-none");

    //ajax request
    $.ajax({
        url: "loadNow",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {

            loader.classList.add("d-none");
            form.classList.remove("d-none");
            if(response.status == 'success')
            {
                closeModal("loadSelf");

                const { message, date } = response;

                showToast(
                    message,
                    "Your load request has been successfully submitted",
                    response.message.status,
                    date
                );
            }else if(response.status =='error'){

                const { message, date } = response;

                showToast(
                    message,
                    response.message,
                    "Failed",
                    date
                );
            }

            refresh();

        },
        error: function (xhr, status, error) {
            console.error("AJAX request failed:", error);
            loader.classList.add("d-none");
            form.classList.remove("d-none");

            showToast(
                message,
                "Your load request has been unsuccessful",
                "test",
                date
            );
        },
    });
}

function addNumberValidation(id, name) {
    const input = document.getElementById(id);

    //add event listener on key up only allow numbers , + and - log error if not
    input.addEventListener("keyup", function (event) {
        const value = event.target.value;
        const regex = /^[0-9+-]+$/;
        if (!regex.test(value)) {
            displayError(
                "Please enter a valid number",
                name,
                "text",
                input.closest("form")
            );
        } else {
            removeErrorContainer(input);
        }
    });
}

function addQuickAmount(radio) {
    const topUpAmount = document.getElementById("topUpAmount");
    const amount = radio.value;

    topUpAmount.value = amount;
}

function handleLoadSubmit(event) {
    const validation = [
        { name: "number", type: "text", number: true, required: true },
        { name: "payment_method", type: "select" },
        { name: "amount", type: "radio" },
        { name: "package", type: "radio" },
    ];

    addNumberValidation("number", "number");

    document
        .getElementById("loadForm")
        .addEventListener("submit", function (event) {
            event.preventDefault();
            const loadOption = ["amount", "plan"];
            const form = this;

            var formData = new FormData(this);
            var number = formData.get("number");
            var payment_method = formData.get("payment_method");

            var selectedLoad =
                payment_method === "amount" ? loadOption[0] : loadOption[1];

            var load = formData.get(selectedLoad);

            validation.forEach((element) => {
                if (!formData.get(element.name)) {
                    if (element.name === loadType.value) {
                        displayError(
                            "Please select an option",
                            element.name,
                            element.type,
                            form
                        );
                        return;
                    }

                    if (element.name === "number" && !number) {
                        displayError(
                            "Please enter a valid number",
                            element.name,
                            element.type,
                            form
                        );
                        return;
                    }

                    removeErrorContainer(
                        handleInputTypes(element.name, element.type, form)
                    );
                }
            });

            loadSubmit(formData);
        });
}

const isDashBoard = document.getElementById("isDashBoard");

// only call if dashboard
if (isDashBoard) {
    refresh();
    handleLoadTypeChange();
    getSelectedPaymentTypes();
    handleTopUpFormSubmit();
    handleLoadSubmit();
    handleNetworkChange();
    addNumbereOfUser();
    handleFileUpload();

}

window.openModal = openModal;
window.closeModal = closeModal;
window.handleLoadTypeChange = handleLoadTypeChange;
window.handleRadioButtonClick = handleRadioButtonClick;
window.getSelectedPaymentTypes = getSelectedPaymentTypes;
window.checkConfirmation = checkConfirmation;
window.handleTopUpFormSubmit = handleTopUpFormSubmit;
window.handleLoadSubmit = handleLoadSubmit;
window.handleNetworkChange = handleNetworkChange;
window.isLoadtypeDisable = isLoadtypeDisable;
window.displayError = displayError;
window.addNumbereOfUser = addNumbereOfUser;
window.addErrorContainer = addErrorContainer;
window.addNumberValidation = addNumberValidation;
window.removeErrorContainer = removeErrorContainer;
window.addQuickAmount = addQuickAmount;
window.handleFileUpload = handleFileUpload;
window.handleTopUpFormRequest = handleTopUpFormRequest;
