<x-app-layout>
    <div id="isDashBoard" class="p-0 container-fluid">
        <div class="balance-section">
            <div class="switch-container">

            </div>
            <div class="balance-content">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt="">
                <span class="balance-text">
                    <span class="balance"><span id="balance" class="d-inline"></span> baht</span>
                    <span class="sub-text"><small>Current balance on wallet</small></span>
                </span>
            </div>
        </div>
    </div>
    <div class="container mt-2">
        <div class="gap-2 p-2 gap-md-3 row">
            <div class="p-0 col">
                <button class="tile-btn" onclick="openModal('topUpModal')">
                    <i class="fa-solid fa-circle-plus"></i> <span class="title">Top up</span>
                </button>
                </button>
            </div>
            <div class="p-0 col">
                <button class="tile-btn" onclick="openModal('loadSelf')">
                    <i class="fa-solid fa-sim-card"></i> <span class="title">Load self</span>
                </button>
            </div>
            <div class="p-0 col">
                <button class="tile-btn">
                    <i class="fa-solid fa-clock-rotate-left"></i> <span class="title">History</span>
                </button>
            </div>
        </div>
        <div class="mt-2 transaction-table">
            <div class="header-table">
                <div class="header-title">
                    <h2><i class="fa-solid fa-clock-rotate-left"></i> Transaction history</h2>
                    <a class="see-all-btn" href="">See all</a>
                </div>
            </div>
            <div id="historyTable" class="table-body-container">
                <div id="loader" class="loader-container d-none">
                    <div class="processing">
                        <div class="loader"></div>
                        <p>loading...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('components.topUpModal')
    @include('components.LoadSelfModal')
</x-app-layout>
