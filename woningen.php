<?php
require 'connection.php';
include 'header.php';

$connectionClass = new Connection();
$con = $connectionClass->setConnection();

if (isset($_GET['submit'])) {

}

?>
    <body class="wv-100 hv-100 bg-primary d-flex flex-column">
    <div class="container mb-auto">
        <div class="row">
            <div class="col-lg-3">
                <form method="get" action="woningen.php" class="sticky-top" style="top: 25px !important;">
                    <div class="m-lg-3 p-3 bg-white">
                        <div class="m-3">
                            <h3>Filter:</h3>
                            <h6 class="pt-1">Eigenschap</h6>
                            <?php
                            $sql = "SELECT * FROM eigenschappen";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    foreach ($result as $row) {
                                        echo '<div class="form-check"><input onclick="addAtributeEigenschappen(this.id)" class="form-check-input" type="checkbox" name="eigenschap' . $row['id'] . '" value="' . $row['id'] . '" id="eigenschap' . $row['id'] . '">
                            <label class="form-check-label" for="eigenschap' . $row['id'] . '">
                                ' . $row['eigenschappen_omschrijving'] . '
                            </label></div>';
                                    }
                                }
                            }
                            ?>
                            <h6 class="pt-1">Liggingen</h6>
                            <?php
                            $sql = "SELECT * FROM liggingen";
                            $result = mysqli_query($con, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    foreach ($result as $row) {
                                        echo '<div class="form-check"><input onclick="addAtributeLiggingen(this.id)" class="form-check-input" type="checkbox" name="ligging' . $row['id'] . '" value="' . $row['id'] . '" id="ligging' . $row['id'] . '">
                            <label class="form-check-label" for="ligging' . $row['id'] . '">
                                ' . $row['ligging_omschrijving'] . '
                            </label></div>';
                                    }
                                }
                            }
                            ?>
                        </div>
                        <div class="m-3">
                            <div onclick="searchObject()" class="btn btn-primary d-flex m-auto w-100 mt-3">Zoeken..</div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="row" id="houseField">
                    <?php
                    $sql = "SELECT DISTINCT w.woningnr, w.titel, w.omschrijving
                            FROM woningen w
                            INNER JOIN (
                              SELECT woningnr
                              FROM woningen_liggingen
                              WHERE liggingen_id IN (1, 2)
                              GROUP BY woningnr
                              HAVING COUNT(DISTINCT liggingen_id) = 2
                            ) wl ON w.woningnr = wl.woningnr;";
                    $result = mysqli_query($con, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            foreach ($result as $row) {
                                echo $row['woningnr'];
                            }
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <footer>
        <div class="bg-secondary text-white pt-1 pb-1 mt-1 d-flex justify-content-center" style="text-align: center">
            Copyright: © Alle rechten voor behouden 2021 - <script>document.write(new Date().getFullYear())</script>
        </div>
    </footer>
    </body>
