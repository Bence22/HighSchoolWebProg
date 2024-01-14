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

<label for="jelentkezesID">Jelentkezés azonosító:</label>
<input type="text" id="jelentkezesID">
<button onclick="getData('jelentkezes')">Lekérés</button>

<label for="jelentkezoID">Jelentkező azonosító:</label>
<input type="text" id="jelentkezoID">
<button onclick="getData('jelentkezo')">Lekérés</button>

<label for="kepzesID">Képzés azonosító:</label>
<input type="text" id="kepzesID">
<button onclick="getData('kepzes')">Lekérés</button>

<div id="result"></div>

<script>
function getData(op) {
    var id = $('#' + op + 'ID').val();

    $.ajax({
        type: 'POST',
        url: 'ajax_handler.php',
        data: { op: op, id: id },
        dataType: 'json',
        success: function(response) {
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
        resultDiv.append('<ul>');

        data.lista.forEach(function(item) {
            resultDiv.append('<li>ID: ' + item.id + ', Név: ' + item.nev + ', Szerzett: ' + item.szer + '</li>');
        });

        resultDiv.append('</ul>');
    } else {
        resultDiv.append('<p>Nincs találat.</p>');
    }
}
</script>

</body>
</html>
