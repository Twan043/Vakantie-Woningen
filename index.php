<?php
require('connection.php');
include 'header.php';
$Connection = new Connection();
$Connection->setConnection();
?>
<body class="wv-100 hv-100 bg-primary d-flex flex-column" id="indexBody">
<div class="container m-auto" style="text-align: center">
    <h1 class="text-white mb-2">Creëer herinneringen die een leven lang meegaan - Vind jouw droomvakantiehuis vandaag nog!</h1>
    <a href="woningen.php" class="btn btn-warning mt-2">Klik hier voor alle huizen</a>
</div>
</body>
<footer>
    <div class="bg-secondary text-white pt-1 pb-1 mt-1 d-flex justify-content-center" style="text-align: center">
        Copyright: © Alle rechten voor behouden 2021 - <script>document.write(new Date().getFullYear())</script>
    </div>
</footer>
</html>