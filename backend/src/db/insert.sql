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

insert into User
(
    id,
    first_name,
    last_name,
    password,
    email
) values (
    "@gosho.i",
    "Gosho",
    "Ivanov",
    "abcd1234",
    "gosho.i@mail.com"
);

insert into User
(
    id,
    first_name,
    last_name,
    password,
    email
) values (
    "@pesho.p",
    "Pesho",
    "Petrov",
    "abcd12345",
    "pesho.p@mail.com"
);

insert into User
(
    id,
    first_name,
    last_name,
    password,
    email
) values (
    "@tosho.y",
    "Tosho",
    "Yordanov",
    "password",
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
