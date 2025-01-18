<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionare Angajați</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Gestionare Angajați</h1>

        <!-- Form pentru adăugare angajați -->
        <form action="index.php" method="POST" class="form">
            <h2>Adaugă Angajat</h2>
            <input type="text" name="nume" placeholder="Nume" required>
            <input type="text" name="pozitie" placeholder="Poziție" required>
            <input type="number" name="salariu" placeholder="Salariu" step="0.01" required>
            <input type="date" name="data_angajarii" required>
            <button type="submit" name="adauga">Adaugă</button>
        </form>

        <!-- Form pentru căutare angajați -->
        <form action="index.php" method="GET" class="form">
            <h2>Caută Angajat</h2>
            <input type="text" name="cautare" placeholder="Caută după nume, ID sau poziție">
            <button type="submit">Caută</button>
        </form>

        <!-- Tabel pentru afișarea angajaților -->
        <h2>Lista Angajaților</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nume</th>
                    <th>Poziție</th>
                    <th>Salariu</th>
                    <th>Data Angajării</th>
                    <th>Acțiuni</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';

                // Adăugare angajat
                if (isset($_POST['adauga'])) {
                    $nume = $_POST['nume'];
                    $pozitie = $_POST['pozitie'];
                    $salariu = $_POST['salariu'];
                    $data_angajarii = $_POST['data_angajarii'];

                    $sql = "INSERT INTO angajati (nume, pozitie, salariu, data_angajarii) VALUES ('$nume', '$pozitie', '$salariu', '$data_angajarii')";
                    $conn->query($sql);
                }

                // Ștergere angajat
                if (isset($_GET['sterge'])) {
                    $id = $_GET['sterge'];
                    $sql = "DELETE FROM angajati WHERE id=$id";
                    $conn->query($sql);
                }

                // Căutare angajat
                $condition = "1";
                if (isset($_GET['cautare']) && !empty($_GET['cautare'])) {
                    $cautare = $_GET['cautare'];
                    $condition = "nume LIKE '%$cautare%' OR pozitie LIKE '%$cautare%' OR id='$cautare'";
                }

                // Afișare angajați
                $sql = "SELECT * FROM angajati WHERE $condition";
                $result = $conn->query($sql);

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['nume']}</td>
                        <td>{$row['pozitie']}</td>
                        <td>{$row['salariu']}</td>
                        <td>{$row['data_angajarii']}</td>
                        <td><a href='index.php?sterge={$row['id']}' class='sterge'>Șterge</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
