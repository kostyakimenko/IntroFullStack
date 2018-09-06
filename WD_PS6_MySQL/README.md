### Application requirements

* PHP version 7.0 or higher

### Database creating

Before using the application, you need to create a database and necessary tables - users and messages.

##### Install mysql-server and create database
https://support.rackspace.com/how-to/installing-mysql-server-on-ubuntu/

##### Create users table

```
CREATE TABLE users
(
    id int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT, 
    username VARCHAR(30) NOT NULL,
    password VARCHAR(255) NOT NULL
);
CREATE UNIQUE INDEX users_username_uindex ON users (username);
```

##### Create messages table

```
CREATE TABLE messages
(
    id int unsigned PRIMARY KEY NOT NULL AUTO_INCREMENT,
    message VARCHAR(255) NOT NULL,
    user VARCHAR(30) NOT NULL,
    time TIMESTAMP
);
```

### Change configuration data

After database and tables creating you must make changes to the configuration file `config.php`

```
'database' => [
        'hostname' => 'localhost', 
        'username' => 'user', 
        'password' => '0000', 
        'dbname' => 'chat' 
    ]
```

Change 'localhost', 'user', '0000', 'chat' to your data.