<?php
require 'connection.php';
include 'header.php';

$connectionClass = new Connection();
$con = $connectionClass->setConnection();

?>
    <body class="wv-100 hv-100 bg-primary d-flex flex-column">
    <div class="container mb-auto">
        <div class="row">
            <div class="col-lg-3">
                <form method="get" action="woningen.php">
                    <div class="m-lg-3 p-3 bg-white">
                        <div class="m-3">
                            <h3>Filter:</h3>
                            <h6 class="pt-1">Eigenschap</h6>
                            <select name="eigenschappen" class="form-select" aria-label="Default select example">
                                <option value="0">Selecteer een eigenschap</option>
                            <?php
                            $sql = "SELECT * FROM eigenschappen";
                            $result = mysqli_query($con, $sql);
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="' . $row['id'] . '" id="checkBoxEigenschappen' . $row['id'] . '">' . $row['eigenschappen_omschrijving'] . '</option>';
                                }
                            }
                            ?>
                            </select>
                        </div>
                        <div class="m-3">
                            <h6 class="pt-1">Ligging</h6>
                            <select name="liggingen" class="form-select" aria-label="Default select example">
                                <option value="0">Selecteer een ligging</option>
                                <?php
                                $sql = "SELECT * FROM liggingen";
                                $result = mysqli_query($con, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $row['id'] . '" id="checkBoxLiggingen' . $row['id'] . '">' . $row['ligging_omschrijving'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="m-3">
                            <input type="submit" class="btn btn-primary d-flex m-auto w-100 mt-3" value="Zoeken..." name="submit">
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-9">
                <div class="row" id="houseField">
        <?php
        if (isset($_GET['submit'])) {
            if ($_GET['liggingen'] == 0 && $_GET['eigenschappen'] > 0) {
                $sql = "SELECT * FROM woningen LEFT JOIN woningen_eigenschappen On woningen.woningnr = woningen_eigenschappen.woningnr WHERE woningen_eigenschappen.eigenschappen_id = '" . $_GET['eigenschappen'] . "'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="mt-3 m-lg-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo $row['hoofd_afbeelding_url']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['titel']; ?></h5>
                                        <h6 class="status text-danger"><?php if($row['verkocht'] == 1 ) {
                                                echo 'Verkocht';
                                            }
                                            ?> </h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning?id=<?php echo $row['woningnr']; ?>" class="btn btn-success">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else if ($_GET['eigenschappen'] !== 0 && $_GET['liggingen'] > 0) {
                $sql = "SELECT * FROM woningen LEFT JOIN woningen_liggingen ON woningen.woningnr = woningen_liggingen.woningnr WHERE woningen_liggingen.liggingen_id = '" . $_GET['liggingen'] . "'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="mt-3 m-lg-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo $row['hoofd_afbeelding_url']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['titel']; ?></h5>
                                        <h6 class="status text-danger"><?php if($row['verkocht'] == 1 ) {
                                                echo 'Verkocht';
                                            }
                                            ?> </h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning?id=<?php echo $row['woningnr']; ?>" class="btn btn-success">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else if ($_GET['eigenschappen'] > 0 && $_GET['liggingen'] > 0){
                $sql = "SELECT * FROM woningen LEFT JOIN woningen_liggingen ON woningen.woningnr = woningen_liggingen.woningnr LEFT JOIN woningen_eigenschappen ON woningen.woningnr = woningen_eigenschappen.woningnr WHERE woningen_liggingen.liggingen_id = '" . $_GET['liggingen'] . "' AND woningen_eigenschappen.eigenschappen_id = '" . $_GET['liggingen'] . "'";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="mt-3 m-lg-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo $row['hoofd_afbeelding_url']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['titel']; ?></h5>
                                        <h6 class="status text-danger"><?php if($row['verkocht'] == 1 ) {
                                                echo 'Verkocht';
                                            }
                                            ?> </h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning?id=<?php echo $row['woningnr']; ?>" class="btn btn-success">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                }
            } else {
                $sql = "SELECT * FROM woningen";
                $result = mysqli_query($con, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="col-lg-4">
                            <div class="mt-3 m-lg-3">
                                <div class="card" style="width: 18rem;">
                                    <img src="<?php echo $row['hoofd_afbeelding_url']; ?>" class="card-img-top" alt="...">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $row['titel']; ?></h5>
                                        <h6 class="status text-danger"><?php if($row['verkocht'] == 1 ) {
                                                echo 'Verkocht';
                                            }
                                            ?> </h6>
                                        <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                        <a href="https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning?id=<?php echo $row['woningnr']; ?>" class="btn btn-success">Go somewhere</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
        }
    }
} else {
        $sql = "SELECT * FROM woningen";
        $result = mysqli_query($con, $sql);
        if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            ?>
            <div class="col-lg-4">
                <div class="mt-3 m-lg-3">
                    <div class="card" style="width: 18rem;">
                        <img src="<?php echo $row['hoofd_afbeelding_url']; ?>" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row['titel']; ?></h5>
                            <h6 class="status text-danger"><?php if($row['verkocht'] == 1 ) {
                                    echo 'Verkocht';
                                }
                                ?> </h6>
                            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                            <a href="https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning?id=<?php echo $row['woningnr']; ?>" class="btn btn-success">Go somewhere</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php
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
