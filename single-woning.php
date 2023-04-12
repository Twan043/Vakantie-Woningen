<?php
include 'header.php';
require 'connection.php';
$connectionClass = new Connection();
$con = $connectionClass->setConnection();
?>
<body>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="row">
                <div id="carouselExampleControls" class="carousel slide mt-3" data-bs-ride="carousel">
                    <div class="carousel-inner">
                    <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM woningen WHERE woningnr=$nummer LIMIT 1";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="carousel-item active">
                                    <img src="<?php echo $row['hoofd_afbeelding_url'];?>" class="d-block w-100">
                                </div>
                                    <?php
                            }
                        }
                        ?>
                        <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM woningen LEFT JOIN woningen_afbeeldingen ON woningen_afbeeldingen.woningnr = woningen.woningnr LEFT JOIN afbeeldingen ON afbeeldingen.id = woningen_afbeeldingen.afbeeldingen_id WHERE woningen.woningnr=$nummer LIMIT 4";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="carousel-item">
                                    <img src="<?php echo $row['afbeelding_url'];?>" class="d-block w-100">
                                </div>
                                    <?php
                            }
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev arrows-responsive-self" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                        <span class="fa fa-arrow-left" aria-hidden="true" style="color: white; background: black; border-radius: 50%; padding: 5px"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next arrows-responsive-self" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                        <span class="fa fa-arrow-right" aria-hidden="true" style="color: white; background: black; border-radius: 50%; padding: 5px;"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="col-lg-6 responsive-display-none-self">
            <div class="row">
            <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM woningen LEFT JOIN woningen_afbeeldingen ON woningen_afbeeldingen.woningnr = woningen.woningnr LEFT JOIN afbeeldingen ON afbeeldingen.id = woningen_afbeeldingen.afbeeldingen_id WHERE woningen.woningnr=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <div class="col-lg-6 mt-3">
                                    <img src="<?php echo $row['afbeelding_url'];?>" class="w-100 h-100">
                                </div>
                                    <?php
                            }
                        }
                        ?>
            </div>
        </div>
    </div>
    <div class="mt-3 mb-3 border-top border-primary border-2"></div>
    <!--Zet hier titel van object tussen element h4 -->
    <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM `woningen` WHERE `woningnr`=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <h3 class="m-0"><?php echo $row['titel'];?></h3>
                                    <?php
                            }
                        }
                        ?>
    <span class="d-flex">
        <i class="fa fa-map-marker text-muted align-items-center" style="height: 100%; margin-top: 5px; margin-right: 5px;"" aria-hidden="true"></i>
        <!-- adres adres gegevens van object zet je hier onder-->
        <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM `woningen` WHERE `woningnr`=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                    <p class="text-muted align-items-center d-flex m-0"><?php echo $row['plaats']; echo ", "; echo $row['adres'];?></p>
                                    <?php
                            }
                        }
                        ?>
    </span>
    <span class="d-flex mt-3">
        <h6 class="m-0 text-bold">Prijs: </h6>
        <!-- zet hier onder de prijs van het object-->
        <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM `woningen` WHERE `woningnr`=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <h6 class="text-bold m-0" style="margin-left: 5px !important;"><?php echo $row['prijs'];?></h6>
                                    <?php
                            }
                        }
                        ?>
    </span>
    <div class="mt-3 mb-3 border-top border-primary border-2"></div>
    <h5 class="mt-3">Omschrijving:</h5>
    <!-- zet hier onder de beschrijving van het object-->
    <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM `woningen` WHERE `woningnr`=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <p><?php echo $row['omschrijving'];?></p>
                                    <?php
                            }
                        }
                        ?>
    <div class="mt-3 mb-3 border-top border-primary border-2"></div>
    <div class="mb-3">
        <div class="row">
            <div class="col-lg-6 mt-1">
                <h5>Eigenschappen:</h5>
                <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM woningen LEFT JOIN woningen_eigenschappen ON woningen_eigenschappen.woningnr = woningen.woningnr LEFT JOIN eigenschappen ON eigenschappen.id = woningen_eigenschappen.eigenschappen_id WHERE woningen.woningnr =$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <span class="d-flex m-1">
                                    <i class="fa fa-check align-items-center text-success" style="height: 100%; margin-top: 5px; margin-right: 5px;" aria-hidden="true"></i>
                                    <!-- zet hier onder de eigenschap van het object-->
                                    <p class="text-muted align-items-center d-flex m-0"><?php echo $row['eigenschappen_omschrijving'];?></p>
                                </span>
                                    <?php
                            }
                        }
                        ?>
            </div>
            <div class="col-lg-6 mt-1">
                <h5>Liggingen:</h5>
                <?php
                        $nummer = $_GET['id'];
                        $sql = "SELECT * FROM woningen LEFT JOIN woningen_liggingen ON woningen_liggingen.woningnr = woningen.woningnr LEFT JOIN liggingen ON liggingen.id = woningen_liggingen.liggingen_id WHERE woningen.woningnr=$nummer";
                        $result = mysqli_query($con, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                ?>
                                <span class="d-flex m-1">
                                    <i class="fa fa-check align-items-center text-success" style="height: 100%; margin-top: 5px; margin-right: 5px;" aria-hidden="true"></i>
                                    <!-- zet hier onder de ligging van het object-->
                                    <p class="text-muted align-items-center d-flex m-0"><?php echo $row['ligging_omschrijving'];?></p>
                                </span>
                                    <?php
                            }
                        }
                        ?>
            </div>
        </div>
    </div>
</div>
</body>
<?php
include 'footer.php';

$nummer = $_GET['id'];