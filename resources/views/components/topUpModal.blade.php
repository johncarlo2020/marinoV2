<div id="topUpModal" class="top-modal custom-modal">
    <div class="modal-head w-100">
        <button class="close-modal" onclick="closeModal('topUpModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="p-3 main-content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Amount</span>
                <input name="full_name" type="text" class="form-control" placeholder="input amount @example 1000"
                    aria-label="Full name" required>
            </div>
            <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Payment method</span>
                <select id="paymentTypes" name="payment_method" class="form-select"
                    aria-label="Select payment method"  required>
                    <option value="1">Paypal</option>
                </select>
            </div>
            <div class="mt-3 mb-3">
                <label for="formFile" class="form-label-text">Transaction Receipt</label>
                <input name="transaction_receipt" class="form-control " type="file" id="formFile" required>
            </div>
        </div>
        <div class="mt-6 send-request">
            <div class="col">
                <button class="py-2 btn btn-primary w-100">Send request <i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
