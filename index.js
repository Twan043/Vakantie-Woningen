let lengthEigenschappen;
let lengthLigging;
let liggingen = [];
let eigenschappen = [];
let data;
let verkocht;

function addAtributeLiggingen(id) {
    console.log(document.getElementById(id).checked);

    if (document.getElementById(id).checked == true) {
        //voeg die toe
        liggingen.push(document.getElementById(id).value);

        console.log(liggingen);
    } else {
        //verwijderd die
        let searchId = document.getElementById(id).value;

        for (let i = 0; i < liggingen.length; i++) {
            if (liggingen[i] === searchId) {
                liggingen.splice(i, 1);

                console.log('found');
                break;
            }
        }
    }
}

function addAtributeEigenschappen(id) {
    console.log(document.getElementById(id).checked);

    if (document.getElementById(id).checked == true) {
        //voeg die toe
        eigenschappen.push(document.getElementById(id).value);

        console.log(eigenschappen);
    } else {
        //verwijderd die
        let searchId = document.getElementById(id).value;

        for (let i = 0; i < eigenschappen.length; i++) {
            if (eigenschappen[i] === searchId) {
                eigenschappen.splice(i, 1);

                console.log('found');
                break;
            }
        }
    }
}

function searchObject() {
    let liggingenFinal = "";
    for (let j = 0; j < liggingen.length; j++) {
        liggingenFinal = liggingenFinal + liggingen[j] + ",";
    }
    let secondLiggingenFinal = liggingenFinal.substring(0, liggingenFinal.length - 1);
    lengthLigging = liggingen.length;
    let eigenschappenFinal = "";
    for (let j = 0; j < eigenschappen.length; j++) {
        eigenschappenFinal = eigenschappenFinal + eigenschappen[j] + ",";
    }
    let secondEigenschappenFinal = eigenschappenFinal.substring(0, eigenschappenFinal.length - 1);
    lengthEigenschappen = eigenschappen.length;
    data = [lengthEigenschappen, secondEigenschappenFinal, lengthLigging, secondLiggingenFinal];

    console.log(data);

    let url = "api.php";

    fetch(url,
        {
            method: "POST",
            headers: {"Content-type": "application/json"},
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then((json) => {
            data = json;

            console.log(data);

            $( "#houseField" ).empty();

            if (data.Status == 404) {
                $( "#houseField" ).empty();

                $( "#houseField" ).append("<div class=\"alert alert-danger mt-3\">Niks gevonden</div>");
            } else {
                for (let i = 0; i < data.Data.rows.length; i++) {
                    if (data.Data.rows[i].verkocht == 1) {
                        verkocht = "<div class=\"sold-overlay\">Verkocht</div>";
                    } else {
                        verkocht = "";
                    }
                    $( "#houseField" ).append("<div class=\"col-lg-4\">\n" +
                        "                                    <div class=\"mt-3 m-lg-3\">\n" +
                        "                                        <div class=\"card\" style=\"width: 18rem;\">\n" +
                        "                                            <img src=\"" + data.Data.rows[i].hoofd_afbeelding_url + "\" class=\"card-img-top\" alt=\"...\">\n" +
                        "                                            " + verkocht +
                        "                                            <div class=\"card-body\">\n" +
                        "                                                <h5 class=\"card-title\">" + data.Data.rows[i].titel + "</h5>\n" +
                        "                                                <p class=\"card-text\">Some quick example text to build on the card title and make up the bulk of the card's content.</p>\n" +
                        "                                                <a href=\"https://558821.klas4s21.mid-ica.nl/Vakantie-Woningen/single-woning.php?id=" + data.Data.rows[i].woningnr + "\" class=\"btn btn-success\">Go somewhere</a>\n" +
                        "                                            </div>\n" +
                        "                                        </div>\n" +
                        "                                    </div>\n" +
                        "                                </div>");
                    console.log(i);
                }
            }
        })
        .catch((error) => {
                console.log(error);
            }
        );
}