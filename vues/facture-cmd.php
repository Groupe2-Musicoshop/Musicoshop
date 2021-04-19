<?php 
    require_once 'fpdf/fpdf.php';
	require_once 'modele/Database.php';
	require_once 'modele/Commande.php';
    
    $database = new Database();
    $conn = $database->getConnection();

    $username=$_SESSION["username"];
	 	 
	$sql = "SELECT * FROM utilisateur WHERE userName='$username'";
	$result = $conn->query($sql);
    $client = $result->fetch();

	if($result->rowCount() < 1){
		//header('Location: #');
		echo "<script type='text/javascript'> document.location = '".$_SESSION['root']."/index.php'; </script>";
		exit;
	}  
    //Debut PDF
    $pdf = new FPDF('P', 'mm', 'A4');
    $pdf->AddPage();
    $pdf->Image($_SESSION['root'].'/img/logo/Musicoshop_logo.PNG',10,6,30);
    $pdf->Ln(18);
    
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(0, 6,"Musicoshop", 0, 1);
    $pdf->SetFont('Arial','',12);
    $pdf->Cell(0, 6, utf8_decode('67 69 Avenue du Général de Gaulle'), 0, 1);
    $pdf->Cell(0, 6, "Champs sur Marne, 77300, France", 0, 1);
    $pdf->Cell(0, 6, utf8_decode('Tél : 01 23 56 89 56'), 0, 1);
    $pdf->Ln(8);

    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(130, 6,'', 0, 0);
    $pdf->Cell(59, 6, $client['sexe'] .' '. $client['prenom'].' '.$client['nom'], 0, 1);

    $pdf->SetFont('Arial','',12);
    $pdf->Cell(130, 6,'', 0, 0);
    $pdf->Cell(59, 6, $client['adresse'], 0, 1);

    $pdf->Cell(130, 6,'', 0, 0);
    $pdf->Cell(59, 6, $client['codePostal'].' '.$client['ville'], 0, 1);
    $pdf->Ln(8);

    $idCmd=$_GET['idCmd'];
	$cmd = new Commande();
    $stmtCmd = $cmd->getSqlCmdsById($idCmd);

    while ($rowCmd = $stmtCmd->fetch(PDO::FETCH_ASSOC)){
        extract($rowCmd);
        $pdf->SetFont('Arial','B',16);
        $pdf->cell(0,10, utf8_decode("Facture n°:"). " " . $rowCmd['numCmd'], 'TB', 1, 'C');
        $pdf->SetFont('Arial','',14);
        $pdf->Ln(8);
        $pdf->write(7, 'Le : '. $rowCmd['dateCmd']."\n");
    }
    $pdf->Ln(4);

    $pdf->SetFont('Arial','B',14);
    $pdf->cell(90,6,utf8_decode("Désignation ") , 1, 0, 'C');
    $pdf->cell(25,6,utf8_decode("Qte ") , 1, 0, 'C');
    $pdf->cell(35,6,utf8_decode("Prix ") , 1, 0, 'C');
    $pdf->cell(40,6,utf8_decode("Total ") , 1, 1, 'C');

    $euro = chr(128);

    $stmtLigneCmd = $cmd->getSqlLigneCmds($idCmd);
    $MontantTotal = 0;
    while ($rowtLigneCmd = $stmtLigneCmd->fetch(PDO::FETCH_ASSOC)){    
        extract($rowtLigneCmd);
        $pdf->SetFont('Arial','',12);
        //Designation
        $pdf->cell(90,6,ucfirst($rowtLigneCmd['designation']) , 1, 0);
        //quantite
        $pdf->cell(25,6,$rowtLigneCmd['qtite'], 1, 0);
        //prix
        $pdf->cell(35,6,$rowtLigneCmd['prix'].' '. $euro, 1, 0);
        //prix total par article
        $prixT = $rowtLigneCmd['qtite'] * $rowtLigneCmd['prix'];
        $pdf->cell(40,6,$prixT .' '. $euro , 1, 1);
        //On ajoute le total de la ligne au montant total
        $MontantTotal = $MontantTotal + $prixT;
    }
    // Recapitulatif
    $pdf->SetFont('Arial','B',14);
    $pdf->Cell(115,6, '',0,0);
    $pdf->Cell(35,6, 'Prix total ',1,0);
    $pdf->Cell(40,6, $MontantTotal .' '. $euro ,1,1);

    $pdf->Output('I', 'Facture' , true);
?>