<?php
session_start();
$_SESSION['root']="http://".$_SERVER['HTTP_HOST']."/Musicoshop";

require_once '../modele/Database.php';

$database = new Database();
$conn = $database->getConnection();

$categories = '[
    {"cat":1,"categorie":"Guitares & Basses"},
    {"cat":2,"categorie":"Batteries & Percussions"},
    {"cat":3,"categorie":"Pianos & Claviers"},
    {"cat":4,"categorie":"Instruments à Vent"},
    {"cat":5,"categorie":"Instruments à Cordes Frottées"},
    {"cat":6,"categorie":"Instruments à Cordes"}
]';

if (!isset($_SESSION['categories'])) {

    $array = json_decode($categories, true);

    //var_dump($array);

    foreach ($array as $row) {
        $sql = "INSERT INTO categorie(idCategorie, libele) VALUES ('".$row["cat"]."','".$row["categorie"]."')";

        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    $_SESSION['categories']="Categorie";

    echo "Categorie inserted";

}else{

    echo "Categorie already inserted";

}

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
    {"id":50,"name":"violon","cat":5},
    {"id":51,"name":"cithare","cat":1},
    {"id":52,"name":"vuvuzela","cat":4}
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

function nameImage($id,$name){
    $name = str_replace(" ", "_", $name);
    $name = str_replace("à", "a", $name);
    $id."-".$name;
}

header("Location: ".$_SESSION['root']."/index.php");
?>