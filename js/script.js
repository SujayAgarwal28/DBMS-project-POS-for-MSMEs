document.addEventListener("DOMContentLoaded", function() {
    // Fetch and update dashboard data
    // This example assumes you have an API or backend endpoint to fetch this data

    // Example fetch requests (replace with actual API endpoints)
    fetch('/api/sales_summary')
        .then(response => response.json())
        .then(data => {
            document.getElementById('total-sales').textContent = data.totalSales;
            document.getElementById('num-orders').textContent = data.numOrders;
            document.getElementById('top-selling-product').textContent = data.topSellingProduct;
        });

    fetch('/api/stock_alerts')
        .then(response => response.json())
        .then(data => {
            document.getElementById('low-stock-product').textContent = data.lowStockProduct;
        });

    fetch('/api/recent_activity')
        .then(response => response.json())
        .then(data => {
            const activityList = document.getElementById('recent-activity');
            activityList.innerHTML = '';
            data.activities.forEach(activity => {
                const listItem = document.createElement('li');
                listItem.textContent = activity;
                activityList.appendChild(listItem);
            });
        });
});
