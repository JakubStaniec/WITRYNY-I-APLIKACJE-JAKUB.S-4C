<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egzamin</title> <link rel="stylesheet" href="islandia.css">
</head>
<body>
    <header><h1><a href="islandia.php">Zwiedzaj Islandię</a></h1></header>
    <aside><h3>Do zwiedzania</h3>
<ul>
<li>Wodospady
    <ol>



 <?php $connect = mysqli_connect('localhost','root','','islandia'); 
 $zapytanie3 = "SELECT nazwa FROM obiekty Where idRodzaj = 10 AND panstwo = 'Islandia'";
 $wynik = mysqli_query($connect, $zapytanie3);
 foreach ($wynik as $row){
    echo '<li>' . $row['nazwa']. '</li>';
 }
 ?>
    </ol>
</li>



<li>Siedliska zwierząt</li>
</ul>
<ol>
<?php $connect = mysqli_connect('localhost','root','','islandia'); 
 $zapytanie3 = "SELECT nazwa FROM obiekty Where idRodzaj = 14 AND panstwo = 'Islandia'";
 $wynik = mysqli_query($connect, $zapytanie3);
 foreach ($wynik as $row){
    echo '<li>' . $row['nazwa']. '</li>';
 }
 ?>


</ol>
</aside>
<main> <h2>Galeria</h2>
    <section>
        <?php $connect = mysqli_connect('localhost','root','','islandia');
        $zapytanie1 = "SELECT obiekty.idObiekt AS 'idObiekt' , obiekty.nazwa AS 'nazwa', obiekty.plik AS 'plik' FROM obiekty Where panstwo = 'Islandia'";
        $wynik = mysqli_query($connect , $zapytanie1);
        foreach ($wynik as $row){
            echo '<a href="obiekty.php?ajdi='. $row['idObiekt'] .'"><img src="pliki1/'.$row['plik'] .'" alt="'.$row['nazwa'] .'" class="miniatury" title="'.$row['nazwa'] .'"></a>';
        }
        mysqli_close($connect)
        ?>
    </section>


    
</main>
<footer>
    <hr>
    <p>Autor: 12345678909</p>
</footer>
</body>
</html>