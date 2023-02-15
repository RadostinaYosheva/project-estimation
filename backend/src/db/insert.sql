INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@tosho.y", "Tosho", "Yordanov", "password", 'Scrum Master', "tosho.y@mail.com");

INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@gosho.i", "Gosho", "Ivanov", "abcd1234", 'Admin', "gosho.i@mail.com");

INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@pesho.p", "Pesho", "Petrov", "abcd12345", 'Developer', "pesho.p@mail.com");

INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@maria.i", "Maria", "Ivanova", "passMaria", 'Product Owner', "maria.i@mail.com");

INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@yana.v", "Yana", "Vasileva", "passYana", 'Developer', "yana.v@mail.com");

INSERT INTO User (id, first_name, last_name, password, role, email)
VALUES ("@viktor.g", "Viktor", "Georgiev", "passViktor", 'Developer', "viktor.g@mail.com");

INSERT INTO Project (id, title, status, owner, deadline)
VALUES ("lightbulb", "Lightbulb", 'New', "@maria.i", "2024-01-01 00:00:01");

INSERT INTO Project (id, title, status, owner, deadline)
VALUES ("oceanwave", "Ocean Wave", 'In Progress', "@maria.i", "2023-03-21 23:59:59");

INSERT INTO Project (id, title, status, owner, deadline)
VALUES ("dolomites", "Dolomites", 'Done', "@maria.i", "2022-11-15 18:30:00");

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("dolomites-1", "Setup environment", "dolomites", "@pesho.p", "Setup a new testing environment. Definition of Done: There is a new environment enabling the developers to test their changes.", 'Task', 5);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("dolomites-2", "Client update", "dolomites", "@tosho.y", "Inform the clients what we have been up to the last sprint. Definition of Done: The clients have a clear understanding of our work from the last two weeks.", 'Task', 1);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("lightbulb-1", "Research teambuilding", "lightbulb", "@viktor.g", "We need to find some places that are proper for a teambuilding for 5 people. Definition of Done: A clear proposal with minimal budget.", 'Discovery', 3);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("lightbulb-2", "Research tasks", "lightbulb", "@yana.v", "Figure out what tasks need to be implemented. Definition of Done: The assignee creates atomic tasks that distribute the workload in small pieces. The team should be able to work on at least two task simultaneously.", 'Discovery', 8);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("oceanwave-1", "Research tasks", "oceanwave", "@yana.v", "Figure out what tasks need to be implemented. Definition of Done: The assignee creates atomic tasks that distribute the workload in small pieces. The team should be able to work on at least two task simultaneously.", 'Discovery', 8);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("oceanwave-2", "Setup environment", "oceanwave", "@pesho.p", "Setup a new testing environment. Definition of Done: There is a new environment enabling the developers to test their changes.", 'Task', 5);

INSERT INTO Task (id, title, project, assignee, description, type, story_points)
VALUES ("oceanwave-3", "Fix version of testing environment", "oceanwave", "@viktor.g", "The version of the environment is an old one and it should be changed. Definition of Done: The version is bumped and the environment is working properly.", 'Bug', 1);


