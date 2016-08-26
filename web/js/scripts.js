//fonctions formulaire

function addRow(tableau) {
    tableau = document.getElementById(tableau);
    //Calcul du nombre de cellule par ligne dans le tableau -> on regarde combien il y a de td dans le premier tr
    var tds = tableau.getElementsByTagName('tr')[0].getElementsByTagName('th').length;

    var tr = document.createElement('tr'); //On créé une ligne
    //On ajoute les cellules
    for (var i = 0; i < tds; i++) {
        var td = document.createElement('td');
        tr.appendChild(td);
        td.innerHTML = '<input type="text" class="form-control" >';
    }

    //On ajoute la ligne créée au tableau
    if (tableau.firstChild.tagName === 'tbody') {
        tableau.firstChild.appendChild(tr);
    } else {
        tableau.appendChild(tr);
    }
}

function deleteRow(tableau) {
    tableau = document.getElementById(tableau);

    var trs = tableau.getElementsByTagName('tr').length;

    if (trs > 1) {
        tableau.deleteRow(-1);
    }

}

var pourcentage = 0;
var lastId = 1;
var lastAction = 0;

function updateProgressBar(id) {


    var value = document.getElementById(id).value;
    if (lastId !== id) {
        if (value === "") {
            pourcentage = pourcentage - 1;
            lastAction = -1;
        } else {
            pourcentage = pourcentage + 1;
            lastAction = 1;
        }
    } else {
        if (value === "" && lastAction !== -1) {
            pourcentage = pourcentage - 1;
            lastAction = -1;
        }
        if (value !== "" && lastAction !== 1) {
            pourcentage = pourcentage + 1;
            lastAction = 1;
        }
    }
    lastId = id;
    alert(lastId + "" + lastAction);
    var bars = document.getElementsByClassName("progress-bar");
    bars[0].style.width = pourcentage + "%";
}

