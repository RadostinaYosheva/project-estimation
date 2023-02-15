async function postFormDataAsJson({ url, formData }) {
	console.log(url); // undefined
	const plainFormData = Object.fromEntries(formData.entries());
    
	const formDataJsonString = JSON.stringify(plainFormData);
    console.log(formDataJsonString);
	

	const fetchOptions = {
		method: "PUT",
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
async function handleCreateProject(event)
{
    event.preventDefault();

    const form = event.currentTarget;
	const url = "http://127.0.0.1:8080/src/controllers/projectControllers.php/";
    const currentURL = document.URL;
    let project_id = currentURL.split('?')[1].split('&')[0]
    const urlTask = url + project_id;

	try {
		const formData = new FormData(form);
		console.log(urlTask); // http://127.0.0.1:8080/src/controllers/projectControllers.php/2
        const responseData = await postFormDataAsJson({ urlTask, formData });
		console.log(urlTask); // undefined

		alert("Successfully edited project!");
		window.open("project.html?" + responseData.id, "_self");
		console.log({ responseData });
	} catch (error) {
		alert(error);
		console.error(error);
	}
}

const editProjectForm = document.getElementById("editProject");
editProjectForm.addEventListener("submit", handleCreateProject);