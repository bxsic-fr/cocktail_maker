CREATE TABLE elements (
    name VARCHAR(255),
    photo VARCHAR(255), 
);

CREATE TABLE cocktails (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    process VARCHAR(255),
    addons VARCHAR(255)
);