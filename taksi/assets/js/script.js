//additional address fiel open/close
var additional_address = document.getElementById("additional_address");
var additional_address_field = document.getElementById("additional_address_field");

if(additional_address!==null && additional_address_field!==null){
    additional_address.addEventListener("click",(e)=>{
        if(additional_address2.checked){
            e.target.checked = true;
            return;
        }

        if(e.target.checked){
            additional_address_field.classList.remove("closed");
        }else{
            additional_address_field.classList.add("closed");
        }
    });
}

//second additional address field open/close
var additional_address2 = document.getElementById("additional_address2");
var additional_address_field2 = document.getElementById("additional_address_field2");

if(additional_address2!==null && additional_address_field2!==null){
    additional_address2.addEventListener("click",(e)=>{
        if(!additional_address.checked){
            return;
        }

        if(e.target.checked){
            additional_address_field2.classList.remove("closed");
        }else{
            additional_address_field2.classList.add("closed");
        }
    });
}

//povratna voznja open/close
var povratna_voznja_field = document.getElementById("povratna_voznja");
var povratnaCheck = document.getElementById("povratnaCheck");

if(povratnaCheck!==null && povratna_voznja_field!==null){
    povratnaCheck.addEventListener("click",(e)=>{

        if(e.target.checked){
            povratna_voznja_field.classList.remove("closed");
        }else{
            povratna_voznja_field.classList.add("closed");
        }
    });
}

//return additional address open/close
var returnadditional_address = document.getElementById("returnadditional_address");
var returnadditional_address_field = document.getElementById("returnadditional_address_field");
if(returnadditional_address!==null && returnadditional_address_field!==null){
    returnadditional_address.addEventListener("click",(e)=>{

        if(e.target.checked){
            returnadditional_address_field.classList.remove("closed");
        }else{
            returnadditional_address_field.classList.add("closed");
        }
    });
}

//part for pickup address
var city = document.getElementById("location");
var postcode = document.getElementById("postcode");
var street = document.getElementById("street");

//chosing postcode/district
if(postcode!==null && street!==null){
    postcode.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //reset street
        street.disabled = true;
        street.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        street.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                street.disabled = false;
                street.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                street.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    street.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id="+id+"&get_street", true);
        xhttp.send();
    });
}

//chosing city
if(city!==null && postcode!==null && street!==null){
    city.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //resset postcode
        postcode.disabled = true;
        postcode.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Postcode";
        option.value = 0;
        postcode.add(option);

        //reset street
        street.disabled = true;
        street.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        street.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                postcode.disabled = false;
                postcode.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcode.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcode.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id="+id+"&get_district", true);
        xhttp.send();
    });
}

//part for additional pickup address
var cityAditional1 = document.getElementById("locationAditional");
var postcodeAditional1 = document.getElementById("postcodeAditional");
var streetAditional1 = document.getElementById("streetAditional");

//chosing postcode/district for additional
if(postcodeAditional1!==null && streetAditional1!==null){
    postcodeAditional1.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //reset street
        streetAditional1.disabled = true;
        streetAditional1.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        streetAditional1.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                streetAditional1.disabled = false;
                streetAditional1.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                streetAditional1.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    streetAditional1.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id="+id+"&get_street", true);
        xhttp.send();
    });
}

//chosing city for additional
if(cityAditional1!==null && postcodeAditional1!==null && streetAditional1!==null){
    cityAditional1.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //resset postcode
        postcodeAditional1.disabled = true;
        postcodeAditional1.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Postcode";
        option.value = 0;
        postcodeAditional1.add(option);

        //reset street
        streetAditional1.disabled = true;
        streetAditional1.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        streetAditional1.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                postcodeAditional1.disabled = false;
                postcodeAditional1.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcodeAditional1.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcodeAditional1.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id="+id+"&get_district", true);
        xhttp.send();
    });
}

//part for additional pickup address
var cityAditional2 = document.getElementById("locationAditional2");
var postcodeAditional2 = document.getElementById("postcodeAditional2");
var streetAditional2 = document.getElementById("streetAditional2");

if(postcodeAditional2!==null && streetAditional2!==null){
    postcodeAditional2.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //reset street
        streetAditional2.disabled = true;
        streetAditional2.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        streetAditional2.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                streetAditional2.disabled = false;
                streetAditional2.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                streetAditional2.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    streetAditional2.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id="+id+"&get_street", true);
        xhttp.send();
    });
}

//chosing city for additional
if(cityAditional2!==null && postcodeAditional2!==null && streetAditional2!==null){
    cityAditional2.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //resset postcode
        postcodeAditional2.disabled = true;
        postcodeAditional2.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Postcode";
        option.value = 0;
        postcodeAditional2.add(option);

        //reset street
        streetAditional2.disabled = true;
        streetAditional2.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        streetAditional2.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                postcodeAditional2.disabled = false;
                postcodeAditional2.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcodeAditional2.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcodeAditional2.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id="+id+"&get_district", true);
        xhttp.send();
    });
}

//part for pickup address - RETURN RIDE
var returncity = document.getElementById("returnlocation");
var returnpostcode = document.getElementById("returnpostcode");
var returnstreet = document.getElementById("returnstreet");

if(returnpostcode!==null && returnstreet!==null){
    returnpostcode.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //reset street
        returnstreet.disabled = true;
        returnstreet.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        returnstreet.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                returnstreet.disabled = false;
                returnstreet.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnstreet.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    returnstreet.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id="+id+"&get_street", true);
        xhttp.send();
    });
}

//chosing city
if(returncity!==null && returnpostcode!==null && returnstreet!==null){
    returncity.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //resset postcode
        returnpostcode.disabled = true;
        returnpostcode.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Postcode";
        option.value = 0;
        returnpostcode.add(option);

        //reset street
        returnstreet.disabled = true;
        returnstreet.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        returnstreet.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                returnpostcode.disabled = false;
                returnpostcode.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnpostcode.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    returnpostcode.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id="+id+"&get_district", true);
        xhttp.send();
    });
}

//part for aditional pickup address - RETURN RIDE
var returncityAditional = document.getElementById("returnlocationAditional");
var returnpostcodeAditional = document.getElementById("returnpostcodeAditional");
var returnstreetAditional = document.getElementById("returnstreetAditional");

if(returnpostcodeAditional!==null && returnstreetAditional!==null){
    returnpostcodeAditional.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //reset street
        returnstreetAditional.disabled = true;
        returnstreetAditional.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        returnstreetAditional.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                returnstreetAditional.disabled = false;
                returnstreetAditional.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnstreetAditional.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    returnstreetAditional.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id="+id+"&get_street", true);
        xhttp.send();
    });
}

//chosing city
if(returncityAditional!==null && returnpostcodeAditional!==null && returnstreetAditional!==null){
    returncityAditional.addEventListener("change",(e)=>{
        var id = e.target.value;

        if(isNaN(id) || id<1){
            return;
        }

        //resset postcode
        returnpostcodeAditional.disabled = true;
        returnpostcodeAditional.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Postcode";
        option.value = 0;
        returnpostcodeAditional.add(option);

        //reset street
        returnstreetAditional.disabled = true;
        returnstreetAditional.innerHTML = "";
        var option = document.createElement("option");
        option.text = "Street";
        option.value = 0;
        returnstreetAditional.add(option);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            var result = JSON.parse(this.responseText);

            if(result.length===0){
                alert("no enteries for this location at a time");
            }else{
                returnpostcodeAditional.disabled = false;
                returnpostcodeAditional.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnpostcodeAditional.add(option);

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    returnpostcodeAditional.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id="+id+"&get_district", true);
        xhttp.send();
    });
}

//whan booking button is pressed
var bookTo = document.getElementById("bookTo");
if(bookTo!==null){
    bookTo.addEventListener("click",(e)=>{
        var checkbox_accept_ride = document.getElementById("checkbox_accept_ride");
        var checkbox_accept_ride_div = document.getElementById("checkbox_accept_ride_div");

        if(!checkbox_accept_ride.checked){
            checkbox_accept_ride_div.classList.add("bg-danger");
            checkbox_accept_ride_div.scrollTo();
            e.preventDefault();
        }else{
            checkbox_accept_ride_div.classList.remove("bg-danger");
        }
    });
}

//hide and show child seats
var need_child_seat = document.getElementById("need_child_seat");
if(need_child_seat!==null){
    need_child_seat.addEventListener("click",(e)=>{
        var arr = document.getElementsByClassName("child_seats");

        if(e.target.checked){
            for(var i=0;i<arr.length;i++){
                arr[i].classList.remove("visually-hidden");
            }
        }else{
            for(var i=0;i<arr.length;i++){
                arr[i].classList.add("visually-hidden");
            }
        }
    });
}

//hide and show child seats for return ride
var return_need_child_seat = document.getElementById("return_need_child_seat");
if(return_need_child_seat!==null){
    return_need_child_seat.addEventListener("click",(e)=>{
        var arr = document.getElementsByClassName("return_child_seats");

        if(e.target.checked){
            for(var i=0;i<arr.length;i++){
                arr[i].classList.remove("visually-hidden");
            }
        }else{
            for(var i=0;i<arr.length;i++){
                arr[i].classList.add("visually-hidden");
            }
        }
    });
}

var setError = (errorElementName, error) => {
    document.getElementById(errorElementName).focus();
    document.getElementById(errorElementName).scrollIntoView({
        behavior: 'smooth',
        block: 'center'
    });
}

var removeError = (errorElementName) => {
    var element = document.getElementById(errorElementName + "Error");
    element.innerHTML = "";
    element.style.display = "none";
}

async function calculate_price() {
    /*
    * price:
    * additional address price + 10
    * child seat +5
    * district price for number of persons
    * */

    var aa_price = 0;
    var baby_seat_price = 0;
    var child_seat_price = 0;
    var raised_seat_price = 0;

    const xhttp = new XMLHttpRequest();

    xhttp.onload = function () {
        aa_price = Number(this.responseText);
    }
    xhttp.open("GET", "assets/php/ajax.php?get_aa_price", false);
    xhttp.send();

    xhttp.onload = function () {
        baby_seat_price = Number(this.responseText);
    }
    xhttp.open("GET", "assets/php/ajax.php?get_bs_price", false);
    xhttp.send();

    xhttp.onload = function () {
        child_seat_price = Number(this.responseText);
    }
    xhttp.open("GET", "assets/php/ajax.php?get_cs_price", false);
    xhttp.send();

    xhttp.onload = function () {
        raised_seat_price = Number(this.responseText);
    }
    xhttp.open("GET", "assets/php/ajax.php?get_rs_price", false);
    xhttp.send();

    var num_people = document.getElementById("people");
    var ride_price_show = document.getElementById("ride_price_show");
    var price = 0;

    var hourField = document.getElementById("hour");
    if(hourField.value!=="Hour"){
        var h = hourField.value;
        if(h=="22" || h=="23" || h=="00" || h=="01" || h=="02" || h=="03"){
            price+=5;
        }
    }

    var payment = document.getElementById("payment");
    if(payment.value==="card"){
        price+=3;
    }

    //address
    var postcode = document.getElementById("postcode");
    console.log(postcode.value);
    if (postcode.value !== 0 && num_people.value.trim() !== "" && num_people.value > 0) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);
            price+=result;
        }
        xhttp.open("GET", "assets/php/ajax.php?district_price=" + postcode.value + "&num_people=" + num_people.value, false);
        xhttp.send();
        /*
        */
    }

    //additional address 1
    var additional_address = document.getElementById("additional_address");
    if(additional_address.checked){
        price+=aa_price;
    }

    //additional address 2
    var additional_address2 = document.getElementById("additional_address2");
    if(additional_address2.checked){
        price+=aa_price;
    }

    //baby seats
    var baby_seats = document.getElementById("babySeat");
    if (baby_seats.value !== 0 && baby_seats.value.trim() !== "" && baby_seats.value > 0) {
        price += baby_seats.value*baby_seat_price;
    }

    //child seats
    var child_seats = document.getElementById("childSeat");
    if (child_seats.value !== 0 && child_seats.value.trim() !== "" && child_seats.value > 0) {
        price += child_seats.value*child_seat_price;
    }

    //raised seats
    var raised_seats = document.getElementById("raisedSeat");
    if (raised_seats.value !== 0 && raised_seats.value.trim() !== "" && raised_seats.value > 0) {
        price += raised_seats.value*raised_seat_price;
    }

    ride_price_show.innerHTML = "PRICE: " + price + "€";
}

var validate_ride = () => {
    //ovo ispod otkomentarisi da bi iskljucio javascript proveru
    //return true;

    //date validation
    //datum prazan OK
    //datum prosao ToDo
    var date = document.getElementById("date");
    var dateValue = date.value.trim();
    if(dateValue==""){
        setError("date");
        return false;
    }

    //hour validation
    var hour = document.getElementById("hour");
    var hourValue = hour.value.trim();
    console.log(hourValue);
    if(hourValue=="" || hourValue=="Hour"){
        setError("hour");
        return false;
    }

    //hour validation
    var minute = document.getElementById("minute");
    var minuteValue = minute.value.trim();
    if(minuteValue=="" || minuteValue=="Minute"){
        setError("minute");
        return false;
    }

    //location
    var location = document.getElementById("location");
    var locationValue = location.value.trim();
    if(locationValue=="" || locationValue=="0"){
        setError("location");
        return false;
    }

    //postcode
    var postcode = document.getElementById("postcode");
    var postcodeValue = postcode.value.trim();
    if(postcodeValue=="" || postcodeValue=="0"){
        setError("postcode");
        return false;
    }

    //street
    var street = document.getElementById("street");
    var streetValue = street.value.trim();
    if(streetValue=="" || streetValue=="0"){
        setError("street");
        return false;
    }

    //number (house)
    var number = document.getElementById("number");
    var numberValue = number.value.trim();
    if(numberValue==""){
        setError("number");
        return false;
    }

    //additional address additional_address
    var additional_addressCheck = document.getElementById("additional_address");
    if(additional_addressCheck.checked){
        //locationAditional
        var locationAditional = document.getElementById("locationAditional");
        var locationAditionalValue = locationAditional.value.trim();
        if(locationAditionalValue=="" || locationAditionalValue=="0"){
            setError("locationAditional");
            return false;
        }
        //postcodeAditional
        var postcodeAditional = document.getElementById("postcodeAditional");
        var postcodeAditionalValue = postcodeAditional.value.trim();
        if(postcodeAditionalValue=="" || postcodeAditionalValue=="0"){
            setError("postcodeAditional");
            return false;
        }
        //streetAditional
        var streetAditional = document.getElementById("streetAditional");
        var streetAditionalValue = streetAditional.value.trim();
        if(streetAditionalValue=="" || streetAditionalValue=="0"){
            setError("streetAditional");
            return false;
        }
        //numberAditional
        var numberAditional = document.getElementById("numberAditional");
        var numberAditionalValue = numberAditional.value.trim();
        if(numberAditionalValue==""){
            setError("numberAditional");
            return false;
        }
    }

    //additional address 2 additional_address
    var additional_address2Check = document.getElementById("additional_address2");
    if(additional_address2Check.checked){
        //locationAditional
        var locationAditional2 = document.getElementById("locationAditional2");
        var locationAditional2Value = locationAditional2.value.trim();
        if(locationAditional2Value=="" || locationAditional2Value=="0"){
            setError("locationAditional2");
            return false;
        }
        //postcodeAditional
        var postcodeAditional2 = document.getElementById("postcodeAditional2");
        var postcodeAditional2Value = postcodeAditional2.value.trim();
        if(postcodeAditional2Value=="" || postcodeAditional2Value=="0"){
            setError("postcodeAditional2");
            return false;
        }
        //streetAditional
        var streetAditional2 = document.getElementById("streetAditional2");
        var streetAditional2Value = streetAditional2.value.trim();
        if(streetAditional2Value=="" || streetAditional2Value=="0"){
            setError("streetAditional2");
            return false;
        }
        //numberAditional
        var numberAditional2 = document.getElementById("numberAditional2");
        var numberAditional2Value = numberAditional2.value.trim();
        if(numberAditional2Value==""){
            setError("numberAditional2");
            return false;
        }
    }

    //person info
    //number (house)
    var name = document.getElementById("name");
    var nameValue = name.value.trim();
    if(nameValue==""){
        setError("name");
        return false;
    }

    var email = document.getElementById("email");
    var emailValue = email.value.trim();
    if(emailValue==""){
        setError("email");
        return false;
    }

    var mobile = document.getElementById("mobile");
    var mobileValue = mobile.value.trim();
    if(mobileValue==""){
        setError("mobile");
        return false;
    }

    //return ride povratnaCheck
    var povratnaCheck = document.getElementById("povratnaCheck");
    if(povratnaCheck.checked){
        var returndate = document.getElementById("returndate");
        var returndateValue = returndate.value.trim();
        if(returndateValue==""){
            setError("returndate");
            return false;
        }

        //hour validation
        var returnhour = document.getElementById("returnhour");
        var returnhourValue = returnhour.value.trim();
        console.log(returnhourValue);
        if(returnhourValue=="" || returnhourValue=="Hour"){
            setError("returnhour");
            return false;
        }

        //hour validation
        var returnminute = document.getElementById("returnminute");
        var returnminuteValue = returnminute.value.trim();
        if(returnminuteValue=="" || returnminuteValue=="Minute"){
            setError("returnminute");
            return false;
        }

        //pickup address
        //location
        var returnlocation = document.getElementById("returnlocation");
        var returnlocationValue = returnlocation.value.trim();
        if(returnlocationValue=="" || returnlocationValue=="0"){
            setError("returnlocation");
            return false;
        }

        //postcode
        var returnpostcode = document.getElementById("returnpostcode");
        var returnpostcodeValue = returnpostcode.value.trim();
        if(returnpostcodeValue=="" || returnpostcodeValue=="0"){
            setError("returnpostcode");
            return false;
        }

        //street
        var returnstreet = document.getElementById("returnstreet");
        var returnstreetValue = returnstreet.value.trim();
        if(returnstreetValue=="" || returnstreetValue=="0"){
            setError("returnstreet");
            return false;
        }

        //number (house)
        var returnnumber = document.getElementById("returnnumber");
        var returnnumberValue = returnnumber.value.trim();
        if(returnnumberValue==""){
            setError("returnnumber");
            return false;
        }

        var returnadditional_addressCheck = document.getElementById("returnadditional_address");
        if(returnadditional_addressCheck.checked){
            //locationAditional
            var returnlocationAditional = document.getElementById("returnlocationAditional");
            var returnlocationAditionalValue = returnlocationAditional.value.trim();
            if(returnlocationAditionalValue=="" || returnlocationAditionalValue=="0"){
                setError("returnlocationAditional");
                return false;
            }
            //postcodeAditional
            var returnpostcodeAditional = document.getElementById("returnpostcodeAditional");
            var returnpostcodeAditionalValue = returnpostcodeAditional.value.trim();
            if(returnpostcodeAditionalValue=="" || returnpostcodeAditionalValue=="0"){
                setError("returnpostcodeAditional");
                return false;
            }
            //streetAditional
            var returnstreetAditional = document.getElementById("returnstreetAditional");
            var returnstreetAditionalValue = returnstreetAditional.value.trim();
            if(returnstreetAditionalValue=="" || returnstreetAditionalValue=="0"){
                setError("returnstreetAditional");
                return false;
            }
            //numberAditional
            var returnnumberAditional = document.getElementById("returnnumberAditional");
            var returnnumberAditionalValue = returnnumberAditional.value.trim();
            if(returnnumberAditionalValue==""){
                setError("returnnumberAditional");
                return false;
            }
        }
    }

    return true;
}

var bookTo_tbn = document.getElementById("bookTo");
if(bookTo_tbn!==null){
    var list_id = ["postcode","people","additional_address","additional_address2","childSeat","babySeat","raisedSeat","hour","payment"];

    for(var i=0;i<list_id.length;i++){
        document.getElementById(list_id[i]).addEventListener("change",()=>{
            calculate_price();
        });
    }

    bookTo_tbn.addEventListener("click",(e)=>{
        var ans = validate_ride();
        if(ans!==true){
            e.preventDefault();
        }
    });
}

var instant_ride = document.getElementById("instant_ride");
if(instant_ride!==null){
    var ride_time = document.getElementsByClassName("ride_time");

    instant_ride.addEventListener("click",(e)=>{
        for(var i=0;i<ride_time.length;i++){
            if(e.target.checked){
                ride_time[i].style.display="none";
            }else{
                ride_time[i].style.display="none";
            }
        }
    });
}

