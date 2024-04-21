<x-app-layout>
    <div class="p-0 container-fluid">
        <div class="balance-section">
            <div class="switch-container">

            </div>
            <div class="balance-content">
                <img src="{{ asset('images/icons/solar_wallet-bold.svg')}}" alt="">
                <span class="balance-text">
                    <span class="balance">{{ Auth::user()->balance }} baht</span>
                    <span class="sub-text"><small>Current balance on wallet</small></span>
                </span>
            </div>
        </div>
    </div>
    
    <div class="container mt-2">
        <div class="gap-2 p-2 row">
            <div class="p-0 col">
                <button class="tile-btn" onclick="openModal('topUpModal')">
                    <i class="fa-solid fa-circle-plus"></i> <span class="title">Top up</span>
                </button>
                </button>
            </div>
            <div class="p-0 col">
                <button class="tile-btn">
                    <i class="fa-solid fa-sim-card"></i> <span class="title">Load self</span>
                </button>
            </div>
            <div class="p-0 col">
                <button class="tile-btn">
                    <i class="fa-solid fa-file-circle-plus"></i></i> <span class="title">New load</span>
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
            <div class="table-row-container">
                <div class="details">
                    <div class="type">
                        <i class="fa-solid fa-plus"></i>
                    </div>
                    <div class="text">
                        <span>
                            Top up
                        </span>
                        <span class="date d-block">
                            December 12, 2021
                        </span>
                    </div>
                </div>
                <div class="amount-row">
                    <span>-$23232</span>
                </div>
            </div>


        </div>
    </div>
</x-app-layout>
