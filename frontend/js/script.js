var url = "http://127.0.0.1:8080/src/controllers/"

const api_url_all_projects = url + "projectControllers.php";

// Fill the Home pag table
async function getapi(url){
    const response = await fetch(url);
    var data = await response.json();
    for(var row in data){
        var projectsTable = document.getElementById("all-projects-table");

        var tRow = projectsTable.insertRow(1);

        let tCell1 = tRow.insertCell(0);
        let a = document.createElement('a');
        a.innerText = data[row]['title'];
        a.href = `project.html?${data[row]['id']}`;
        tCell1.appendChild(a);
        var tCell2 = tRow.insertCell(1);
        var tCell3 = tRow.insertCell(2);

        /*tCell1.innerHTML = data[row]['title'];*/
        tCell2.innerHTML = data[row]['owner'];
        tCell3.innerHTML = data[row]['status'];
    }
}

getapi(api_url_all_projects);


// Handle creation of a new project
async function postFormDataAsJson({url, formData})
{
    const plainFormData = Object.fromEntries(formData.entries());
	const formDataJsonString = JSON.stringify(plainFormData);

	const fetchOptions = {
		method: "POST",
		body: formDataJsonString,
	};

	const response = await fetch(url, fetchOptions);

	return response.json();
}

/*async function addProjectToDB(event)
{
    event.preventDefault();

    const form = event.currentTarget;
    const url = form.action;

    try
    {
        const formData = new FormData(form);
        const responseData = await postFormDataAsJson({url, formData});

        alert("Successfully created new project!");
        console.log({responseData});
    }
    catch(error)
    {
        alert(error);
        console.error(error);
    }
}

const createProjectForm = document.getElementById("add-project");
createProjectForm.addEventListener("submit", addProjectToDB);*/
