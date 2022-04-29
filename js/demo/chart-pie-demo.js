// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';


$.ajax({
    url: "chart.php",
    type: "GET",
    data: { pieChart: 1 },
    success: function(res) {
        res = JSON.parse(res);
        var label = [];
        var data = [];
        var ranColor = ['#4e73df', '#1cc88a', '#36b9cc', "#ffa426", "#e83e8c", "#fc544b"];
        var ranColorBG = ['#2e59d9', '#17a673', '#2c9faf', "#ffa426", "#e83e8c", "#fc544b"];
        for (let i = 0; i < res.length; i++) {
            label[i] = res[i][0];
            data[i] = res[i][1];
            var ranColorVal = (Math.floor(Math.random() * 999999) + 100000);
            var ranColorBGVal = ranColorVal - 700;
            ranColor[i + 6] = "#" + ranColorVal;
            ranColorBG[i + 6] = "#" + ranColorBGVal;
        }
        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: label,
                datasets: [{
                    data: data,
                    backgroundColor: ranColor,
                    hoverBackgroundColor: ranColorBG,
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                }],
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                },
                legend: {
                    display: false
                },
                cutoutPercentage: 0,
            },
        });
    }
});