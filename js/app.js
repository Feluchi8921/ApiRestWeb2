"use strict"
const URL="http://localhost/refactor-rest/api/viajes"
// Obtiene todas las tareas de la API REST

async function getAll(){
    try{
    let response=await fetch(URL);
    if(!response.ok)
    throw new Error ('El recurso no existe');

    let viajes= await response.json();
    showViajes(viajes);
    }
    catch(e){
        console.log(error);
    }
}
function showViajes(viajes){
    let ul=document.querySelector("#viajesList");
    ul.innerHTML="";
    for(const viaje of viajes){
        ul.innerHTML += `<li> ${viaje.salida} | ${viaje.destino} | ${viaje.dia} | ${viaje.horario} | ${viaje.lugares} | ${viaje.mascota} | ${viaje.precio} | ${viaje.datos} | ${viaje.id_automovil}`;
    }
}

getAll();