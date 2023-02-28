	
	The project is simple CRUD operation, the front end is based on html and css using bootstrap and
	the backend is based on php and mariadb.

	Introduction:
	It's a simple crud operation based web application. The process is taking the input from user and
	storing the data in database.
	It's called Blog web application. where user need to register to a member and then the user can write
	 the content and share with public. 
	The user can edit the content after submission or removed the record. However, Admin of the websites 
	have the same rights to edit user content 
	or remove the record.
	
	Prerequistes:
	the whole application are built in ubuntu operating system, Visual Code Studio IDE used to implement 
	the application. The frontend application are
	implemented using HTML, CSS (bootstrap) and the backend application are implemented using PHP and 
	mariadb for storing the data in database. Along with this
	a javascript and jquery are used to implement popup message for dialogue and for pagination. Apache2 
	webserver are used for intereaction between frontend and backend.
	
	Installation:
	To run the application, the following required software mustbe installed in operating system. 
	such as Visual Code Studio IDE, Apache2, php, mariadb.
	The code must be availble in public html directory in ubuntu operating system. And the application 
	run in any browser, however, i used google chrome browser.
	
	USAGE:
	The first and main webpage of the application is index.php in which the user can interact and see all 
	created content in the homepage. 
	the whole application contains very few pages such as register.php, login.php, aboutme.php, profile.php,
	view.php,write.php, edit.php
	
	the index.php in which all users created blog title displayed in table with the recent one in the first 
	section. when the user click the title it open view.php,
	in which the content are displayed with the title, authurname, created date and the description.
	
	in aboutme.php page the whole content is same where as the user can edit or delete the content. the edit.php
	 page contain the input fields in which the user can rewrite the title and 
	description and check box if the user want to show the title in the header. And delete is simple logic. 
	the delete button execute a popup message for confirming with the user to delete or not.
	
	login.php is authentication page to check whether the user is member of the web application. And registeration.php
	 is for the user to share the input with the application to be a memebr.
	
	write.php and edit.php both are similar except in write.php the user write the content first time and there won't
	 be any old title or description.
	
	
	The whole application are based on class and objects, the class name is 'User' and '$user' is object in which the
	 required arguments are passed.
	
	
	The admin login :admin
	ppassword: 123
	
	other users login : johnwick
	password : Clarkie
	
