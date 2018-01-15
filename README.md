# mrm_demo_shakh_temp_01
Semester work by Shakhovskiy for ZWA





Documentation






ČVUT FEL SIT
MyRealMotivation.com
Shakhovskiy Daniil

















(2018)
Content
1	The task	3
1.1	Content of the site	3
1.2	Web-application to do list	3
2	introduction	4
3	Used technologies	4
3.1	Technologie	4
3.1.1	PHP	4
3.1.2	HTML, CSS, JavaScript(JS), Ajax	4
4	Instruction	5
4.1	For admin	5
4.2	For Users.	5
4.2.1	5
4.2.2	Users profile(In the future)	8
4.2.3	About	8
4.2.4	New	9
4.2.5	Contacts	9
4.2.6	FAQ	10
4.2.7	MyRealMotivation (main page)	10
5	implementation	11
5.1	Front-End	11
5.1.1	HTML	11
5.1.2	CSS	11
5.1.3	JavaScript	11
5.2	Back-End	11
5.2.1	Config	12
5.3	Database	12
6	Conclusion	12


1	THE TASK
Name: MyRealMotivation (web-application for people motivation)
Target: Motivate people to action
1.1	Content of the site
The project is designed to bring people closer and improve their quality of life through self-motivation. The web application only helps to set goals and achieve them. With the help of this project, you will motivate yourself and try to achieve your goal. 
1.2	Web-application to do list
•	The server part should be in PHP
•	The code must be documented
•	Work must work in full 
2	INTRODUCTION
MyRealMoyivation is a new type of social network. This is the only web application where you can talk about your victories and achievements, set goals and achieve them, read the goals of other people and help them, create something new and strive for better life.
The project is designed to bring people closer and improve their quality of life through self-motivation. The web application only helps to set goals and achieve them. With the help of this project, they will motivate theirselfs and try to achieve theirs goals.

3	USED TECHNOLOGIES
3.1	Technologie
The web application was designed using these technologies
•	HTML5
•	CSS3
•	JavaScript
•	PHP7
•	JSON(Not tested yet)
•	Bootstrap 4
3.1.1	PHP
3.1.1.1	PHPMailer
Code library to send emails safely and easily via PHP code from a web server. Sending emails directly by PHP code.(Not tested)
In PHP I am using standart functions for Data base.
3.1.2	HTML, CSS, JavaScript(JS), Ajax
3.1.2.1	Ajax
An approach to building interactive user interfaces for web applications, which consists in the "background" exchange of browser data with a web server.
3.1.2.2	Bootstrap
A free set of tools for creating websites and web applications. Includes HTML and CSS design templates for typography, web forms, buttons, labels, navigation blocks and other web interface components, including JavaScript extensions.
3.1.2.3	Uploading JS
Web pages are uploading from html and ajax files. JS via ajax downloads the server html template (with the change of information) and displays the main pages in the container.
4	INSTRUCTION
4.1	For admin
For administrators there is no special login now, but they can have access to the host https://www.easyname.com/en , modify files and upload new ones. 20gb = 40 mill users with articles and targets.
4.2	For Users.
This web application can be used by absolutely anyone who has a computer or a smartphone with internet access.
4.2.1	
4.2.1.1	Registartion
To register, click on the login button in the upper right corner. You will go through three stages of registration. First. Enter your name, come up with a nickname, write the email you are using. Second. Check the mail, you will receive the code that you need to enter to confirm your email. Almost everything. The third. Invent, password, choose your avatar, date of birth, gender and your totemic animal.
 

 
Then you will get a code by email.

 
Create a password
 
Choose your icon, your gender date of birth and your totemic animal.

4.2.1.2	LogIn
To login, click on the button in the upper right corner. Write your email or nickname and password.
 


4.2.2	Users profile(In the future)
If you are log in, click on your icon in the upper right corner. Then you will see your profile forms with information about you and special button, which is using for publishing your items. 
When you click on this button, you will see the special web telegra.ph there you can write what ever you want with images, headers and links, like in html, but without html. It’s easy.

4.2.3	About
All information about this web-application, how does it work, why does this application exist etc.
 




4.2.4	New
Special page which contains all new articles from each of themes.
 
4.2.5	Contacts
Temporary tab for communication with the developer. There you can sent a message to him.
 
4.2.6	FAQ
Frequently asked questions page.
 
4.2.7	MyRealMotivation (main page)
The main page with sections on the interests of the user. Created to navigate the user on the topics of interest to his articles. 
 


5	IMPLEMENTATION
All the code is documented right in the files.

5.1	Front-End
5.1.1	HTML
5.1.1.1	New tags
I’m using HTML5 for this application, so I used new tags like header, footer.
5.1.1.2	Bootstrap
Bootstrap v4. 

5.1.2	CSS
5.1.2.1	Bootstrap
Almost all styles were taken from the bootstrap, some were written specifically for certain pages.
5.1.3	JavaScript
Look at 3.3.2.3

5.1.3.1	Forms
All forms on the page are sent using JavaScript (JS). More specifically, it is a jQuery event "onSubmit" that is called when a specific form is sent. 
5.1.3.2	Article button on user profile

5.2	Back-End
With php with queries POST, GET receives information and executes code.
Ajax is used as requests to the server. The page does not have to be rebooted completely
Structure
	/vendor [libraries of Composer]
	composer 
/articlesDB
•	lastids [all id of articles]
•	1-63 files [for articles with id for telegraph(links to articles)]
•	Readnew.php, create.php, delete.php, read.php, new.php, theme.php [working with Data base]
/telegraph
•	preview.php[previews for articles]
•	article.php[upload articles]
/users
•	read.php
•	update.php
•	login.php[controling password]
•	delete.php
•	create.php
•	confirmUsername.php
•	confirmCode.php

5.2.1	Config 
.htaccess – redirect. Apache configuration file
5.3	Database
JSON performs the function of database. In the format .json, the file stores information about our hotly loved users.
6	CONCLUSION 
This project has a big future,  web application exists to bring together motivated people. The main idea and purpose of the project is the dissemination of information between people, mutual assistance in achieving dreams and motivating people to act.

 


