insert into Project 
(
    id, 
    title, 
    deadline,
    status
) values (
    "1", 
    "Test Project 1", 
    NOW(),
    'New'
);

insert into Project 
(
    id, 
    title, 
    deadline,
    status
) values (
    "2", 
    "Test Project 2", 
    NOW(),
    'In Progress'
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
    'Discovery'
);

insert into User
(
    id,
    first_name,
    last_name,
    password,
    role,
    email
) values (
    "@gosho.i",
    "Gosho",
    "Ivanov",
    "abcd1234",
    'Admin',
    "gosho.i@mail.com"
);

insert into User
(
    id,
    first_name,
    last_name,
    password,
    role,
    email
) values (
    "@pesho.p",
    "Pesho",
    "Petrov",
    "abcd12345",
    'Developer',
    "pesho.p@mail.com"
);

insert into User
(
    id,
    first_name,
    last_name,
    password,
    role,
    email
) values (
    "@tosho.y",
    "Tosho",
    "Yordanov",
    "password",
    'Scrum Master',
    "tosho.y@mail.com"
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
    "Task",
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
    'Task'
);
