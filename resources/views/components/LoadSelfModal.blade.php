<div id="loadSelf" class="top-modal custom-modal">
    <div class="modal-head w-100">
       <p><i class="fa-solid fa-sim-card"></i> New load</p> <button class="close-modal" onclick="closeModal('loadSelf')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="p-3 main-content">
        <div class="row">
            <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Network</span>
                <select id="networkType" name="payment_method" class="form-select"
                    aria-label="Select payment method"  required>
                     @foreach ($networks as $network)
                        <option value="{{$network->id}}">{{$network->name}}</option>
                        
                    @endforeach
                </select>
            </div>
            <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Sim number #</span>
                <input name="full_name" type="text" class="form-control" placeholder="Example : +6390000000"
                    aria-label="Full name" required>
            </div>
            {{-- <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Payment method</span>
                <select id="paymentTypes" name="payment_method" class="form-select"
                    aria-label="Select payment method"  required>
                    <option value="1">Paypal</option>
                </select>
            </div> --}}
            <div class="col-sm-12 col-lg-6 input-text">
                <span class="">Load type</span>
                <select id="loadType" name="payment_method" class="form-select"
                    aria-label="Select payment method"  required>
                    <option value="">Select type</option>
                    <option value="amount">Amount</option>
                    <option value="package">Plan</option>
                </select>
            </div>
            <div id="amountAndPackage" class="col-12 input-text d-none">
                <span class="plans-heading d-none"><span>Plans</span><span id="selectedPlan" class="selected-value"></span></span>
                <div id="planContainer" class="plans d-none">
                   @foreach ($amounts as $amount)
                    <div class="plan">
                        <input type="radio" id="plan{{$amount->id}}" name="amount" value="{{$amount->id}}" data-name="P{{$amount->peso}} | B{{$amount->baht}}" onclick="handleRadioButtonClick(this)">
                        <label class="amount-btn" for="plan{{$amount->id}}">P{{$amount->peso}} | B{{$amount->baht}}</label>
                    </div>
                   @endforeach
                    
                </div>
                <div id="packageContainer" class="plans package-plans d-none">
                @foreach ($packages as $package)
                    <div class="plan">
                        <input type="radio" id="package{{$package->id}}" name="plan" data-name="{{$package->name}}" value="{{$package->id}}" onclick="handleRadioButtonClick(this)">
                        <label class="amount-btn package" for="package{{$package->id}}">
                            <span class="package-name">{{$package->name}}</span>
                            <span class="description">{{$package->description}}</span>
                        </label>
                    </div>
                @endforeach
                    
                </div>
            </div>
        </div>
        <div class="mt-6 col-12 input-text confirm-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
              I confirm that the information provided is accurate
            </label>
        </div>
        <div class="mt-3 send-request">
            <div class="col">
                <button class="py-2 btn btn-primary w-100">Load Now <i class="fa-solid fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
