function getRequest(url, data, callback){
    // var req = new XMLHttpRequest();
    
    // req.onload = callback;

    // // Header da requisição
    // req.open("get", url, true);
    // req.send(null);

    url = "/request?data=categoria"

    var xhr  = new XMLHttpRequest()
    xhr.open('GET', url, true)
    xhr.onload = function () {
        var users = JSON.parse(xhr.responseText);
        if (xhr.readyState == 4 && xhr.status == "200") {
            console.table(users);
        } else {
            console.error(users);
        }
    }
    xhr.send(null);

}

function postRequest(url, data, callback){
    let req = new XMLHttpRequest();

    // Verifica o status da requisição
    req.onload = function(){
        if(req.status != 200)
            throw req.status + " - " + req.statusText;

        callback(req.response);
    };

    // Header da requisição
    req.open("post", url, true);
    req.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
    req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

    // Parâmetro da requisição
    req.send(data);
}