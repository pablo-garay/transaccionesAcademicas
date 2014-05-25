CREATE TABLE user_password_reset
(
    request_key VARCHAR(32) NOT NULL,
    user_id INT NOT NULL,
    request_time DATE NOT NULL,
    PRIMARY KEY(request_key),
    UNIQUE(user_id)
)
