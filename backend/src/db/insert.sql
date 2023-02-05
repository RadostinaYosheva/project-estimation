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
    type
) values (
    "321",
    "Task 2",
    "1",
    'task'
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

