document.getElementById('button1').addEventListener('click', getjoke);


function getjoke(e) {

    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://api.icndb.com/jokes/random/3', true)

    xhr.onprogress = function () {
        console.log('READYSTATE', xhr.readyState);
    }

    xhr.onload = function () {
        let jk = ` `;
        if (this.status === 200) {
            // console.log(this.responseText);
            // document.getElementById('output').innerHTML = `<h2> ${this.responseText} </h2>`
            const respons = JSON.parse(this.responseText);
            if (respons.type === 'success') {
                respons.value.forEach(function (joke) {
                    jk += `<p> ${joke.joke} </p> <br><br>`
                });

            } else

                jk = "something went wrong"




            document.getElementById('joke').innerHTML = jk;
        }


    }

    xhr.send();

    e.preventDefault();
}


function loadData() {
    const xhr = new XMLHttpRequest();

    xhr.open('GET', 'http://api.icndb.com/jokes/random', true)

    xhr.onprogress = function () {
        console.log('READYSTATE', xhr.readyState);
    }

    xhr.onload = function () {
        if (this.status === 200) {
            // console.log(this.responseText);
            // document.getElementById('output').innerHTML = `<h2> ${this.responseText} </h2>`


        }
    }
    // xhr.onreadystatechange = function () {
    //     if (this.status === 200 && this.readyState === 4) {
    //         console.log(this.responseText);
    //     }
    // }
    xhr.send();
}