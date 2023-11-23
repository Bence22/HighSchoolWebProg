<?php

$eredmeny = "";
try {
	$dbh = new PDO('mysql:host=localhost;dbname=highschool', 'admin', 'log',
				  array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
	$dbh->query('SET NAMES utf8 COLLATE utf8_hungarian_ci');
	switch($_SERVER['REQUEST_METHOD']) {
		case "GET":
				$sql = "SELECT * FROM jelentkezo";     
				$sth = $dbh->query($sql);
				$eredmeny .= "<table style=\"border-collapse: collapse;\"><tr><th></th><th>id</th><th>nev</th><th>nem</th></tr>";
				while($row = $sth->fetch(PDO::FETCH_ASSOC)) {
					$eredmeny .= "<tr>";
					foreach($row as $column)
						$eredmeny .= "<td style=\"border: 1px solid black; padding: 3px;\">".$column."</td>";
					$eredmeny .= "</tr>";
				}
				$eredmeny .= "</table>";
			break;
		case "POST":
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				/*
				echo $incoming;
				print_r($data);
				print_r($_POST);
				*/
				$sql = "insert into jelentkezo values (0, :csn, :nm)";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":csn"=>$data["csn"], ":nm"=>$data["nm"]));
				//$count = $sth->execute(Array(":csn"=>$_POST["csn"], ":nm"=>$_POST["nm"]));				
				$newid = $dbh->lastInsertId();
				$eredmeny .= $count." beszúrt sor: ".$newid;
			break;
		case "PUT":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$modositando = "id=id"; $params = Array(":id"=>$data["id"]);
				if($data['csn'] != "") {$modositando .= ", nev = :csn"; $params[":csn"] = $data["csn"];}
				if($data['nm'] != "") {$modositando .= ", nem = :nm"; $params[":nm"] = $data["nm"];}
				$sql = "update felhasznalokjelentkezo set ".$modositando." where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute($params);
				$eredmeny .= $count." módositott sor. Azonosítója:".$data["id"];
			break;
		case "DELETE":
				$data = array();
				$incoming = file_get_contents("php://input");
				parse_str($incoming, $data);
				$sql = "delete from jelentkezo where id=:id";
				$sth = $dbh->prepare($sql);
				$count = $sth->execute(Array(":id" => $data["id"]));
				$eredmeny .= $count." sor törölve. Azonosítója:".$data["id"];
			break;
	}
}
catch (PDOException $e) {
	$eredmeny = $e->getMessage();
}
echo $eredmeny;

?>