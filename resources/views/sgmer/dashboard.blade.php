@extends("home")
@section("title", "painel de control -> ajuda")
@section("tema", "Control")
@section("content")
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consumo da Bateria e Produção de Energia</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = google.visualization.arrayToDataTable([
                ['Tempo', 'Consumo da Bateria', 'Produção de Energia'],
                ['00:00',  10,      20],
                ['01:00',  15,      25],
                ['02:00',  20,      30],
                ['03:00',  25,      35],
                ['04:00',  30,      40]
                // Adicione mais linhas de dados conforme necessário
            ]);

            var options = {
                title: 'Consumo da Bateria e Produção de Energia',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));

            chart.draw(data, options);
        }
    </script>
</head>
<body>
    <div id="chart_div" style="width: 100%; height: 500px;"></div>
</body>
</html>


@endsection