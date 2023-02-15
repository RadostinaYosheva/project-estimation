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
       
    document.getElementById("project-title").innerHTML = data['title'];
    document.getElementById("project-owner").innerHTML = data['owner'];
    document.getElementById("project-deadline").innerHTML = data['deadline'];
    document.getElementById("project-status").innerHTML = data['status'];     
    
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
        var tCell3 = tRow.insertCell(2);

        /*tCell1.innerHTML = data[row]['title'];*/
        tCell2.innerHTML = data['tasks'][row]['assignee'];
        tCell3.innerHTML = data['tasks'][row]['type'];
    }
     
}

getProject(url_get_project_by_id);


async function postFormDataAsJson({ url, formData }) {
	const plainFormData = Object.fromEntries(formData.entries());
    
	const formDataJsonString = JSON.stringify(plainFormData);
    console.log(formDataJsonString);

	const fetchOptions = {
		method: "DELETE",
		body: formDataJsonString,
	};

	const response = await fetch(url, fetchOptions);

	return response.json();
}
/**
 * Event handler for a form submit event.
 *
 * @see https://developer.mozilla.org/en-US/docs/Web/API/HTMLFormElement/submit_event
 *
 * @param {SubmitEvent} event
 */
async function handleDeleteProject(event)
{
    event.preventDefault();

    const form = event.currentTarget;
	const url = "http://127.0.0.1:8080/src/controllers/projectControllers.php/";
    const url_currProject = url + project_id;

	try {
		const formData = new FormData(form);
		const responseData = await postFormDataAsJson({ url, formData });

		alert("Successfully deleted the project!");
		window.open("project-home.html", "_self");
	} catch (error) {
		alert(error);
		console.error(error);
	}
}

const deleteProjectBtn = document.getElementById("deleteBtn");
deleteProjectBtn.addEventListener("click", handleDeleteProject);


