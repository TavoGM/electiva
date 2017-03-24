
var xmlhttp = new XMLHttpRequest();
var url = "/api/json.php";
var resultElement;

xmlhttp.onreadystatechange = function()
{
    if (this.readyState == 4 && this.status == 200)
    {
        var data = JSON.parse(this.responseText);
        processResponse(data);
    }
};

function processResponse(data)
{
    if (resultElement)
    {
        resultElement.innerHTML = "<div class='information'><p>" + data.userMessage + "</p></div>";
    }
}

function saveContent(id)
{
    resultElement = document.getElementById("result_"+id);
    contentElement = document.getElementById("content_"+id);
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'save', id:id, content:contentElement.value}));
}

function newGroup()
{
    resultElement = document.getElementById("result");
    groupElement = document.getElementById("group");
    summaryElement = document.getElementById("summary");

    if (!groupElement.value || !summaryElement.value)
    {
        alert('Ingresar correctamente la información');
        return;
    }

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'newGroup', group:groupElement.value, summary:summaryElement.value}));

    //optimistic action
    // Find a <table> element with id="myTable":
    var table = document.getElementById("groupsTable");

    // Create an empty <tr> element and add it to the 1st position of the table:
    var row = table.insertRow(table.size);

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);
    var cell2 = row.insertCell(1);

    // Add some text to the new cells:
    cell1.innerHTML = groupElement.value;
    cell2.innerHTML = summaryElement.value;
}

function saveGroup(id)
{
    resultElement = document.getElementById("result");
    groupElement = document.getElementById("group");
    summaryElement = document.getElementById("summary");

    if (!groupElement.value || !summaryElement.value)
    {
        alert('Ingresar correctamente la información');
        return;
    }

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'saveGroup', id:id, group:groupElement.value, summary:summaryElement.value}));
}

function newObjective(id)
{
    resultElement = document.getElementById("resultNewObjective");
    objectiveElement = document.getElementById("objective");

    if (!objectiveElement.value)
    {
        alert('Ingresar correctamente la información');
        return;
    }

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'newObjective', id:id, objective:objectiveElement.value}));

    //optimistic action
    // Find a <table> element with id="myTable":
    var table = document.getElementById("objectivesTable");

    // Create an empty <tr> element and add it to the 1st position of the table:
    var row = table.insertRow(table.size);

    // Insert new cells (<td> elements) at the 1st and 2nd position of the "new" <tr> element:
    var cell1 = row.insertCell(0);

    // Add some text to the new cells:
    cell1.innerHTML = objectiveElement.value;
}

function newActivity(id)
{
    resultElement = document.getElementById("resultNewActivity");
    nameElement = document.getElementById("name");
    dateElement = document.getElementById("date");
    locationElement = document.getElementById("location");
    contentElement = document.getElementById("content");

    if (!nameElement.value || !dateElement.value || !locationElement.value || !contentElement.value)
    {
        alert('Ingresar correctamente la información');
        return;
    }

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'newActivity', id:id, name:nameElement.value, date:dateElement.value, location:locationElement.value, content:contentElement.value}));
}

function deleteActivity(id)
{
    resultElement = document.getElementById("resultDelActivity_"+id);

    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-Type", "application/json");
    xmlhttp.send(JSON.stringify({f:'deleteActivity', id:id}));

    var element = document.getElementById("activitiesTable_"+id);
    element.outerHTML = "";
    delete element;
}

function validate()
{
    element = document.getElementById("name");
    if (!element.value)
    {
        alert('Debe de ingresar un nombre válido');
        element.focus();
        return;
    }

    element = document.getElementById("email");
    if (!element.value)
    {
        alert('Debe de ingresar un correo válido');
        element.focus();
        return;
    }

    element = document.getElementById("phone");
    if (!element.value)
    {
        alert('Debe de ingresar un teléfono válido');
        element.focus();
        return;
    }

    element = document.getElementById("motivacion");
    if (!element.value)
    {
        alert('Debe de ingresar contenido en el campo de motivación');
        element.focus();
        return;
    }

    alert('Información enviada! Muchas Gracias!');
}