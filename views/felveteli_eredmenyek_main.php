<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AJAX Adatlekérés</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

<h1>Itt keresheted meg az eredményeidet:</h1>

<div>
    <label for="jelentkezesID">Jelentkezés azonosító:</label>
    <input type="text" id="jelentkezesID">
</div>

<div>
    <label for="jelentkezoID">Jelentkező azonosító:</label>
    <input type="text" id="jelentkezoID">
</div>

<div>
    <label for="kepzesID">Képzés azonosító:</label>
    <input type="text" id="kepzesID">
</div>

<button onclick="getData()">Lekérés</button>

<div id="result"></div>

<script>
function getData() {
    var jelentkezesID = $('#jelentkezesID').val();
    var jelentkezoID = $('#jelentkezoID').val();
    var kepzesID = $('#kepzesID').val();

    $.ajax({
        type: 'POST',
        url: 'ajax_handler.php',
        data: { op: 'jelentkezes', id: jelentkezesID, jelentkezoID: jelentkezoID, kepzesID: kepzesID },
        dataType: 'json',
        success: function(response) {
            // Az adatok kezelése, pl. megjelenítése
            displayResult(response);
        },
        error: function(error) {
            console.log(error);
        }
    });
}

function displayResult(data) {
    var resultDiv = $('#result');
    resultDiv.empty();

    if (data.lista && data.lista.length > 0) {
        resultDiv.append('<h2>Eredmények:</h2>');
        resultDiv.append('<table border="1">');
        resultDiv.append('<tr><th>ID</th><th>Név</th><th>Szerzett</th></tr>');

        data.lista.forEach(function(item) {
            resultDiv.append('<tr><td>' + item.id + '</td><td>' + item.nev + '</td><td>' + item.szer + '</td></tr>');
        });

        resultDiv.append('</table>');
    } else {
        resultDiv.append('<p>Nincs találat.</p>');
    }
}
</script>

</body>
</html>