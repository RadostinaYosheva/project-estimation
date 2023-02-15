let currURL = document.URL
let pr_id = currURL.split('?')[1].split('&')[0]

async function putFormDataAsJson({ url, formData }) {
plainData = Object.fromEntries(formData.entries());
  const dataJsonString = JSON.stringify(plainData);
  console.log(dataJsonString);
  const new_obj = JSON.parse(dataJsonString)
  const JsonToPost = JSON.stringify(new_obj)
  console.log(JsonToPost)

  const postMethod = {
    method: "POST",
    body: JsonToPost
  };

  const response = await fetch(url, postMethod);


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
		console.log(urlTask);
        const responseData = await putFormDataAsJson({ url: urlTask, formData });

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