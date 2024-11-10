const URL = "http://localhost:8000/";

async function btnEditCountyOnClick(id)
{
    document.getElementById("new-county").style.display = "block";
    document.getElementById("new-county-id").value = id;
    document.getElementById("new-county-name").value = await getNameById(id);
}

async function getNameById(id)
{
    let response = await fetch(URL + "counties/" + id, {
        method: "GET"
    });

    var body=await response.json();


    console.log(body);

    return body.data[0].name;
}

async function sendPut(id)
{

    let name = document.getElementById("new-county-name").value;

    let response = await fetch(URL + "counties/" + id, {
        method: "PUT",
        body: '{"name":"'+name+'"}'
    });

    console.log(response);

    if(response.ok)
    {
        location.reload();
    }
    else
    {
        alert("Módosítás sikertelen!")
    }
}

async function btnDelCountyOnClick(id)
{
    let response = await fetch(URL + "counties/" + id, {
        method: "DELETE"
    });

    console.log(response);

    if(response.ok)
    {
        location.reload();
    }
    else
    {
        alert("Törlés sikertelen!");
    }
}

function newCounty()
{
    document.getElementById("new-county").style.display = "block";
    document.getElementById("new-county-id").value = "null";
}

async function sendPost()
{
    let name = document.getElementById("new-county-name").value;

    let response = await fetch(URL + "counties", {
        method: "POST",
        body: '{"name":"'+name+'"}'
    });

    if(response.ok)
    {
        location.reload();
    }
    else
    {
        alert("Hozzáadás sikertelen!");
    }
}

function cancelPost()
{
    document.getElementById("new-county").style.display = "none";
}

function send()
{
    let id = document.getElementById("new-county-id").value;

    console.log(id);

    if(id == "null")
    {
        sendPost();
    }
    else
    {
        sendPut(id);
    }
}