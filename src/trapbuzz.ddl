CREATE TABLE Users(
        userName VARCHAR(30) NOT NULL,
        firstName VARCHAR(30) NOT NULL,
        lastName VARCHAR(30) NOT NULL,
        email VARCHAR(30) NOT NULL,
        password TEXT NOT NULL,
  			profilePic MEDIUMBLOB,
        aboutMe LONGTEXT,
        PRIMARY KEY(userName)
);

CREATE TABLE blogPost(
        blogId INT AUTO_INCREMENT PRIMARY KEY,
        blogTitle VARCHAR(255) NOT NULL,
        blogContent LONGTEXT NOT NULL,
        blogDate datetime NOT NULL,
        blogType VARCHAR(50) NOT NULL,
  			blogPic MEDIUMBLOB,
        userName VARCHAR(30),
        FOREIGN KEY (userName) REFERENCES Users(userName)
);

CREATE TABLE Comment(
        commentId INT AUTO_INCREMENT,
        commentContent LONGTEXT NOT NULL,
        commentDate DATETIME,
        userName VARCHAR(30) NOT NULL,
        blogId INT NOT NULL,
        PRIMARY KEY(commentId),
        FOREIGN KEY (userName) REFERENCES Users(userName),
        FOREIGN KEY (blogId) REFERENCES blogPost(blogId) ON DELETE CASCADE
);
CREATE TABLE LikePost(
        likeId INT AUTO_INCREMENT PRIMARY KEY,
        blogId INT,
        userName VARCHAR(30) NOT NULL,
        FOREIGN KEY(blogId) REFERENCES blogPost(blogId) ON DELETE CASCADE,
        FOREIGN KEY(userName) REFERENCES Users(userName)
);

CREATE TABLE Admin(
  userAdmin VARCHAR(30) NOT NULL,
  passwordAdmin TEXT NOT NULL
);
