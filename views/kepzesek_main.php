<?php
$eredmeny = array("lista" => array());
try {
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00',
                  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
    $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
    $stmt = $dbh->query("SELECT nev, minimum FROM kepzes");
    while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $eredmeny["lista"][] = array("nev" => $row['nev'], "minimum" => $row['minimum']);
    }
}
catch(PDOException $e) {
   
    $eredmeny["hiba"] = $e->getMessage();
}
echo "<table border='1'>";
echo "<tr><th>Név</th><th>Minimum</th></tr>";


foreach ($eredmeny["lista"] as $item) {
    echo "<tr><td>".$item["nev"]."</td><td>".$item["minimum"]."</td></tr>";
}

echo "</table>";
?>

<html>
  <head>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  </head>
  <body>
    <div>
      <canvas id="myChart"></canvas>
    </div>

    <script>
      axios.post('get_chart_data.php')
        .then(response => {
          const chartData = response.data;

          const ctx = document.getElementById('myChart');
          new Chart(ctx, {
            type: 'bar',
            data: {
              labels: chartData.labels,
              datasets: [{
                label: 'Ponthatár minimumok',
                data: chartData.data,
                borderWidth: 1
              }]
            },
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            }
          });
        })
        .catch(error => {
          console.error('Hiba történt az adatok lekérésekor:', error);
        });
    </script>
  </body>
</html>