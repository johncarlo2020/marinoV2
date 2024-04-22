<div id="topUpModal" class="top-modal custom-modal">
    <div class="modal-head w-100">
        <p><i class="fa-solid fa-circle-plus"></i> New top up</p> <button class="close-modal"
            onclick="closeModal('topUpModal')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="p-3 main-content">
        <form action="">
            <div class="row">
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Amount</span>
                    <input name="full_name" type="text" class="form-control"
                        placeholder="Please note that the currency is on THB  ฿" aria-label="Full name" required>
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Payment method</span>
                    <select id="paymentTypes" name="payment_method" class="form-select"
                        aria-label="Select payment method" required>
                        <option disabled value="">Choose payment method</option>
                        <option value="credit">Credit</option>
                        <option value="Bank">Bank</option>
                        <option value="Gcash">Gcash</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Mode payment</span>
                    <select id="paymentOption" name="payment_method" class="form-select"
                        aria-label="Select payment method" required disabled>
                        <option value="">Select payment option</option>
                        @foreach($mops as $mop)
                        <option data-type="{{ $mop->type }}" class="d-none" value="{{ $mop->id }}">
                            <p>
                                <span class="text-bold">{{ $mop->name }}</span> <span class="text-grey">{{ $mop->number
                                    }}</span>
                            </p>
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 input-text">
                    <p class="small-text"><span class="text-bold">Note:</span> <span class="pl-2">If GCash is
                            unavailable and payment is made at 7/11, kindly include an additional 2% to the total amount
                            to cover associated fees, as this amount is deducted from my end. Thank you.</span></p>
                </div>
                <div class="mt-2 mb-3">
                    <label for="formFile" class="form-label-text">Transaction Receipt</label>
                    <input name="transaction_receipt" class="form-control " type="file" id="formFile" required>
                </div>
            </div>

            <div class="mt-6 col-12 input-text confirm-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault" onclick="checkConfirmation(this)">
                <label class="form-check-label" for="flexCheckDefault">
                    I confirm that the information provided is accurate
                </label>
            </div>
            <div class="mt-3 send-request">
                <div class="col">
                    <button disabled type="submit" class="py-2 btn btn-primary w-100">Send request <i
                        class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
