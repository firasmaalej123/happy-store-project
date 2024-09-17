CREATE TABLE categories (
    category_id INT(11) NOT NULL AUTO_INCREMENT,
    category_name VARCHAR(255) NOT NULL,
    description TEXT,
    PRIMARY KEY (category_id)
); 
CREATE TABLE orders (
    id INT(11) NOT NULL AUTO_INCREMENT,
    user_id INT(11),
    order_date TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    total_amount DECIMAL(10,2),
    PRIMARY KEY (id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE order_details (
    order_detail_id INT(11) NOT NULL AUTO_INCREMENT,
    order_id INT(11),
    product_id INT(11),
    product_name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
    price DECIMAL(10,2),
    PRIMARY KEY (order_detail_id),
    FOREIGN KEY (order_id) REFERENCES orders(id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)
) 
CREATE TABLE products (
    product_id INT(11) NOT NULL AUTO_INCREMENT,
    product_name VARCHAR(255) NOT NULL,
    description LONGTEXT,
    price DECIMAL(10,2) NOT NULL,
    older_price DECIMAL(10,2),
    stock INT(11),
    sub_category_id INT(11),
    image LONGBLOB,
    mime_type VARCHAR(255),
    image1 LONGBLOB,
    mime_type1 VARCHAR(255),
    image2 LONGBLOB,
    mime_type2 VARCHAR(255),
    image3 LONGBLOB,
    mime_type3 VARCHAR(255),
    PRIMARY KEY (product_id),
    FOREIGN KEY (sub_category_id) REFERENCES sub_category(sub_category_id)
);
CREATE TABLE shopping_cart (
    id INT(11) NOT NULL AUTO_INCREMENT,
    product_id INT(11) NOT NULL,
    user_id INT(11) NOT NULL,
    quantity INT(11) DEFAULT 1,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY (id),
    FOREIGN KEY (product_id) REFERENCES products(product_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);
CREATE TABLE sub_category (
  sub_category_id INT(11) AUTO_INCREMENT PRIMARY KEY,
  sub_category_name VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  description TEXT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci,
  category_id INT(11) NOT NULL,
  FOREIGN KEY (category_id) REFERENCES categories(category_id)
);
CREATE TABLE users (
  user_id INT(11) AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL,
  tel_number VARCHAR(15),
  address VARCHAR(255),
  country VARCHAR(255),
  zipcode VARCHAR(20),
);  