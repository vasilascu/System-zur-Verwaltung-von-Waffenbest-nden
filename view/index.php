<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waffenverwaltungssystem</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="container mt-5">
    <!-- Anmeldeformular -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <form>
                <div class="form-group">
                    <label for="username">Benutzername</label>
                    <input type="text" class="form-control" id="username">
                </div>
                <div class="form-group">
                    <label for="password">Passwort</label>
                    <input type="password" class="form-control" id="password">
                </div>
                <button type="submit" class="btn btn-primary">Anmelden</button>
                <a href="#">Passwort vergessen?</a>
            </form>
        </div>
    </div>

    <!-- Lagerbestand Grafik -->
    <div class="row mt-5">
        <div class="col-md-6 offset-md-3">
            <canvas id="lagerbestandChart" width="400" height="400"></canvas>
        </div>
    </div>
</div>

<script>
    // Daten für die Lagerbestand-Grafik
    var lagerbestandData = {
        labels: ["Produkt A", "Produkt B", "Produkt C", "Produkt D", "Produkt E"],
        datasets: [{
            label: 'Lagerbestand',
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: [20, 35, 25, 40, 30] // Beispielwerte für den Lagerbestand
        }]
    };

    // Optionen für die Lagerbestand-Grafik
    var lagerbestandOptions = {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    };

    // Erstellen der Lagerbestand-Grafik
    var ctx = document.getElementById('lagerbestandChart').getContext('2d');
    var lagerbestandChart = new Chart(ctx, {
        type: 'bar',
        data: lagerbestandData,
        options: lagerbestandOptions
    });
</script>
</body>
</html>
