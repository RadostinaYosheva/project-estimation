function addTaskButton()
{
    var btn = document.getElementsByClassName('addTaskBtn');
    var form = document.getElementsByClassName('add-task');

    form[0].style.display = 'none';
    btn[0].elem = form[0];
    btn[0].addEventListener('click', function(event)
    {
        var style = event.target.elem.style;
        if (style.display == 'none')
        {
            style.display = 'block';
            window.scrollTo(0, 500);
        }
    });

}

function HideTaskForm()
{
    var form = document.getElementsByClassName('add-task');

    var taskTitle = document.getElementById("taskTitle").value;
    var taskAsignee = document.getElementById("asignee").value;

    if(taskTitle.innerHTML != "" && taskAsignee != "")
    {
        var table = document.getElementById("tasks");
        var row = table.insertRow(1);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);

        cell1.innerHTML = taskTitle;
        cell2.innerHTML = taskAsignee;

        form[0].style.display = 'none';
    }
    else{
        alert("Please fill the required fields");
    }
}
