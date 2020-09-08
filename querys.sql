/*
CREATE TABLE ranges (
    id_range INT (11) NOT NULL AUTO_INCREMENT,
    value VARCHAR(255),
    PRIMARY KEY (id_range)
)

CREATE TABLE parts_clothing (
    id_partsClothing INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(255),
    PRIMARY KEY (id_partsClothing)
    
)

CREATE TABLE sizes (
    id_size INT(11) NOT NULL AUTO_INCREMENT,
    size VARCHAR(10),
    PRIMARY KEY (id_size)
)

CREATE TABLE body (
    id_body INT(11) NOT NULL AUTO_INCREMENT,
    name VARCHAR(500),
    PRIMARY KEY (id_body)
)

CREATE TABLE gender (
    id_gender INT(11) NOT NULL AUTO_INCREMENT,
    genderName VARCHAR(255),
    PRIMARY KEY (id_gender)
)

CREATE TABLE category(
    id_category INT(11) NOT NULL AUTO_INCREMENT,
    categoryName VARCHAR(500),
    PRIMARY KEY (id_category)
)

CREATE TABLE features(
    id_feature INT(11) NOT NULL AUTO_INCREMENT,
    featureName VARCHAR(500),
    PRIMARY KEY (id_feature)
)

CREATE TABLE article_type (
    id_articleType INT(11) NOT NULL AUTO_INCREMENT,
    typeName VARCHAR(500),
    PRIMARY KEY (id_articleType)
)
*/
CREATE TABLE article_features(
    id_articleType INT(11),
    id_feature INT(11),
    PRIMARY KEY (id_articleType, id_feature),
    FOREIGN KEY (id_articleType) REFERENCES article_type(id_articleType),
    FOREIGN KEY (id_feature) REFERENCES features(id_feature)
)

CREATE TABLE colors (
    id_color INT(11) NOT NULL AUTO_INCREMENT,
    colorName VARCHAR(500),
    hex VARCHAR(255),
    PRIMARY KEY (id_color)
)

CREATE TABLE prints(
    id_print INT(11) NOT NULL AUTO_INCREMENT,
    printName VARCHAR(500),
    PRIMARY KEY (id_print)
)

CREATE TABLE label_season(
    id_labelSeason INT(11) NOT NULL AUTO_INCREMENT,
    seasonName VARCHAR(500),
    PRIMARY KEY (id_labelSeason)
)

CREATE TABLE measurements(
    id_measurement INT(11) NOT NULL AUTO_INCREMENT,
    id_range INT(11),
    id_partsClothing INT(11),
    id_size INT(11),
    PRIMARY KEY (id_measurement),
    FOREIGN KEY (id_range) REFERENCES ranges(id_range),
    FOREIGN KEY (id_partsClothing) REFERENCES parts_clothing(id_partsClothing),
    FOREIGN KEY (id_size) REFERENCES sizes(id_size)
)

CREATE TABLE products(
    id_product INT(11) NOT NULL AUTO_INCREMENT,
    productName VARCHAR(500),
    price FLOAT,
    avgDiscount FLOAT,
    priceDiscount FLOAT,
    id_articleType INT(11),
    id_category INT(11),
    id_gender INT(11),
    id_body INT(11),
    labelStyle VARCHAR(500),
    labelOccasion VARCHAR(500),
    id_labelSeason INT(11),
    id_client INT(11),
    id_measurement INT(11),
    PRIMARY KEY (id_product),
    FOREIGN KEY (id_articleType) REFERENCES article_type(id_articleType),
    FOREIGN KEY (id_category) REFERENCES category(id_category),
    FOREIGN KEY (id_gender) REFERENCES gender(id_gender),
    FOREIGN KEY (id_body) REFERENCES body(id_body),
    FOREIGN KEY (id_labelSeason) REFERENCES label_season(id_labelSeason),
    FOREIGN KEY (id_client) REFERENCES client(id_client),
    FOREIGN KEY (id_measurement) REFERENCES measurements(id_measurement)
)

CREATE TABLE product_print (
    id_product INT(11),
    id_print INT(11),
    PRIMARY KEY (id_product, id_print),
    FOREIGN KEY (id_product) REFERENCES products(id_product),
    FOREIGN KEY (id_print) REFERENCES prints(id_print)
)

CREATE TABLE product_color(
    id_product INT(11),
    id_color INT(11),
    PRIMARY KEY (id_product, id_color),
    FOREIGN KEY (id_product) REFERENCES products(id_product),
    FOREIGN KEY (id_color) REFERENCES colors(id_color)
)

CREATE TABLE product_size (
    id_product INT(11),
    id_size INT(11),
    PRIMARY KEY (id_product, id_size),
    FOREIGN KEY (id_product) REFERENCES products(id_product),
    FOREIGN KEY (id_size) REFERENCES sizes(id_size)
)

CREATE TABLE product_images(
    id_productImage INT(11) NOT NULL AUTO_INCREMENT,
    imageUrl VARCHAR(500),
    id_product INT(11),
    ordering INT(50),
    PRIMARY KEY (id_productImage),
    FOREIGN KEY (id_product) REFERENCES products(id_product)
)

CREATE TABLE product_rating(
    id_productRating INT(11) NOT NULL AUTO_INCREMENT,
    id_user INT(11),
    id_product INT(11),
    content TEXT,
    rate INT(5),
    date TIMESTAMP,
    PRIMARY KEY (id_productRating),
    FOREIGN KEY (id_user) REFERENCES user(id_user),
    FOREIGN KEY (id_product) REFERENCES products(id_product)
)

CREATE TABLE store_product(
    id_storeProduct INT(11) NOT NULL AUTO_INCREMENT,
    id_store INT(11),
    id_product INT(11),
    id_size INT(11),
    quantity INT(255),
    date TIMESTAMP,
    PRIMARY KEY (id_storeProduct),
    FOREIGN KEY (id_store) REFERENCES store(id_store),
    FOREIGN KEY (id_product) REFERENCES products(id_product),
    FOREIGN KEY (id_size) REFERENCES sizes(id_size)
)