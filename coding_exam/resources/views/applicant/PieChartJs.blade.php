<script>
function populateChart(status, data, OptionText) {

    var canvas = document.getElementById(status);
    var ctx = canvas.getContext('2d');

    var data = {
        labels: [
                'This Month',
                'This Week',
                'Last Week',
        ],
        datasets: [{
            fill: true,
            backgroundColor: [
                '#F3E96B',
                '#F28A30',
                '#F05837',
            ],
            data: data,
        }]
    };
    var options = {
        title: {
            display: true,
            text: OptionText,
            position: 'top'
        },
        rotation: -0.7 * Math.PI
    };
     // Chart declaration:
    new Chart(ctx, {
        type: 'pie',
        data: data,
        options: options
    });
}

</script>