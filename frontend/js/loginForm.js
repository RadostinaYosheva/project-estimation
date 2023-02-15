var url = "http://127.0.0.1:8080/src/controllers/"
let currentURL = document.URL
let project_id = currentURL.split('?')[1].split('&')[0]
let task_id = currentURL.split('?')[1].split('&')[0]

async function verifyFormDataAsJson({url, formData})
{
    
}

async function verifyUser(event)
{
    event.preventDefault();

    const form = event.currentTarget;
    const url = form.action;

    try
    {
        const formData = new FormData(form);
        const responseData = await verifyFormDataAsJson({url, formData});

        alert("Successfully created new project!");
        console.log({responseData});
    }
    catch(error)
    {
        alert(error);
        console.error(error);
    }
}

const loginForm = document.getElementById("login-form");
loginForm.addEventListener("submit", verifyUser);