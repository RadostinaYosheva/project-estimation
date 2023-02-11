# Project Estimation

This is the final project for the FMI course Web technologies.

## Prerequisites to run the project

 - php@v.8.x
 - MariaDB

## Database server

Open your terminal.
Start your MariaDB server:

    mysql.server start
    mysql

   In the MariaDB shell create the database that we are going to use:

    create database estimation;

   Change the default user password:

    SET PASSWORD FOR 'root'@'localhost' = PASSWORD('defaultpassword');
    FLUSH PRIVILEGES;

Go to `the-place-you-saved-the-project/backend/src/inti` and change the `config.ini` file with the new values.
Exit the shell (Cntr + C).
Navigate to `the-place-you-saved-the-project/backend/src/db`:

    cd the-place-you-saved-the-project/backend/src/db

Start your server again:

    mysql

Run the scripts to create and populate the tables:

    source createDBs.sql
    source insert.sql

You can verify if the data is inserted correctly:

    show tables;
    select * from Project;
    select * from Task;
and others.


## PHP Server

Open another terminal.
Navigate to the backend dir:

    cd the-place-you-saved-the-project/backend

Start the server for `localhost` on port `8080` :

    php -S 127.0.0.1:8080

## HTTP request in API platform

If you want to use an API platform like Postman or Insomnia, below are some of the requests.
### GET task by id
`http://127.0.0.1:8080/src/controllers/taskControllers.php/{taskId}`
### GET all tasks for project
`http://127.0.0.1:8080/src/controllers/taskControllers.php/project/{projectId}`
### GET all tasks
`http://127.0.0.1:8080/src/controllers/taskControllers.php`
### GET all estimations
`http://127.0.0.1:8080/src/controllers/estimationControllers.php`
### POST task (creating a task)
`http://127.0.0.1:8080/src/controllers/taskControllers.php` with request body:

    {
        "id": "78",
        "title": "different title",
        "project": "2",
        "type": "task"
    }

### PUT task (updating a task)
`http://127.0.0.1:8080/src/controllers/taskControllers.php` with example request body:

    {
            "id": "task-id-2",
    				"story_points": 1
    
    }

### DELETE task
`http://127.0.0.1:8080/src/controllers/taskControllers.php/{taskId}`

The endpoints for the projects are similar:
(`http://127.0.0.1:8080/src/controllers/projectControllers.php/...`

