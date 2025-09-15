CREATE TABLE genres (
    gid INT AUTO_INCREMENT PRIMARY KEY,
    mgenre VARCHAR(50) NOT NULL
);

CREATE TABLE movies (
    mid INT AUTO_INCREMENT PRIMARY KEY,
    mname VARCHAR(100) NOT NULL,
    myear YEAR NOT NULL,
    mgenreid INT,
    mrating INT CHECK (mrating BETWEEN 1 AND 5),
    FOREIGN KEY (mgenreid) REFERENCES genres(gid)
);
