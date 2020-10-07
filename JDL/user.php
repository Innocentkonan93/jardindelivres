<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <title>Jardin de livres</title>
</head>

<body>
    <div class="containuer">
        <nav class="navbar navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand">Navbar</a>
                <form class="form-inline">
                    <input class="form-control mr-sm-2" name="q" type="search" placeholder="Recherche..."
                        aria-label="Search" style="border-radius: 20px">
                    <button type="submit" class="btn btn-outline-primary" style="border-radius: 20px">Recherchez
                    </button>
                </form>
                
            </div>
        </nav>
        <div class="row justify-content-center mt-5 ">
                <?php
				
                $db = new PDO("mysql:host=localhost;dbname=idl",'root','');

                $livres = $db->query('SELECT titre, auteur, genre FROM livre ORDER BY id DESC');

                
                if (isset($_GET['q']) && !empty($_GET['q'])) {
                    $q = htmlspecialchars($_GET['q']);
                    $livres = $db->query('SELECT titre, auteur, genre FROM livre WHERE titre LIKE "%'.$q.'%" ORDER BY id DESC');
                    if($livres->rowCount()== 0){
                        $livres = $db->query('SELECT titre, auteur, genre FROM livre WHERE CONCAT(titre, genre) LIKE "%'.$q.'%" ORDER BY id DESC');
                    }

                }
                ?>

                <?php if ($livres->rowCount() > 0) { ?>


                <?php while ($l = $livres->fetch()) { ?>



                <div class="col-md-3 mb-3 no-gutters">
                    <div class="card" style="width: 15rem;">
                    <img src="livre.png" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5><?= $l['titre']?></h5>
                        <h6><?= $l['auteur']?></h6>

                        <p class="card-text">
                            <?= $l['genre']?>
                        </p>
                    </div>
                </div>
                </div>
                <?php } ?>

                <?php } else {?>

                <h5>Aucun resultat pour : <?= $q ?> </h5>
                <?php } ?>
        </div>
        
        
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>