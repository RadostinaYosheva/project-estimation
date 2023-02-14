var url = "http://127.0.0.1:8080/src/controllers/"
let currentURL = document.URL
let project_id = currentURL.split('?')[1].split('&')[0]
let task_id = currentURL.split('?')[1].split('&')[0]

url_get_project_by_id = url + "projectControllers.php/" + project_id
url_get_task_by_id = url + "taskControllers.php/" + task_id

async function getProject(url)
{
    const response = await fetch(url);
    var data = await response.json();
    console.log(data);
    console.log(project_id);
    
       
    document.getElementById("project-title").innerHTML = data['title'];
    document.getElementById("project-owner").innerHTML = data['owner'];
    document.getElementById("project-deadline").innerHTML = data['deadline'];
            
    
    for(var row in data['tasks'])
    {
        console.log(data['tasks']);
        var taskTable = document.getElementById("tasks-table");
        var tRow = taskTable.insertRow(1);

        let tCell1 = tRow.insertCell(0);
        let a = document.createElement('a');
        a.innerText = data['tasks'][row]['title'];
        a.href = `task.html?${data['tasks'][row]['id']}`;
        tCell1.appendChild(a);
        var tCell2 = tRow.insertCell(1);

        /*tCell1.innerHTML = data[row]['title'];*/
        tCell2.innerHTML = data['tasks'][row]['assignee'];
    }
     
}

getProject(url_get_project_by_id);


