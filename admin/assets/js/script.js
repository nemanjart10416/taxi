var setError = (errorElementName, error) => {
    var element = document.getElementById(errorElementName + "Error");
    element.style.display = "block";
    element.innerHTML = error;
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

//additional address fiel open/close
var additional_address = document.getElementById("additional_address");
var additional_address_field = document.getElementById("additional_address_field");

if (additional_address !== null && additional_address_field !== null) {
    additional_address.addEventListener("click", (e) => {
        if (additional_address2.checked) {
            e.target.checked = true;
            return;
        }

        if (e.target.checked) {
            additional_address_field.classList.remove("closed");
        } else {
            additional_address_field.classList.add("closed");
        }
    });
}

//second additional address field open/close
var additional_address2 = document.getElementById("additional_address2");
var additional_address_field2 = document.getElementById("additional_address_field2");

if (additional_address2 !== null && additional_address_field2 !== null) {
    additional_address2.addEventListener("click", (e) => {
        if (!additional_address.checked) {
            return;
        }

        if (e.target.checked) {
            additional_address_field2.classList.remove("closed");
        } else {
            additional_address_field2.classList.add("closed");
        }
    });
}

//povratna voznja open/close
var povratna_voznja_field = document.getElementById("povratna_voznja");
var povratnaCheck = document.getElementById("povratnaCheck");

if (povratnaCheck !== null && povratna_voznja_field !== null) {
    povratnaCheck.addEventListener("click", (e) => {

        if (e.target.checked) {
            povratna_voznja_field.classList.remove("closed");
        } else {
            povratna_voznja_field.classList.add("closed");
        }
    });
}

//return additional address open/close
var returnadditional_address = document.getElementById("returnadditional_address");
var returnadditional_address_field = document.getElementById("returnadditional_address_field");
if (returnadditional_address !== null && returnadditional_address_field !== null) {
    returnadditional_address.addEventListener("click", (e) => {

        if (e.target.checked) {
            returnadditional_address_field.classList.remove("closed");
        } else {
            returnadditional_address_field.classList.add("closed");
        }
    });
}

//part for pickup address
var city = document.getElementById("location");
var postcode = document.getElementById("postcode");
var street = document.getElementById("street");

//chosing postcode/district
if (postcode !== null && street !== null) {
    postcode.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                street.disabled = false;
                street.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                street.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    street.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id=" + id + "&get_street", true);
        xhttp.send();
    });
}

//chosing city
if (city !== null && postcode !== null && street !== null) {
    city.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                postcode.disabled = false;
                postcode.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcode.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcode.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id=" + id + "&get_district", true);
        xhttp.send();
    });
}

//part for additional pickup address
var cityAditional1 = document.getElementById("locationAditional");
var postcodeAditional1 = document.getElementById("postcodeAditional");
var streetAditional1 = document.getElementById("streetAditional");

//chosing postcode/district for additional
if (postcodeAditional1 !== null && streetAditional1 !== null) {
    postcodeAditional1.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                streetAditional1.disabled = false;
                streetAditional1.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                streetAditional1.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    streetAditional1.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id=" + id + "&get_street", true);
        xhttp.send();
    });
}

//chosing city for additional
if (cityAditional1 !== null && postcodeAditional1 !== null && streetAditional1 !== null) {
    cityAditional1.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                postcodeAditional1.disabled = false;
                postcodeAditional1.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcodeAditional1.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcodeAditional1.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id=" + id + "&get_district", true);
        xhttp.send();
    });
}

//part for additional pickup address
var cityAditional2 = document.getElementById("locationAditional2");
var postcodeAditional2 = document.getElementById("postcodeAditional2");
var streetAditional2 = document.getElementById("streetAditional2");

if (postcodeAditional2 !== null && streetAditional2 !== null) {
    postcodeAditional2.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                streetAditional2.disabled = false;
                streetAditional2.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                streetAditional2.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    streetAditional2.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id=" + id + "&get_street", true);
        xhttp.send();
    });
}

//chosing city for additional
if (cityAditional2 !== null && postcodeAditional2 !== null && streetAditional2 !== null) {
    cityAditional2.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                postcodeAditional2.disabled = false;
                postcodeAditional2.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                postcodeAditional2.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    postcodeAditional2.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id=" + id + "&get_district", true);
        xhttp.send();
    });
}

//part for pickup address - RETURN RIDE
var returncity = document.getElementById("returnlocation");
var returnpostcode = document.getElementById("returnpostcode");
var returnstreet = document.getElementById("returnstreet");

if (returnpostcode !== null && returnstreet !== null) {
    returnpostcode.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                returnstreet.disabled = false;
                returnstreet.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnstreet.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    returnstreet.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id=" + id + "&get_street", true);
        xhttp.send();
    });
}

//chosing city
if (returncity !== null && returnpostcode !== null && returnstreet !== null) {
    returncity.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                returnpostcode.disabled = false;
                returnpostcode.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnpostcode.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    returnpostcode.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id=" + id + "&get_district", true);
        xhttp.send();
    });
}

//part for aditional pickup address - RETURN RIDE
var returncityAditional = document.getElementById("returnlocationAditional");
var returnpostcodeAditional = document.getElementById("returnpostcodeAditional");
var returnstreetAditional = document.getElementById("returnstreetAditional");

if (returnpostcodeAditional !== null && returnstreetAditional !== null) {
    returnpostcodeAditional.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                returnstreetAditional.disabled = false;
                returnstreetAditional.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnstreetAditional.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["streets_name"];
                    option.value = result[i]["streets_id"];
                    returnstreetAditional.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?district_id=" + id + "&get_street", true);
        xhttp.send();
    });
}

//chosing city
if (returncityAditional !== null && returnpostcodeAditional !== null && returnstreetAditional !== null) {
    returncityAditional.addEventListener("change", (e) => {
        var id = e.target.value;

        if (isNaN(id) || id < 1) {
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
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {
                alert("no enteries for this location at a time");
            } else {
                returnpostcodeAditional.disabled = false;
                returnpostcodeAditional.innerHTML = "";
                var option = document.createElement("option");
                option.text = "Postcode";
                option.value = 0;
                returnpostcodeAditional.add(option);

                for (var i = 0; i < result.length; i++) {
                    var option = document.createElement("option");
                    option.text = result[i]["district_name"];
                    option.value = result[i]["district_id"];
                    returnpostcodeAditional.add(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?city_id=" + id + "&get_district", true);
        xhttp.send();
    });
}

//whan booking button is pressed
var bookTo = document.getElementById("bookTo");
if (bookTo !== null) {
    bookTo.addEventListener("click", (e) => {
        var checkbox_accept_ride = document.getElementById("checkbox_accept_ride");
        var checkbox_accept_ride_div = document.getElementById("checkbox_accept_ride_div");

        if (!checkbox_accept_ride.checked) {
            checkbox_accept_ride_div.classList.add("bg-danger");
            checkbox_accept_ride_div.scrollTo();
            e.preventDefault();
        } else {
            checkbox_accept_ride_div.classList.remove("bg-danger");
        }
    });
}

//hide and show child seats
var need_child_seat = document.getElementById("need_child_seat");
if (need_child_seat !== null) {
    need_child_seat.addEventListener("click", (e) => {
        var arr = document.getElementsByClassName("child_seats");

        if (e.target.checked) {
            for (var i = 0; i < arr.length; i++) {
                arr[i].classList.remove("visually-hidden");
            }
        } else {
            for (var i = 0; i < arr.length; i++) {
                arr[i].classList.add("visually-hidden");
            }
        }
    });
}

//hide and show child seats for return ride
var return_need_child_seat = document.getElementById("return_need_child_seat");
if (return_need_child_seat !== null) {
    return_need_child_seat.addEventListener("click", (e) => {
        var arr = document.getElementsByClassName("return_child_seats");

        if (e.target.checked) {
            for (var i = 0; i < arr.length; i++) {
                arr[i].classList.remove("visually-hidden");
            }
        } else {
            for (var i = 0; i < arr.length; i++) {
                arr[i].classList.add("visually-hidden");
            }
        }
    });
}

//flightnumber
//returnflightnumber

var flightnumber = document.getElementById("flightnumber");
var returnflightnumber = document.getElementById("returnflightnumber");

var to = document.getElementById("to");
if (to !== null) {
    to.addEventListener("click", (e) => {
        flightnumber.classList.add("visually-hidden");
        returnflightnumber.classList.remove("visually-hidden");
    });
}

var from = document.getElementById("from");
if (from !== null) {
    from.addEventListener("click", (e) => {
        flightnumber.classList.remove("visually-hidden");
        returnflightnumber.classList.add("visually-hidden");
    });
}

var search = document.getElementById("search");
var tableBody = document.getElementById("tableBody");
if(search!==null){
    if(search.value!==""){
        var tds = tableBody.getElementsByTagName("td");
        for(var i=0;i<tds.length;i++){
            if(tds[i].hasAttribute("skip-mark")){
                continue;
            }
            var text = tds[i].textContent;
            var regex = new RegExp('('+search.value+')', 'ig');
            text = text.replace(regex, '<span class="highlight">'+search.value+'</span>');
            tds[i].innerHTML = text;
        }
    }
}

var checkdate = document.getElementById("checkdate");
if(checkdate!==null){
    checkdate.addEventListener("click",(e)=>{
        var checkdateList = document.getElementsByClassName("checkdate");
        if(e.target.checked){
            for (var i=0;i<checkdateList.length;i++){
                checkdateList[i].classList.remove("visually-hidden");
            }
        }else{
            for (var i=0;i<checkdateList.length;i++){
                checkdateList[i].classList.add("visually-hidden");
            }
        }
    });
}

//search cities
var c_names = document.getElementById("c_names"); //datalist
if(c_names!==null){
    search_input = document.getElementById("search");
    search_input.addEventListener("input",(e)=>{
        var inputValue = e.target.value;

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var result = JSON.parse(this.responseText);

            if (result.length === 0) {

            } else {
                c_names.innerHTML = "";

                for(var i=0;i<result.length;i++){
                    var option = document.createElement("option");
                    option.value = result[i]["city_name"];
                    c_names.appendChild(option);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?searchCity=" + inputValue, true);
        xhttp.send();
    });
}

var change_driver_status = document.getElementById("change_driver_status");
if(change_driver_status!==null){
    var change_status_label = document.getElementById("change_status_label");

    change_driver_status.addEventListener("click",(e)=>{
        if(e.target.checked){
            //active
            var status = "active";
        }else{
            //unactive
            var status = "unactive";
        }

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var result = this.responseText;

            change_status_label.innerHTML="Status "+result;
        }

        xhttp.open("GET", "assets/php/ajax.php?change_driver_status=" + status, true);
        xhttp.send();
    });
}

//translate
var hideAllLang = () => {
    var elements = document.querySelectorAll(".en, .de, .sr");

    for(var i=0;i<elements.length;i++){
        if(!elements[i].classList.contains("visually-hidden")){
            elements[i].classList.add("visually-hidden");
        }
    }
}

var showLang = (lang) => {
    hideAllLang();

    var elements = document.getElementsByClassName(lang);
    for(var i=0;i<elements.length;i++){
        elements[i].classList.remove("visually-hidden");
    }
}

var translate_svg = document.getElementsByClassName("translate_svg");
for(var i=0;i<translate_svg.length;i++){
    translate_svg[i].addEventListener("click",(e)=>{
        var language = e.target.getAttribute("id");
        console.log(language);

        if(language=="german"){
            localStorage.setItem("lang","de");
            showLang("de");
        }

        if(language=="english"){
            localStorage.setItem("lang","en");
            showLang("en");
        }

        if(language=="serbian"){
            localStorage.setItem("lang","sr");
            showLang("sr");
        }
    });
}

if(localStorage.getItem("lang")!==null){
    showLang(localStorage.getItem("lang"));
}else {
    localStorage.setItem("lang","en");
    showLang("en");
}



//admin ride notification
var rideNotification = document.getElementById("rideNotification");
if(rideNotification!=null){
    var last_id = rideNotification.getAttribute("lride");

    var interval = setInterval(()=>{
        console.log(1);

        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var new_id = this.responseText;

            console.log(last_id+" "+new_id);
            if(last_id!=new_id){
                /*
                <span class="text-danger">
                    <b>You have new rides</b>
                </span>
                * */
                var span = document.createElement("span");
                span.classList.add("text-danger");
                span.classList.add("bg-white");
                span.innerHTML = "You have new rides";
                rideNotification.innerHTML = "";
                rideNotification.appendChild(span);
                clearInterval(interval);

                var new_rides_section = document.getElementById("new_rides_section");
                if(new_rides_section!==null){
                    setTimeout(()=>{
                        document.location.reload();
                    },1500);
                }
            }
        }

        xhttp.open("GET", "assets/php/ajax.php?last_id", true);
        xhttp.send();

    },1000);
}

//driver ride notification
var rideNotificationDriver = document.getElementById("rideNotificationDriver");
if(rideNotificationDriver!=null){
    var last_id = rideNotificationDriver.getAttribute("lride"); //ldride
    var driver_id = rideNotificationDriver.getAttribute("driver_id"); //driver_id

    var interval = setInterval(()=>{
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {
            var new_id = this.responseText;

            console.log(last_id+" "+new_id);
            if(last_id!=new_id){
                /*
                <span class="text-danger">
                    <b>You have new rides</b>
                </span>
                * */
                var span = document.createElement("span");
                span.classList.add("text-danger");
                span.classList.add("bg-white");
                span.innerHTML = "You have new rides";
                rideNotificationDriver.innerHTML = "";
                rideNotificationDriver.appendChild(span);

                var driver_notification = document.getElementById("driver_notification");
                if(driver_notification!==null){
                    setTimeout(()=>{
                        clearInterval(interval);
                        document.location.reload();
                    },1500);
                }
            }
        }
        xhttp.open("GET", "assets/php/ajax.php?last_id_driver="+driver_id, true);
        xhttp.send();

    },1000);
}

//confirm deletion
//delete admin
var delete_admin = document.getElementsByClassName("delete-admin");
for(var i=0;i<delete_admin.length;i++){
    delete_admin[i].addEventListener("click",(e)=>{
        var ans = confirm("are ypu sure you want to delete this entity?");
        if(!ans){
            e.preventDefault();
        }
    });
}

