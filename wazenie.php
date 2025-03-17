<?php
    $conn = new mysqli(hostname: "localhost", username: "root", password: "", database: "wazenietirow");
?>


<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styl.css">
    <title>Ważenie samochodów ciężarowych</title>
</head>
<body>
    <header id="baner-lewy">
        <h1>Ważenie pojazdów we Wrocławiu</h1>
    </header>

    <header id="baner-prawy">
        <img src="obraz1.png" alt="waga">
    </header>

    <aside id="blok-lewy">
        <h2>Lokalizacje wag</h2>

        <ol>
            <?php
                $sql = "SELECT ulica FROM lokalizacje;";

                $result = $conn -> query(query: $sql);

                while($row = $result -> fetch_array()) {
                    echo "<li>";
                        echo "ulica $row[0]";
                    echo "</li>";
                }
            ?>
        </ol>

        <h2>Kontakt</h2>

        <a href="mailto:wazenie@wroclaw.pl">napisz</a>
    </aside>

    <main id="blok-srodkowy">
        <h2>Alerty</h2>

        <table>
            <tr>
                <th>rejestracja</th>
                <th>ulica</th>
                <th>waga</th>
                <th>dzień</th>
                <th>czas</th>
            </tr>

            <?php
                $sql = "SELECT w.rejestracja, l.ulica, w.waga, w.dzien, w.czas FROM wagi w INNER JOIN lokalizacje l ON w.lokalizacje_id = l.id WHERE w.waga > 5;";

                $result = $conn -> query(query: $sql);

                while($row = $result -> fetch_array()) {
                    echo "<tr>";
                        echo "<td>$row[0]</td>";
                        echo "<td>$row[1]</td>";
                        echo "<td>$row[2]</td>";
                        echo "<td>$row[3]</td>";
                        echo "<td>$row[4]</td>";
                    echo "</tr>";
                }
            ?>
        </table>

        <?php
            $sql = "INSERT INTO wagi (lokalizacje_id, waga, rejestracja, dzien, czas) VALUES ('5', FLOOR(1+RAND()*10), 'DW12345', CURRENT_DATE, CURRENT_TIME);";

            $result = $conn -> query(query: $sql);

            header(header: "refresh: 10");
        ?>
    </main>

    <aside id="blok-prawy">
        <img src="obraz2.jpg" alt="tir" id="obraz2">
    </aside>

    <footer id="stopka">
        <p>Stronę wykonał: <a href="https://github.com/ferl19" target="_blank">ferl19</a></p>
    </footer>
</body>
</html>

<?php
    $conn -> close();
?>