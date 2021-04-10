<?php
    require_once 'modele/Database.php';

    $cat = new Categorie();
    $art = new Article();

?>



<div class="jumbotron">
    <div id="body-shop" class="body-mu">
        <div id="title" class="white">Catalogue</div>
        <img src='<?=$_SESSION['root']?>/img/headers_cats/cat_no.jpg' class='w100 d-inline-block align-top' alt=''>

        <div id="categorie" class="filters button-group js-radio-button-group bg-color-whi">
            <?php $cat->genCategories();?>
        </div>

        <div class="row">
            <div class="col-12">
                <div id="catalog" class="catalog">

                    <?php $art->genCardArticle(0);?>

                    <?php
                   /*
                        $nbPage = 1;
                        $limit = 6;
                        $page = (!isset($_GET['page']))? 1 : $_GET['page'];

                        $offset = ($page - 1)*$limit;
                        $sqlQuery = "SELECT * FROM instruments INNER JOIN article ON instruments.Id_Instrument = article.Id_Instrument LIMIT $limit OFFSET $offset";
                        $stmt = $conn->prepare($sqlQuery);
                        $stmt->execute();
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                            echo '<div class="card cat'.$row["idCategorie"].' col-md-4" data-category="cat'.$row['idCategorie'].'">';
                            echo '<div class="box_img">';
                                echo '<img src="'.$row['img'].'" class="img_thumb card-img-top" alt="">';
                            echo '</div>';
                            echo '<div class="card-body row">';
                                echo '<div class="col-md-8">';
                                    echo '<h5 class="card-title">'.ucfirst($row['designation']).'</h5>';
                                    
                            echo '<a href="" class="btn btn-primary ">Lire plus</a>';
                            echo '</div>';
                            echo '<div class="col-md-4">';
                                echo '<h5>'.$row['prix'].' €</h5>';
                                echo '<a class="btn btn-success" href=""><i class="fa fa-cart-plus"></i></a>';
                                echo '</div>';
                            echo '</div>';
                            echo '</div>';
                        }
                        
                        ?>

                    <nav>
                        <ul class="pagination justify-content-center">
                            <?php
                            // ON RECUPERE LE NOMBRE DE PAGE

                            if($page < 1){
                                $page = 1;
                            }
                            if($page > 1){
                        ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?=$page-1?>">Previous</a>
                            </li>
                            <?php
                            }
                        ?>
                            <?php

                                // RECUPERER LE NOMBRE D'ARTICLE POUR AVOIR LE NOMBRE DE PAGE
                                $countQuery ="SELECT COUNT(Id_Article) AS nbarticle FROM article";
                                $stmt = $conn->query($countQuery);
                                $nbArticle = $stmt->fetch();
                                for($i=0; $i < $nbArticle[0]; $i=$i+$limit){
                            ?>
                            <li class="page-item"><a class="page-link"
                                    href="index.php?page=<?=$nbPage?>"><?=$nbPage?></a></li>
                            <?php
                                $nbPage++;
                                }
                            ?>
                            <?php
                                if($page < $nbPage-1){
                            ?>
                            <li class="page-item"><a class="page-link" href="index.php?page=<?=$page+1?>">Next</a></li>
                            <?php
                                }
                                */
                            ?>
                            <!--</ul>
                </nav> -->

                </div>
            </div>
        </div>
    </div>