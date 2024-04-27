<div id="loadSelf" class="top-modal custom-modal">
    <div class="modal-head w-100">
        <p><i class="fa-solid fa-sim-card"></i> New load</p> <button class="close-modal"
            onclick="closeModal('loadSelf')"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="p-3 main-content">
        <form id="loadForm">
            <div class="row">
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Network</span>
                    <select id="networkType" name="network" class="form-select" aria-label="Select payment method"
                        required>
                        @foreach ($networks as $network)
                        <option value="{{$network->id}}">{{$network->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="plans-heading"><span class="p-0 d-block">Sim number #</span>
                        <div class="mb-1 personal-number">
                            <input type="checkbox" data-number="{{$number}}" class="btn-check" id="personalNumber"
                                autocomplete="off">
                            <label class="number-pill" for="personalNumber">{{$number}}</label>
                        </div>
                    </span>
                    <input id="number" name="number" type="text" class="form-control"
                        placeholder="Example : +6390000000" aria-label="number">
                </div>

                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Load type</span>
                    <select id="loadType" name="payment_method" class="form-select" aria-label="Select payment method"
                        required>
                        <option value="amount">Amount</option>
                        <option value="package">Plan</option>
                    </select>
                </div>
                <div id="amountAndPackage" class="col-12 input-text d-none">
                    <span class="plans-heading d-none"><span>Plans</span><span id="selectedPlan"
                            class="selected-value"></span></span>
                    <div id="planContainer" class="plans d-none">
                        @foreach ($amounts as $amount)
                        <div class="plan">
                            <input type="radio" id="plan{{$amount->id}}" name="amount" value="{{$amount->id}}"
                                data-name="P{{$amount->peso}} | B{{$amount->baht}}"
                                onclick="handleRadioButtonClick(this)">
                            <label class="amount-btn" for="plan{{$amount->id}}">
                                <span class="p-0 m-0">
                                    P{{$amount->peso}} | B{{$amount->baht}}
                                </span>
                            </label>
                        </div>
                        @endforeach

                    </div>
                    <div id="packageContainer" class="plans package-plans d-none">
                        @foreach ($packages as $package)
                        <div class="plan">
                            <input type="radio" id="package{{$package->id}}" name="package"
                                data-name="{{$package->name}}" value="{{$package->id}}"
                                onclick="handleRadioButtonClick(this)">
                            <label class="amount-btn package" for="package{{$package->id}}">
                                <span class="p-0 m-0 package-name">{{$package->name}}</span>
                                <span class="p-0 m-0 description">{{$package->description}}</span>
                            </label>
                        </div>
                        @endforeach

                    </div>
                </div>
                <div class="col-12 input-text">
                    <p class="small-text"><span class="text-bold">Note:</span> <span class="pl-2">Your current balance is {{ Auth::user()->balance }} some plans will not be available for you top up your ballance to avail more products</span></p>
                </div>
            </div>
            <div class="mt-6 col-12 input-text confirm-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault"
                    onclick="checkConfirmation(this)">
                <label class="form-check-label" for="flexCheckDefault">
                    <i class="fa-solid fa-circle-info"></i> I confirm that the information provided is accurate
                </label>
            </div>
            <div class="mt-3 send-request">
                <div class="col">
                    <button type="submit" disabled class="py-2 btn btn-primary w-100">Load Now <i
                            class="fa-solid fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>
</div>
