<section class="container  py-5">
    @include('section.heading')
    <p class="description">
        {{$description}}
    </p>
    <form method="POST" action="{{ route('request') }}" enctype="multipart/form-data">
        @csrf
        <div class="form-requestload">
            <div class="row">
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Full name</span>
                    <input name="full_name" type="text" class="form-control" placeholder="Full name"
                        aria-label="Full name">
                    @error('full_name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Phone number</span>
                    <input name="phone_number" type="text" class="form-control" placeholder="+639xxxxxxxx"
                        aria-label="Full name">
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Email</span>
                    <input name="email" type="email" class="form-control" placeholder="example@email.com"
                        aria-label="Email" onblur="checkEmail(this.value)">
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Payment method</span>
                    <select id="paymentTypes" name="payment_method" class="form-select"
                        aria-label="Select payment method" disabled>
                        @foreach ($paymentTypes as $type )
                        <option value="{{$type['value']}}">{{$type['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-sm-12 col-lg-6 input-text">
                    <span class="">Network</span>
                    <select id="networks" name="network" class="form-select" aria-label="Default select example">
                        <option value="">Select a network</option>
                        @foreach($networks as $network)
                        <option value="{{$network->id}}">{{$network->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div id="loadTypesContanier" class="col-sm-12 col-lg-6 input-text d-none">
                    <span class="">load type</span>
                    <select name="load_types" id="loadTypes" class="form-select" aria-label="Select load types">
                        <option value="">Select a load type</option>
                        @foreach ($loadTypes as $load)
                        <option value="{{$load['value']}}">{{$load['name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row mt-6">
                <div id="bestDealLabel" class="col form-label-text d-none">Best deals</div>
            </div>
            <div class="best-deals">
                <div id="packagesList" class="row mt-2 d-none">
                    @foreach ($packages as $plan)
                    <div class="col-sm-12 col-lg-4 mb-3 option-container">
                        <div class="form-check">
                            <label class="form-check-label option-block" for="plan{{$plan->id}}">
                                <input class="form-check-input" type="radio" name="load" id="plan{{$plan->id}}" value="{{$plan->id}}">
                                <span class="title">{{ $plan->name }}</span>
                                <span class="description">{{ $plan->description }}</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div id="amountsList" class="row mt-2 d-none">
                    @foreach ($amounts as $plan)
                    <div class="col-sm-12 col-lg-4 mb-3">
                        <div class="form-check">
                            <label class="form-check-label option-block" for="load{{$plan->id}}">
                                <input class="form-check-input" type="radio" name="load" id="load{{$plan->id}}" value="{{$plan->id}}">
                                <span class="amounts">₱{{ $plan->peso }} | ฿{{ $plan->baht }}</span>
                            </label>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="payment-options rounded border p-4">
                <div class="row">
                    <div class="col-12 col-lg-4">
                        <h6>Banks</h6>
                        <ul>
                            @foreach ($banks as $bank => $number )
                            <li>
                                {{$bank}} - {{$number}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-lg-4">
                        <h6>E-wallets</h6>
                        <ul>
                            @foreach ($eWallets as $wallet => $details)
                            <li>
                                Wallet: {{ $wallet }}
                                <ul>
                                    @foreach ($details as $key => $value)
                                    <li>{{ ucfirst($key) }}: {{ $value }}</li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-lg-4">
                        <h6>Others</h6>
                        <ul>
                            @foreach ($others as $method => $number)
                            <li>
                                {{ $method }} - {{ $number ?? 'N/A' }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="payment-options mt-4">
                    <div class="row">
                        <div class="col-12 col">
                            <h6>Note</h6>
                            <ul>
                                <li>If GCash is unavailable and payment is made at 7/11, kindly include an additional 2%
                                    to the total amount to cover associated fees, as this amount is deducted from my
                                    end. Thank you.</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 mt-3">
                <label for="formFile" class="form-label-text">Transaction Receipt</label>
                <input name="transaction_receipt" class="form-control " type="file" id="formFile">
            </div>

            <button type="submit" class="btn custom-btn gold mx-auto mt-5">Request load</button>
        </div>
    </form>
</section>

<script>
    let selectedNetwork = null;
    var appUrl = document.querySelector('meta[name="app-url"]').getAttribute('content');

    //get selected value of loadTypes
    document.getElementById('loadTypes').addEventListener('change', function(){
        document.getElementById('bestDealLabel').classList.remove('d-none');
        if(this.value === 'plan'){
            // show packages
            document.getElementById('packagesList').classList.remove('d-none');
            document.getElementById('amountsList').classList.add('d-none');
        }else{
            // show amounts
            document.getElementById('amountsList').classList.remove('d-none');
            document.getElementById('packagesList').classList.add('d-none');
        }
    });

    // get the value of network
    document.getElementById('networks').addEventListener('change', function(){
        selectedNetwork = this.value;
        if(this.value){
            // remove d-none to loadTypes
            if(this.value == 1){
                // show amounts
                document.getElementById('loadTypesContanier').classList.remove('d-none');
                hideOptions();
            }else{
                // show packages
                document.getElementById('loadTypesContanier').classList.add('d-none');
                //show amountsList
                document.getElementById('amountsList').classList.remove('d-none');
            }
            return;
        }
        // add disable to select load types
        document.getElementById('loadTypes').setAttribute('disabled', 'disabled');
        hideOptions();
    });
    function checkEmail(email){

        //ajax request to check email for /check-email parameter is email

        $.ajax({
            url: appUrl + '/check',
            method: 'POST',
            data: {
                email: email,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                //remove disable to select load types
                let isTrue = response.exist;
                document.getElementById('paymentTypes').removeAttribute('disabled');

                if(!isTrue){
                    return;
                }

                // pre select first option in paymentTypes and disable to second option
                document.getElementById('paymentTypes').selectedIndex = 1;
                document.getElementById('paymentTypes').options[1].setAttribute('disabled', 'disabled');
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error(textStatus, errorThrown);
            }
        });
    }

    function hideOptions(){
        //hide options
        document.getElementById('packagesList').classList.add('d-none');
        document.getElementById('amountsList').classList.add('d-none');
        document.getElementById('bestDealLabel').classList.add('d-none');
    }
</script>
