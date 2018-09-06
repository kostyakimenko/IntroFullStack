### Application requirements

* PHP version 7.0
* MySQL version 5.7

### Database creating

Before using the application, you need to create a database and necessary tables - users and messages.

#### 1. Install mysql-server and create database
https://support.rackspace.com/how-to/installing-mysql-server-on-ubuntu/

#### 2. Create tables
Import file with sql script **chat_tables.sql** 

or 

create tables

##### Users table parameters

* table name: users
* column 1
  * name: id
  * type: int
  * attributes: unsigned
  * index: primary
  * auto_increment
  * not null
* column 2
  * name: username
  * type: varchar
  * length: 30
  * index: unique
  * not null
* column 3
  * name: password
  * type: varchar
  * length: 255
  * not null

##### Messages table parameters

* table name: messages
* column 1
  * name: id
  * type: int
  * attributes: unsigned
  * index: primary
  * auto_increment
  * not null
* column 2
  * name: message
  * type: varchar
  * length: 255
  * not null
* column 3
  * name: user
  * type: varchar
  * length: 30
  * not null
* column 4
  * name: time
  * type: timestamp
  * default: current_timestamp
  * not null

#### 3. Change configuration data

After database and tables creating you must make changes to the configuration file **config/config.php**
```
'database' => [
        'hostname' => 'localhost', 
        'username' => 'user', 
        'password' => '0000', 
        'dbname' => 'chat' 
    ]
```

Change 'localhost', 'user', '0000', 'chat' to your data.