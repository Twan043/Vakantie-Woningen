let lengthEigenschappen;
let lengthLigging;
let liggingen = [];
let eigenschappen = [];
let data = [];

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
            headers: {"Content-type" :"application/json"},
            body: JSON.stringify(data)
        })
        .then((response) => response.json())
        .then((json) =>  {
            console.log(json);
        })
        .catch((error) => {
                console.log(error);
            }
        );
}