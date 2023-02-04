use estimation;

-- TODO: Check if everything is ok (names, not null, default, types, foreign keys, etc.)
CREATE TABLE Task (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    description VARCHAR(500),
    type VARCHAR(20) NOT NULL,
    FOREIGN KEY (assignee) REFERENCES User(id),
    story_points INTEGER
);

CREATE TABLE Project (
    id VARCHAR(36) PRIMARY KEY DEFAULT UUID(),
    title VARCHAR(100) NOT NULL,
    FOREIGN KEY (owner) REFERENCES User(id),
    deadline DATETIME NOT NULL,
    FOREIGN KEY (task_id) REFERENCES Task(id)
);

CREATE TABLE IF NOT EXISTS User (
    id VARCHAR(36) PRIMARY KEY UUID(),
    email VARCHAR(100),
    first_name VARCHAR(100) NOT NULL,
    second_name VARCHAR(100) NOT NULL
);

