<?php
require_once 'tcpdf/tcpdf.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $op = isset($_POST['op']) ? $_POST['op'] : '';

    switch ($op) {
        case 'jelentkezes':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $data = fetchDataForPDF('jelentkezes', $id);

            generatePDF($data);
            break;
        
        case 'jelentkezo':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $data = fetchDataForPDF('jelentkezo', $id);

            generatePDF($data);
            break;
        
        case 'kepzes':
            $id = isset($_POST['id']) ? $_POST['id'] : '';
            $data = fetchDataForPDF('kepzes', $id);

            generatePDF($data);
            break;

        default:
            echo json_encode(['error' => 'Invalid operation.']);
            break;
    }
}

function fetchDataForPDF($op, $id) {
    try {
        $dbh = new PDO('mysql:host=localhost;dbname=web2', 'bence22', 'Nobel00',
                        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
        $dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');

        switch ($op) {
            case 'jelentkezes':
                $sql = "SELECT * FROM jelentkezes WHERE jelentkezoid = :id";
                break;
                
            case 'jelentkezo':
                $sql = "SELECT * FROM jelentkezo WHERE id = :id";
                break;
                
            case 'kepzes':
                $sql = "SELECT * FROM kepzes WHERE id = :id";
                break;

            default:
                return ['error' => 'Invalid operation.'];
        }

        $sth = $dbh->prepare($sql);
        $sth->execute(array(':id' => $id));
        $data = ['lista' => $sth->fetchAll(PDO::FETCH_ASSOC)];

        return $data;
    } catch (PDOException $e) {
        return ['error' => 'Database error: ' . $e->getMessage()];
    }
}

function generatePDF($data) {
    $pdf = new TCPDF();
    $pdf->SetMargins(10, 10, 10);
    $pdf->AddPage();

    $pdf->SetFont('helvetica', '', 12);

    if ($data['lista'] && count($data['lista']) > 0) {
        foreach ($data['lista'] as $item) {
            $pdf->Cell(0, 10, 'ID: ' . $item['id'] . ', Név: ' . $item['nev'] . ', Szerzett: ' . $item['szer'], 0, 1);
        }
    } else {
        $pdf->Cell(0, 10, 'Nincs találat.', 0, 1);
    }

    $pdf->Output('output.pdf', 'D');
}
?>