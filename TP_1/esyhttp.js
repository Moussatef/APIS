function easyHttp() {
    this.http = new XMLHttpRequest();
}

// Make in GET Http request
easyHttp.prototype.get = function (url) {
    this.http.open('GET', url, true);
    let self = this;
    this.http.onload = function () {
        if (self.http.status === 200) {
            // console.log(JSON.parse(self.http.responseText));
            console.log(self.http.responseText);
        }
    }
    this.http.send();
}