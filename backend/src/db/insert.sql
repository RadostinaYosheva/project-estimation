insert into Project 
(
    id, 
    title, 
    deadline
) values (
    "1", 
    "Test Project 1", 
    NOW()
);

insert into Project 
(
    id, 
    title, 
    deadline
) values (
    "2", 
    "Test Project 2", 
    NOW()
);

insert into Task
(
    id,
    title,
    project,
    type
) values (
    "123",
    "Task 1",
    "1",
    'discovery'
);

insert into Task
(
    id,
    title,
    project,
    type,
    assignee
) values (
    "321",
    "Task 2",
    "1",
    "task",
    "@tosho.y"
);

insert into Task
(
    id,
    title,
    project,
    type
) values (
    "456",
    "Task 3",
    "2",
    'task'
);

insert into User
(
    id,
    first_name,
    last_name
) values (
    "@gosho.i",
    "Gosho",
    "Ivanov"
);

insert into User
(
    id,
    first_name,
    last_name
) values (
    "@pesho.p",
    "Pesho",
    "Petrov"
);

insert into User
(
    id,
    first_name,
    last_name
) values (
    "@tosho.y",
    "Tosho",
    "Yordanov"
);
