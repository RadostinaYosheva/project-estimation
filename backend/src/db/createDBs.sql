use estimation;

SET FOREIGN_KEY_CHECKS = 0;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS Project;
DROP TABLE IF EXISTS User;

-- TODO: Check if everything is ok (names, not null, default, types, foreign keys, etc.)
CREATE TABLE IF NOT EXISTS User (
    id VARCHAR(36) NOT NULL PRIMARY KEY DEFAULT UUID(),
    email VARCHAR(100),
    first_name VARCHAR(100) NOT NULL,
    second_name VARCHAR(100) NOT NULL
);

CREATE TABLE Task (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    assignee VARCHAR(200),
    description VARCHAR(500),
    type ENUM('epic', 'task', 'bug', 'discovery') NOT NULL,
    story_points INTEGER,
    FOREIGN KEY (assignee) REFERENCES User(id)
);

CREATE TABLE Project (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    owner VARCHAR(200),
    deadline DATETIME NOT NULL,
    task_id VARCHAR(36),
    FOREIGN KEY (owner) REFERENCES User(id),
    FOREIGN KEY (task_id) REFERENCES Task(id)
);
