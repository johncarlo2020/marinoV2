<x-app-layout>
    <div class="container pt-4">
        <div class="gap-4 d-flex justify-content-between">
            <button class="tile-btn">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt=""> <span class="title">Request funds</span>
            </button>
            <button class="tile-btn">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt=""> <span class="title">Request funds</span>
            </button>
            <button class="tile-btn">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt=""> <span class="title">Request funds</span>
            </button>
        </div>
        <div class="mt-3 transaction-table">
            <div class="header-table">
                <div class="header-title">
                    <h2><i class="fa-solid fa-clock-rotate-left"></i> Transaction history</h2>
                </div>
            </div>

        </div>
    </div>

</x-app-layout>
