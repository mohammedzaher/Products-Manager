CREATE TABLE product (
  id INT AUTO_INCREMENT PRIMARY KEY,
  sku VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  price DECIMAL(9, 2) NOT NULL,
  type INT NOT NULL,
  created_at DATETIME(6) DEFAULT CURRENT_TIMESTAMP(6) NOT NULL,
  updated_at DATETIME(6) DEFAUlT CURRENT_TIMESTAMP(6) ON UPDATE CURRENT_TIMESTAMP(6)
);

CREATE TABLE category (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL
);

ALTER TABLE product ADD CONSTRAINT FOREIGN KEY (type) REFERENCES category(id) ON DELETE CASCADE;

CREATE TABLE dvd (
  id INT AUTO_INCREMENT PRIMARY KEY,
  size DECIMAL(9, 2) NOT NULL,
  FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE book (
  id INT AUTO_INCREMENT PRIMARY KEY,
  weight DECIMAL(9, 2) NOT NULL,
  FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE
);

CREATE TABLE furniture (
  id INT AUTO_INCREMENT PRIMARY KEY,
  height DECIMAL(9, 2) NOT NULL,
  width DECIMAL(9, 2) NOT NULL,
  length DECIMAL(9, 2) NOT NULL,
  FOREIGN KEY (id) REFERENCES product(id) ON DELETE CASCADE
);

INSERT INTO category (name) VALUES ('DVD'), ('Book'), ('Furniture');
