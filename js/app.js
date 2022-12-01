"use strict"
const URL="http://localhost/refactor-rest/api/bikes"
// Obtiene todas las tareas de la API REST

async function getAll(){
    try{
    let response=await fetch(URL);
    if(!response.ok)
    throw new Error ('El recurso no existe');

    let bikes= await response.json();
    showBikes(bikes);
    }
    catch(e){
        console.log(error);
    }
}
function showBike(bikes){
    let ul=document.querySelector("#BikeList");
    ul.innerHTML="";
    for(const bike of bikes){
        ul.innerHTML += `<li> ${bike.id} | ${bike.make} | ${bike.rolled} | ${bike.price}`;
    }
}

getAll();