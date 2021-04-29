# PHPCRUDLib

PHPCRUDLib is simple code to help you do CRUD in minutes. :heart:

It is a 'peanut' :blush: library (or let's say petite file but awesome:sparkles:, because peanut taste good :yum:)

To know more about what CRUD is, click <a href='https://www.google.com/search?q=CRUD' target='_blank'>here</a>

It is just a single file. You add it to your project and boom :boom:!!! You're done! **No need to 'master' SQL before you CRUD** :smile:

*Eg*
```php
//saving new record into table
$PHPCRUDLib->name ='Pepsi Cola';
$PHPCRUDLib->user_id =1;
$PHPCRUDLib->created_at =date('Y-m-d H:i:s');
$PHPCRUDLib->save();
```
### Support
<img src="https://pngimg.com/uploads/mysql/mysql_PNG23.png" alt="MySQL" width="70px" > &nbsp; &nbsp;  <img src="https://cdn.holistics.io/landing/databases/mariadb.png" alt="MariaDB" width="130px">  &nbsp; &nbsp;  <img src="https://res.cloudinary.com/practicaldev/image/fetch/s--gaI7Ff9D--/c_limit%2Cf_auto%2Cfl_progressive%2Cq_auto%2Cw_880/https://thepracticaldev.s3.amazonaws.com/i/6lu26u1oaysf8cdfiiux.png" alt="PostgreSQL" width="100px">

***
## *CONFIGURATION*
 `DBConfig.php`
**You have to edit this file to fit your database connection credentials**

```php
$dbms  //DBMS eg. mysql
$host  //database host eg. localhost
$port  // database port eg. 3306
$user  // database user eg. root
$pass //password of database user eg. p@ssw0rd
$dbname  // database name eg. sales_db
```

***
## *USAGE*
Download or clone this repo.
After you have downloaded or cloned the repo, place the folder in any directory inside your project.

Then put this code in the file you want to perform your CRUD operations
```php
//add or include library to file
include '../PHPCRUDLib.php';
use PHPGrammers\PHPCRUDLib as PHPCRUDLib;
//define table name
$table = 'products';
//create library object and pass the table name to it
$PHPCRUDLib = new PHPCRUDLib($table);
```

So the important thing is to pass the table name to **PHPCRUDLib()** that is **PHPCRUDLib($argument)** where **argument** is the table name

You do not have to always repeat this **`$PHPCRUDLib  = new PHPCRUDLib($table_name);`**, Once you are **_CRUDing_** on the same **table** in the same file, you only write it once.

And it is not compulsory to use this variable **$PHPCRUDLib**, you can use any variable of your choice

***
## *SAMPLE*
Once the above is done, you can then go ahead and perform your CRUD swiftly

**Save new record into table Eg.1**
```php
$PHPCRUDLib = new PHPCRUDLib($table_name);
$PHPCRUDLib->name ='Pepsi Cola';
$PHPCRUDLib->user_id =1;
$PHPCRUDLib->created_at =date('Y-m-d H:i:s');
$PHPCRUDLib->save();
```

**Save new record into table Eg.2**
```php
$products = new PHPCRUDLib($table_name);
$products->name ='A1 Bread';
$products->user_id =2;
$products->created_at =date('Y-m-d H:i:s');
$products->save();
```

**update record**
```php
//update records using id
$PHPCRUDLib->name ='Malta Guinness';
$id = 5;
$PHPCRUDLib->update($id);
```
This code strictly depends on column name **id** so your primary key or unique must be **id**

**delete single record**
```php
//delete one record using id
$id = 3;
$PHPCRUDLib->delete($id);
```
This code strictly depends on column name **id** so your primary key or unique must be **id**

**select all records**
```php
//select all records in table
$result = $PHPCRUDLib->allRecords();
```

## *UPDATES/ FIXES*
Feel free to raise issues if your find any bugs or concerns and PR if you have any contributions to make.

**More updates and awesome improvements coming soon** :+1: :fire:
