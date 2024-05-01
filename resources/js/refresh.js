function refresh() {
   const balance = document.getElementById('balance');
   const historyTable = document.getElementById('historyTable');
   const loader = document.getElementById('loader');

   loader.classList.remove('d-none');

   //ajax call
   $.ajax({
    url: "balance",
    type: "GET",
    processData: false,
    contentType: false,
    success: function (response) {
        const {history , balance: balanceData} = response.data;
       loader.classList.add('d-none');
         // populate balance
         balance.innerHTML = balanceData.toString();
       // populate history table but dont use table use div
       historyTable.innerHTML = '';
        history.forEach((transaction) => {
            const row = document.createElement('div');
            row.className = 'table-row-container';
            row.innerHTML = `
            <div class="details">
                <div class="type">
                    <i class="${isLoad(transaction.event).icon}"></i>
                </div>
                <div class="text">
                    <span>
                        ${transaction.event}
                    </span>
                    <span class="date d-block">
                        ${convertDate(transaction.created_at)}
                        ${parseInt(transaction.number) === 0 ? '' : transaction.number}
                    </span>
                </div>
            </div>
            <div class="mr-2"><span>${transaction.status}</span></div>
            <div class="amount-row"><span>${isLoad(transaction.event,transaction.status).sign}${transaction.amount}</span></div>
            `;
            historyTable.appendChild(row);
        });
    },
    error: function (xhr, status, error) {
        console.error("AJAX request failed:", error);
    },
});
}

function convertDate(date){
    const d = new Date(date);
    return `${d.getDate()}/${d.getMonth()}/${d.getFullYear()}`;
}

function isLoad(event, status) {
    let result = {
        sign: "",
        icon: "fa-solid fa-plus"
    };

    if (event === 'Load') {
        result.sign = "-";
        result.icon = "fa-solid fa-sim-card";
    } else if (status === 'Approved') {
        result.sign = "+";
    }

    return result;
}

export default refresh;

