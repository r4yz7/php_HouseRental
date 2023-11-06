async function getCities(e){
    console.log("getCities!");
    let countryId = e.target.value;
    console.log(countryId);
    let resp = await fetch(`/pages/getcities.php?id=${countryId}`);
    if(resp.ok === true){
        let options = await resp.text();
        // console.log(options);
        // let hotelcities = document.getElementById("hotelcities");
        let currDiv =  e.target.parentNode;
        let nextDiv = currDiv.nextSibling.nextSibling;       
        let citySelect = nextDiv.children[0];
        console.log(citySelect);
        citySelect.innerHTML = options;
        // hotelcities.innerHTML = options;
    }
}

async function getStreets(e){
    let cityId = e.target.value;
    let resp = await fetch(`/pages/getstreets.php?id=${cityId}`);
    if(resp.ok===true){
        let options= await resp.text();
        let currDiv = e.target.parentNode;
        let nextDiv = currDiv.nextSibling.nextSibling;
        let streetSelect = nextDiv.children[0];
        streetSelect.innerHTML = options;
    }
}
async function getHouses(e){
    let streetId = e.target.value;
    let resp = await fetch(`/pages/gethouses.php?id=${streetId}`);
    if(resp.ok===true){
        let options= await resp.text();
        let currDiv = e.target.parentNode;
        let nextDiv = currDiv.nextSibling.nextSibling;
        let houseSelect = nextDiv.children[0];
        houseSelect.innerHTML = options;
    }
}