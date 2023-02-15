async function postFormDataAsJson({ url, formData }) {
	const plainFormData = Object.fromEntries(formData.entries());
    
	const formDataJsonString = JSON.stringify(plainFormData);
    console.log(formDataJsonString);

	const fetchOptions = {
		method: "POST",
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
	const url = "http://127.0.0.1:8080/src/controllers/projectControllers.php";

	try {
		const formData = new FormData(form);
		const responseData = await postFormDataAsJson({ url, formData });

		alert("Successfully created the project!");
		window.open("project.html?" + responseData.id, "_self");
		console.log({ responseData });
	} catch (error) {
		alert(error);
		console.error(error);
	}
}

const addProjectForm = document.getElementById("add-project");
addProjectForm.addEventListener("submit", handleCreateProject);