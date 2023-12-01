<?php
$eredmeny = array("lista" => array());
try {
    $dbh = new PDO('mysql:host=localhost;dbname=web2', 'root', '',
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
echo json_encode($eredmeny);
?>

<html>
<div>
<canvas id="myChart"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
          label: '# of Votes',
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
</html>
