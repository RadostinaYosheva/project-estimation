use estimation;

DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS User;

-- TODO: Check if everything is ok (names, not null, default, types, foreign keys, etc.)
CREATE TABLE IF NOT EXISTS User (
    id VARCHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL,
    email VARCHAR(100)
);

CREATE TABLE Project (
    id VARCHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    status ENUM('New', 'In Progress', 'Done'),
    owner VARCHAR(200),
    deadline DATETIME,
    FOREIGN KEY (owner) REFERENCES User(id)
);

CREATE TABLE Task (
    id VARCHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    project VARCHAR(36) NOT NULL,
    assignee VARCHAR(200),
    description VARCHAR(500),
    type ENUM('Epic', 'Task', 'Bug', 'Discovery') NOT NULL,
    story_points INTEGER,
    FOREIGN KEY (assignee) REFERENCES User(id),
    FOREIGN KEY (project) REFERENCES Project(id)
);
