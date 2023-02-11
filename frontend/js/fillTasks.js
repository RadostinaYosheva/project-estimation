var url = "http://127.0.0.1:8080/src/controllers/"
let currentURL = document.URL
let project_id = currentURL.split('?')[1].split('&')[0]
let task_id = currentURL.split('?')[1].split('&')[0]

url_get_project_by_id = url + "projectControllers.php/" + project_id
url_get_task_by_id = url + "taskControllers.php/" + task_id
async function getTask(url)
{
    const response = await fetch(url);
    var data = await response.json();


    document.getElementById("task-title").innerHTML = data['title'];
    document.getElementById("task-asignee").innerHTML = data['assignee'];
    document.getElementById("task-project").innerHTML = data['project'];
    document.getElementById("task-storyPoints").innerHTML = data['story_points'];
    document.getElementById("task-description").innerHTML = data['description'];
}

getTask(url_get_task_by_id);