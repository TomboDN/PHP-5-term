<h2 class="text-center m-1"> <?php switch ($_COOKIE["lang"]) {
        case 'ru':
            echo "Графики";
            break;
        case 'en':
            echo "Graphs";
            break;
    }?> </h2>

<div class="container mt-3" style="margin: 0 auto;
    width: 35%;">
    <div class="row align-items-center" style="display: flex;
    flex-direction: column;">
        <div class="col" style="margin-bottom: 5em;">
            <?php echo '<img src="data:image/png;base64,' . base64_encode($photo0) . '">'; ?>
        </div>
        <div class="col" style="margin-bottom: 5em;">
            <?php echo '<img src="data:image/png;base64,' . base64_encode($photo1) . '">'; ?>
        </div>
        <div class="col" style="margin-bottom: 5em;">
            <?php echo '<img src="data:image/png;base64,' . base64_encode($photo2) . '">'; ?>
        </div>
    </div>
</div>
<div class="container" id="charts">
    <div class="row align-items-center">
        <div class="col"><canvas id="myChart1"></canvas></div>
        <div class="col"><canvas id="myChart2"></canvas></div>
        <div class="col"><canvas id="myChart3"></canvas></div>
    </div>
</div>
<script>
    var genderChart = <?php echo json_encode($genderChart); ?>;
    var ageChart = <?php echo json_encode($ageChart); ?>;
    var browsersBar = <?php echo json_encode($browsersBar); ?>;

    console.log(genderChart);
    console.log(ageChart);
    console.log(browsersBar);

    const labels = {
        "first": [
            'Мужчины',
            'Женщины'
        ],
        "second": [
            'До 18 лет',
            'От 18 и до 30 лет',
            'От 30 и до 50 лет',
            'От 50 и до 80 лет'
        ],
        "third": [
            'Chrome',
            'Firefox',
            'Opera',
            'Internet Explorer',
            'Safari',
            'Microsoft Edge'
        ]
    };

    const data = {
        "first": {
            labels: labels["first"],
            datasets: [{
                label: 'Количество мужчин и женщин',
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)'
                ],
                hoverOffset: 4,
                data: [genderChart['male'], genderChart['female']],
            }]
        },
        "second": {
            labels: labels["second"],
            datasets: [{
                label: 'Возраст пользователей',
                backgroundColor: [
                    'rgb(75, 192, 192)',
                    'rgb(201, 203, 207)',
                    'rgb(255, 205, 86)',
                    'rgb(54, 162, 235)'
                ],
                data: [ageChart['to18'], ageChart['from18to30'], ageChart['from30to50'], ageChart['from50to80']],
            }]
        },
        "third": {
            labels: labels["third"],
            datasets: [{
                label: 'Используемые браузеры',
                backgroundColor: [
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(201, 203, 207, 0.2)'
                ],
                borderColor: [
                    'rgb(255, 159, 64)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(153, 102, 255)',
                    'rgb(201, 203, 207)'
                ],
                borderWidth: 1,
                data: [browsersBar['Chrome'], browsersBar['Firefox'], browsersBar['Opera'], browsersBar['InternetExplorer'], browsersBar['Safari'], browsersBar['MicrosoftEdge']],
            }]
        }
    };

    const config = {
        "first": {
            type: 'pie',
            data: data["first"],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false
            }
        },
        "second": {
            type: 'polarArea',
            data: data["second"],
            options: {
                responsive: true,
                maintainAspectRatio: false,
                animation: false
            }
        },
        "third": {
            type: 'bar',
            data: data["third"],
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                responsive: true,
                maintainAspectRatio: false,
                animation: false
            }
        },
    };

    var Chart1 = new Chart(
        document.getElementById('myChart1'),
        config["first"]
    );

    var Chart2 = new Chart(
        document.getElementById('myChart2'),
        config["second"]
    );

    var Chart3 = new Chart(
        document.getElementById('myChart3'),
        config["third"]
    );

    document.getElementById("charts").style.visibility = "hidden";

    var canvases = [Chart1, Chart2, Chart3];
    getUrlCanvases();

    function getUrlCanvases() {
        if (canvases.length == 3) {
            sendCanvases();
        }
    }

    function sendCanvases() {
        var jsonString = JSON.stringify([Chart1.toBase64Image(), Chart2.toBase64Image(), Chart3.toBase64Image()]);

        $.ajax({
            type: "POST",
            url: "/statistics",
            data: {
                data: jsonString
            }
        }).done(function(o) {
            console.log(canvases);
        });
    }
</script>