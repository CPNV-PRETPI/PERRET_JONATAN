Use FitFocus;
CREATE TABLE users
(
    id INT AUTO_INCREMENT,
    secure_string VARCHAR(256) NOT NULL, # 256 to store the hash of the secure_string
    username VARCHAR(32) NOT NULL,      # 32 is enough to store the username
    policies VARCHAR(1024) NULL,        # 1024 is enough to store the policies, the user may have a lot
    CONSTRAINT users_pk
        PRIMARY KEY (id),
    CONSTRAINT users_uq_secure_string
        UNIQUE (secure_string),
    CONSTRAINT users_uq_username
        UNIQUE (username)
);
