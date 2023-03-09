To open the code, you should do:   
1- Open XAMPP control panel.
2- Start the Apache and MySQL model as you can see from the ScreenShots.

 (If you have already MySQL Workbench and it causes a warning on XAMPP, you should do this one before going:
 - Open services from windows.
 - Find MySQL80.
 - Right click on it and click stop.
 - Continue with the next steps)
 
3- Go to XAMPP folder (Generally, C:\xampp).
4- Open htdocs folder.
5- Open/Create "phplogin" file and put all my codes there.
6- Go website, Google chrome or etc.
7- Write localhost to search box while XAMPP(apache and MySql) is open.
8- Go phpmyadmin at the top bar.
7- On the page, click Databases at the left of the top bar and create new database as "phplogin" and select utf8_general_ci as the collection.
9- Click the Create button.
10- Select "phplogin" database for the creating the sql table.
11- Click the SQL button at the top.
12- Run this SQL query for creating the account table:
--------------------------------------------------------------------------------------
CREATE TABLE IF NOT EXISTS `accounts` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
  	`username` varchar(50) NOT NULL,
  	`password` varchar(255) NOT NULL,
  	`email` varchar(100) NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
--------------------------------------------------------------------------------------
14- Now, You can go to the login page with "http://localhost/phplogin" or register page with "http://localhost/phplogin/register.html" as you can see from the ScreenShots.
15- You can register and after that login with that account.
16- You will see the all information about the other account as weel as you create the new accounts!
