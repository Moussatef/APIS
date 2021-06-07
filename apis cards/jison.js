// Storing data:
// myObj = { name: "John", age: 31, city: "New York" };
// myJSON = JSON.stringify(myObj);
// localStorage.setItem("testJSON", myJSON);

// Retrieving data:
// text = localStorage.getItem("testJSON");
// obj = JSON.parse(text);
// document.getElementById("demo").innerHTML = obj.name;


// var obj = JSON.parse('{ "name":"John", "age":30, "city":"New York"}');

// document.getElementById("demo").innerHTML = obj.name + ", " + obj.age;
// for (i in myObj.cars) {
//     x += myObj.cars[i];
//   }
// for (i = 0; i < myObj.cars.length; i++) {
//     x += myObj.cars[i];
//   } 


function creat_p() {
    var par = document.createElement("p")
    par.classList.add = "card-text"
    return par
}

function print_data(data) {
    console.log(data)
    var users = data
    for (let i = 0; i < users.length; i++) {

        var div_r = document.createElement("div")
        div_r.classList.add = "col"

        var div_card = document.createElement("div")
        div_card.classList.add = "card ";
        var card_body = document.createElement("div")
        card_body.classList.add = "card-body"

        div_cont.appendChild(div_r)
        div_r.appendChild(div_card)
        div_card.appendChild(card_body)
        var card_title = document.createElement("h5")
        card_title.classList.add = "card-title";
        card_body.appendChild(card_title)

        var username = document.createElement("p")

        username.classList.add = "card-text"

        var email = creat_p()

        var street = creat_p()

        var suite = creat_p()

        var city = creat_p()

        var zipcode = creat_p()

        var phone = creat_p()

        var website = creat_p()

        card_body.appendChild(username)
        card_body.appendChild(email)
        card_body.appendChild(street)
        card_body.appendChild(suite)
        card_body.appendChild(city)
        card_body.appendChild(zipcode)

        card_title.innerText = users[i].name
        username.innerText = users[i].username
        email.innerText = users[i].email
        street.innerText = users[i].address.street
        suite.innerText = users[i].address.suite
        city.innerText = users[i].address.city
        zipcode.innerText = users[i].address.zipcode
    }

}

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        var myObj = JSON.parse(this.responseText);
        // document.getElementById("demo").innerHTML = myObj[1].name;
        console.log(myObj[1].name);
        print_data(myObj)
    }
};
xmlhttp.open("GET", "https://jsonplaceholder.typicode.com/users", true);
xmlhttp.send();



// var div_cont = document.getElementById("cont");
// fetch('https://jsonplaceholder.typicode.com/users')
//     .then(response => response.json())
//     .then((json) => print_data(json)
//     )
