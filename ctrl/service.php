<?php
session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

require_once '../modele/Database.php';

$database = new Database();
$conn = $database->getConnection();

// ----------------- Categories -----------------------

$categories = '[
    {"cat":1,"categorie":"Guitares & Basses","page":"cat-guitares_basses.php"},
    {"cat":2,"categorie":"Batteries & Percussions","page":"cat-batteries_percussions.php"},
    {"cat":3,"categorie":"Pianos & Claviers","page":"cat-pianos_claviers.php"},
    {"cat":4,"categorie":"Instruments à Vent","page":"cat-instruments_a_vent.php"},
    {"cat":5,"categorie":"Instruments à Cordes Frottées","page":"cat-instruments_a_cordes_frottees.php"},
    {"cat":6,"categorie":"Instruments à Cordes","page":"cat-instruments_a_cordes.php"}
]';

if (!isset($_SESSION['categories'])) {

    $array = json_decode($categories, true);

    //var_dump($array);

    foreach ($array as $row) {
        $sql = "INSERT INTO categorie(idCategorie, libele,page) VALUES ('".$row["cat"]."','".$row["categorie"]."','".$row["page"]."')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    $_SESSION['categories']="Categorie";

    echo "Categorie inserted";

}else{

    echo "Categorie already inserted";

}
// ----------------- Instruments -----------------------
$instruments = '[
    {"id":1,"name":"accordéon","cat":3},
    {"id":2,"name":"corne de brume","cat":4},
    {"id":3,"name":"piano à queue","cat":3},
    {"id":4,"name":"cornemuse","cat":4},
    {"id":5,"name":"banjo","cat":1},
    {"id":6,"name":"guitare basse","cat":1},
    {"id":7,"name":"basson","cat":4},
    {"id":8,"name":"Trompette","cat":4},
    {"id":9,"name":"calliope","cat":4},
    {"id":10,"name":"violoncelle","cat":5},
    {"id":11,"name":"clarinette","cat":4},
    {"id":12,"name":"clavicorde","cat":3},
    {"id":13,"name":"concertina","cat":3},
    {"id":14,"name":"didgeridoo","cat":4},
    {"id":15,"name":"dobro","cat":1},
    {"id":16,"name":"dulcimer","cat":1},
    {"id":17,"name":"violon","cat":5},
    {"id":18,"name":"fifre","cat":4},
    {"id":19,"name":"Trumpette Soprano","cat":4},
    {"id":20,"name":"flûte","cat":4},
    {"id":21,"name":"cor dharmonie","cat":4},
    {"id":22,"name":"Xylophone","cat":2},
    {"id":23,"name":"guitare","cat":1},
    {"id":24,"name":"harmonica","cat":4},
    {"id":25,"name":"harpe","cat":6},
    {"id":26,"name":"clavecin","cat":3},
    {"id":27,"name":"vielle à roue","cat":5},
    {"id":28,"name":"kazoo","cat":4},
    {"id":29,"name":"grosse caisse","cat":2},
    {"id":30,"name":"luth","cat":1},
    {"id":31,"name":"lyre","cat":6},
    {"id":32,"name":"mandoline","cat":1},
    {"id":33,"name":"marimba","cat":2},
    {"id":34,"name":"mellotron","cat":3},
    {"id":35,"name":"mélodica","cat":4},
    {"id":36,"name":"hautbois","cat":4},
    {"id":37,"name":"flûte de pan","cat":4},
    {"id":38,"name":"piano","cat":3},
    {"id":39,"name":"piccolo","cat":4},
    {"id":40,"name":"orgue à tuyaux","cat":3},
    {"id":41,"name":"saxophone","cat":4},
    {"id":42,"name":"sitar","cat":1},
    {"id":43,"name":"tuba-contrebasse","cat":4},
    {"id":44,"name":"tambourin","cat":2},
    {"id":45,"name":"thérémine","cat":3},
    {"id":46,"name":"trombone à coulisse","cat":4},
    {"id":47,"name":"tuba","cat":4},
    {"id":48,"name":"ukulélé","cat":1},
    {"id":49,"name":"alto","cat":5},
    {"id":50,"name":"cithare","cat":1},
    {"id":51,"name":"vuvuzela","cat":4}
]';

if (!isset($_SESSION['Instrument'])) {

    $array2 = json_decode($instruments, true);

    //var_dump($array2);

    foreach ($array2 as $row) {
        $sql = "INSERT INTO instruments(Id_Instrument, designation,idCategorie) VALUES ('".$row["id"]."','".$row["name"]."','".$row["cat"]."')";
    
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    $_SESSION['instrument']="Instrument";

    echo 'Inserted instrument';

}else{

    echo "Instrument already inserted";

}


// ----------------- Articles -----------------------
function artRand($nb1, $nb2){
    return rand($nb1,$nb2);
}


$articles = '[
    {"id":1,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":1},
    {"id":2,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":2},
    {"id":3,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":3},
    {"id":4,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":4},
    {"id":5,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":5},
    {"id":6,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":6},
    {"id":7,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":7},
    {"id":8,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":8},
    {"id":9,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":9},
    {"id":10,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":10},
    {"id":11,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":11},
    {"id":12,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":12},
    {"id":13,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":13},
    {"id":14,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":14},
    {"id":15,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":15},
    {"id":16,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":16},
    {"id":17,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":17},
    {"id":18,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":18},
    {"id":19,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":19},
    {"id":20,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":20},
    {"id":21,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":21},
    {"id":22,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":22},
    {"id":23,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":23},
    {"id":24,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":24},
    {"id":25,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":25},
    {"id":26,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":26},
    {"id":27,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":27},
    {"id":28,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":28},
    {"id":29,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":29},
    {"id":30,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":30},
    {"id":31,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":31},
    {"id":32,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":32},
    {"id":33,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":33},
    {"id":34,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":34},
    {"id":35,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":35},
    {"id":36,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":36},
    {"id":37,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":37},
    {"id":38,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":38},
    {"id":39,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":39},
    {"id":40,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":40},
    {"id":41,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":41},
    {"id":42,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":42},
    {"id":43,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":43},
    {"id":44,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":44},
    {"id":45,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":45},
    {"id":46,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":46},
    {"id":47,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":47},
    {"id":48,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":48},
    {"id":49,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":49},
    {"id":50,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":50},
    {"id":51,"stock":'.artRand(0,15).',"prix":'.artRand(150,1500).',"note":'.artRand(1,5).',"instrument":51}
]';



if (!isset($_SESSION['articles'])) {

    $array3 = json_decode($articles, true);

    //var_dump($array3);

    foreach ($array3 as $row) {
        $sql = "INSERT INTO article(Id_Article, qtestock, prix, note, Id_Instrument) VALUES ('".$row["id"]."','".$row["stock"]."','".$row["prix"]."','".$row["note"]."','".$row["instrument"]."')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }
    
    $_SESSION['articles']="articles";
    
    echo 'Inserted Article';
    
}else{
    
    echo "article already inserted";
    
}


// ----------------- Images -----------------------

$dirImg = '../img/cart_img';

echo $dirImg;
$files = scandir($dirImg);

print_r($files);

//Envoyer le chemin absolu en base

function before ($thi, $inthat){
    
    return substr($inthat, 0, strpos($inthat, $thi));
}

foreach ($files as $file) {
    
    if ($file[0] !== '.') { 
        
        $chemin = $_SESSION['root'].'/img/cart_img';
        $indice = before('-', $file);
        $sql = "UPDATE instruments SET img = '".$chemin."/".$file."' WHERE Id_Instrument = $indice";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
    }
}

$message="Update BDD ok";
echo '<script type="text/javascript">window.alert("'.$message.'");</script>';
header("Location: ".$_SESSION['root']."/index.php");

function nameImage($id,$name){
    $name = str_replace(" ", "_", $name);
    $name = str_replace("à", "a", $name);
    $id."-".$name;
}

?>