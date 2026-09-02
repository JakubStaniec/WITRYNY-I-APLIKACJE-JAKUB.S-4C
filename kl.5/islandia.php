<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
// ================================
// POŁĄCZENIE Z BAZĄ DANYCH
// ================================

$polaczenie = mysqli_connect("localhost", "root", "", "islandia");

if (!$polaczenie) {
    die("Błąd połączenia z bazą danych");
}

mysqli_set_charset($polaczenie, "utf8");


// ================================
// POBRANIE ID OBIEKTU
// ================================

$idObiekt = isset($_GET["id"]) ? intval($_GET["id"]) : 0;
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <title>Islandia</title>

    <style>

        /* ================================
           STYL CAŁEJ STRONY
           ================================ */

        * {
            font-family: "Comic Sans MS", sans-serif;
        }

        /* BLOK NAGŁÓWKOWY I GŁÓWNY */

        header,
        main {
            width: 70%;
            text-align: center;
        }

        /* NAGŁÓWEK I BOCZNY */

        header,
        aside {
            background-color: PaleTurquoise;
            border-radius: 20px;
        }

        /* NAGŁÓWEK */

        header {
            height: 100px;
            padding: 2%;
        }

        /* BLOK BOCZNY */

        aside {
            width: 25%;
            height: 700px;
            line-height: 2;
            float: right;
        }

        /* BLOK GŁÓWNY */

        main {
            float: left;
        }

        /* STOPKA */

        footer {
            clear: both;
            padding-top: 10px;
        }

        /* SEKCJA */

        section {
            border: 1px dashed DimGray;
            margin: 10px 50px;
            height: 400px;
            overflow: auto;
        }

        /* MINIATURY */

        .miniatura {
            height: 200px;
            padding: 10px;
            opacity: 0.8;
            transition: 1s;
        }

        /* NAJECHANIE MYSZKĄ */

        .miniatura:hover {
            opacity: 1;
        }

    </style>
</head>

<body>


<!-- ================================
     BLOK NAGŁÓWKOWY
     ================================ -->

<header>

    <h1>
        <a href="islandia.php">
            Zwiedzaj Islandię
        </a>
    </h1>

</header>


<!-- ================================
     BLOK BOCZNY
     ================================ -->

<aside>

    <h3>Do zwiedzania</h3>

    <ul>

        <!-- WODOSPADY -->

        <li>
            Wodospady:

            <ol>

                <?php

                // SKRYPT 1
                // Zapytanie 3

                $zapytanie1 = "SELECT nazwa FROM obiekty WHERE idRodzaj <> 14";

                $wynik1 = mysqli_query($polaczenie, $zapytanie1);

                while ($wiersz1 = mysqli_fetch_assoc($wynik1)) {

                    echo "<li>";
                    echo $wiersz1["nazwa"];
                    echo "</li>";

                }

                ?>

            </ol>

        </li>


        <!-- SIEDLISKA ZWIERZĄT -->

        <li>
            Siedliska zwierząt:

            <ol>

                <?php

                // SKRYPT 2
                // Zapytanie 3 + idRodzaj = 14

                $zapytanie2 = "SELECT nazwa FROM obiekty WHERE idRodzaj = 14";

                $wynik2 = mysqli_query($polaczenie, $zapytanie2);

                while ($wiersz2 = mysqli_fetch_assoc($wynik2)) {

                    echo "<li>";
                    echo $wiersz2["nazwa"];
                    echo "</li>";

                }

                ?>

            </ol>

        </li>

    </ul>

</aside>


<!-- ================================
     BLOK GŁÓWNY
     ================================ -->

<main>


<?php

// ====================================
// JEŻELI NIE WYBRANO OBIEKTU
// POKAZUJEMY GALERIĘ
// ====================================

if ($idObiekt == 0) {

?>

    <h2>Galeria</h2>

    <section>

        <?php

        // SKRYPT 3
        //
        // Pobieramy:
        // idObiekt
        // nazwa
        // plik

        $zapytanie3 = "SELECT idObiekt, nazwa, plik FROM obiekty";

        $wynik3 = mysqli_query($polaczenie, $zapytanie3);


        while ($wiersz3 = mysqli_fetch_assoc($wynik3)) {

            ?>

            <a href="islandia.php?id=<?php echo $wiersz3["idObiekt"]; ?>">

                <img
                    class="miniatura"
                    src="<?php echo $wiersz3["plik"]; ?>"
                    alt="<?php echo $wiersz3["nazwa"]; ?>"
                    title="<?php echo $wiersz3["nazwa"]; ?>"
                >

            </a>

            <?php

        }

        ?>

    </section>

<?php

}


// ====================================
// JEŻELI WYBRANO OBIEKT
// POKAZUJEMY JEGO OPIS
// ====================================

else {

?>

    <h2>Opis miejsca</h2>

    <section>

        <?php

        // SKRYPT 4
        //
        // Pobieramy informacje o obiekcie
        // o podanym idObiekt

        $zapytanie4 = "
            SELECT
                obiekty.nazwa,
                obiekty.plik,
                obiekty.opis,
                obiekty.nazwaCechy,
                obiekty.wartoscCechy,
                rodzaje.rodzaj
            FROM obiekty
            JOIN rodzaje
                ON obiekty.idRodzaj = rodzaje.idRodzaj
            WHERE obiekty.idObiekt = $idObiekt
        ";

        $wynik4 = mysqli_query($polaczenie, $zapytanie4);


        if ($wiersz4 = mysqli_fetch_assoc($wynik4)) {

            ?>


            <!-- OBRAZ -->

            <img
                src="<?php echo $wiersz4["plik"]; ?>"
                alt="<?php echo $wiersz4["nazwa"]; ?>"
            >


            <!-- NAZWA -->

            <h2>
                <?php echo $wiersz4["nazwa"]; ?>
            </h2>


            <!-- RODZAJ -->

            <h3>
                <?php echo $wiersz4["rodzaj"]; ?>
            </h3>


            <!-- CECHA -->

            <p>
                <?php echo $wiersz4["nazwaCechy"]; ?>:
                <?php echo $wiersz4["wartoscCechy"]; ?>
            </p>


            <!-- OPIS -->

            <p>
                <?php echo $wiersz4["opis"]; ?>
            </p>


            <?php

        }

        ?>

    </section>

<?php

}

?>


</main>


<!-- ================================
     STOPKA
     ================================ -->

<footer>

    <hr>

    <p>
        Autor: 000000000
    </p>

</footer>


<?php

// ================================
// ZAMKNIĘCIE POŁĄCZENIA
// ================================

mysqli_close($polaczenie);

?>

</body>
</html>
</body>
</html>