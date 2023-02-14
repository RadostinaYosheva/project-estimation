var port = "8080"
var host = "http://localhost"
var path = "src/controllers/"
var url = host + ":" + port + "/" + path

// const LOCAL_SERVER = "http://localhost:8080"

// let SERVER = typeof LOCAL_SERVER === 'undefined' ? 'https://backend.com' : LOCAL_SERVER

if (document.getElementById("add-project")) {
    document.getElementById("add-project").setAttribute("action", url + "projectControllers.php");
}

if (document.getElementById("add-task")) {
    document.getElementById("add-task").setAttribute("action", url + "taskControllers.php");
}
