<?php
$data = json_decode(file_get_contents('php://input'), true);

require 'connection.php';

$connectionClass = new Connection();
$con = $connectionClass->setConnection();

if ($data[0] == 0 && $data[1] == "" && $data[2] == 0 && $data[3] == "") {
    $sql2 = "SELECT * FROM woningen;";
    $result2 = mysqli_query($con, $sql2);

    $rows = array();
    while ($row = mysqli_fetch_assoc($result2)) {
        $rows[] = $row;
    }
    $count = mysqli_num_rows($result2);
    $response = array('count' => $count, 'rows' => $rows);

    if ($count > 0) {
        $message = ["Status" => 200, "Message" => "Success", "Data" => $response];

        echo json_encode($message);
    } else {
        $message = ["Status" => 404, "Message" => "No objects found"];

        echo json_encode($message);
    }
} else if ($data[2] == 0 && $data[3] == "") {
    $sql = "SELECT DISTINCT w.woningnr, w.titel, w.omschrijving
                            FROM woningen w
                            INNER JOIN (
                              SELECT woningnr
                              FROM woningen_liggingen
                              WHERE liggingen_id IN (" . $data[1] . ")
                              GROUP BY woningnr
                              HAVING COUNT(DISTINCT liggingen_id) = " . $data[0] . " ) wl ON w.woningnr = wl.woningnr;";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $message = ["Status" => 200, "Message" => "Success", "Data" => [$row]];

            echo json_encode($message);
        }
    } else {
        $message = ["Status" => 404, "Message" => "No objects found"];

        echo json_encode($message);
    }
} else if ($data[0] == 0 && $data[1] == "") {
    $sql = "SELECT DISTINCT w.woningnr, w.titel, w.omschrijving
                            FROM woningen w
                            INNER JOIN (
                              SELECT woningnr
                              FROM woningen_eigenschappen
                              WHERE eigenschappen_id IN (" . $data[3] . ")
                              GROUP BY woningnr
                              HAVING COUNT(DISTINCT eigenschappen_id) = " . $data[2] . "
                            ) we ON w.woningnr = wl.woningnr;";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $message = ["Status" => 200, "Message" => "Success", "Data" => [$row]];

            echo json_encode($message);
        }
    } else {
        $message = ["Status" => 404, "Message" => "No objects found"];

        echo json_encode($message);
    }
} else {
    $sql = "SELECT DISTINCT w.woningnr, w.titel, w.omschrijving
                            FROM woningen w
                            INNER JOIN (
                              SELECT woningnr
                              FROM woningen_liggingen
                              WHERE liggingen_id IN (" . $data[1] . ")
                              GROUP BY woningnr
                              HAVING COUNT(DISTINCT liggingen_id) = " . $data[0] . " ) wl ON w.woningnr = wl.woningnr
                            INNER JOIN (
                              SELECT woningnr
                              FROM woningen_eigenschappen
                              WHERE eigenschappen_id IN (" . $data[3] . ")
                              GROUP BY woningnr
                              HAVING COUNT(DISTINCT eigenschappen_id) = " . $data[2] . "
                            ) we ON w.woningnr = wl.woningnr;";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $message = ["Status" => 200, "Message" => "Success", "Data" => [$row]];

            echo json_encode($message);
        }
    } else {
        $message = ["Status" => 404, "Message" => "No objects found"];

        echo json_encode($message);
    }
}