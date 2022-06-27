<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/style.css">
    <title>Document</title>
</head>
<body>

<?php
    if(isset($_GET['page']) && !empty($_GET['page'])){
        $currentPage = (int) strip_tags($_GET['page']);
    }else{
        $currentPage = 1;
    }

    require_once('./bdd/connect.php');

    $sql = 'SELECT COUNT(*) AS id FROM `bdd_poke`;';
    
    $query = $db->prepare($sql);

    $query->execute();

    $result = $query->fetch();

    $nbPoke = (int) $result['id'];

    
    $parPage = 10;

    $pages = ceil($nbPoke / $parPage);

    
    $premier = ($currentPage * $parPage) - $parPage;
   
    $sql =  'SELECT * FROM `bdd_poke` LIMIT :premier, :parpage;' ;

    $query = $db->prepare($sql);

$query->bindValue(':premier', $premier, PDO::PARAM_INT);
$query->bindValue(':parpage', $parPage, PDO::PARAM_INT);    

    $query->execute();

    $poke = $query->fetchAll(PDO::FETCH_ASSOC);

    require_once('./bdd/close.php');
    ?>

    <main class="container">
        <div class="row">
            <section class="col-12">
                <h1>Carte Pokemon</h1>
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : ""?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
                        </li>
                        <?php
                        $pagi = 0;

                        for($page = 1; $page <= $pages; $page++)
                        {
                            $pagi = $pagi + 1; ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : ""?>">
                                <a href="./?page=<?= $page ?>" class="page-link"><?php echo $pagi ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : ""?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
                        </li>
                    </ul>
                </nav>
                <table class="table">
                    <thead>
                        <th>Valeurs</th>
                        <th>Name</th>
                        <th>Carte</th>
                        <tbody>
                            <?php foreach ($poke as $pokedex){ 
                                ?>
                                    <tr>
                                        <td><?php echo $pokedex['cardmarket/prices/trendPrice'] ;?></td>
                                        <td><?php echo $pokedex['name']; ?></td>
                                        <td><?php echo ("<img src = " . $pokedex['images/small']) . ">"; ?></td>
                                    </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </thead>
                </table>
                <nav>
                    <ul class="pagination">
                        <li class="page-item <?= ($currentPage == 1) ? "disabled" : ""?>">
                            <a href="./?page=<?= $currentPage - 1 ?>" class="page-link">Précédent</a>
                        </li>
                        <?php
                        $pagi = 0;

                        for($page = 1; $page <= $pages; $page++)
                        {
                            $pagi = $pagi + 1; ?>
                            <li class="page-item <?= ($currentPage == $page) ? "active" : ""?>">
                                <a href="./?page=<?= $page ?>" class="page-link"><?php echo $pagi ?></a>
                            </li>
                        <?php
                        }
                        ?>
                        <li class="page-item <?= ($currentPage == $pages) ? "disabled" : ""?>">
                            <a href="./?page=<?= $currentPage + 1 ?>" class="page-link">Suivant</a>
                        </li>
                    </ul>
                </nav>
            </section>
        </div>
    </main>












    
</body>
</html>