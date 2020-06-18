<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## ATG Task 1 (commit: 110ddf849fcfebcde51520fae08e740d27c985df)

Please read and learn about these topics wrt laravel,
- Models, Views, Controller, Routing
- Eloquent ORM https://laravel.com/docs/5.8/eloquent
- OOPS - Classes and Objects
- Develop a basic web application in PHP using Laravel (MVC) framework
- Host the web application on a free web hosting server. Share this URL.
- Deliverables/tasks:
  - Use Laravel eloquent for DB.
  - Controller file name: ATGController.php
   - One user form - three fields - name, email, pincode and SUBMIT
  - Anyone should be able to enter his name, email and his current pincode
   - Backend: Email validation and pincode (6 digits exact) validation
   - On clicking submit, the data should get stored in the database.
   - There should NOT be any duplicate data. So, in case I am entering the same
data twice, I should get a flash message or some notification that the data
already exists in the DB.
   - On successful entering the data, there should be a notification too.
- Github link not to be shared unless asked by hiring manager. Progress will be primarily
tracked via the free web server.
- Proper use of Models, Controllers, Views is mandatory.
- Use of objects using model classes preferred.


## ATG Task 2 

Task 2

- Model, View created in task 1 should NOT be changed in this task. If need arises, ask on
the group with clarification. 
- When user successfully enters new/different data (that is accepted into database), user
should get an email ( for this task, you can just put a LOG statement that ‘EMAIL SENT’
OR you can code that also, if you wish ;-) ). If the email sending fails, we should be able
to LOG that error as well.
- Create a Restful API in a new controller file (WebServicesController.php) for the same
deliverables/tasks in task 1. Choose human readable API request and response with
status:0|1 and message as two mandatory response keys.
- Eloquent and email logic should be moved to a common ‘PHP trait’ file. At end of this
task, there should be NO duplicate statement inside class in both the controllers. Take
your own fair judgement on how will you move the logic into the trait file and reuse that
trait function in both controllers.

Mode of submission:
As part of submission,
- Send a < 30 sec video (with your audio) demonstrating the following:
 - Show your laravel log file. Should be empty or not there.
 - Call the API (using postman). Explain the API response. Log statement should be
recorded that ‘EMAIL SENT’
 - Call the API again (with same parameters). Explain API response. Log statement
should NOT be recorded.
 - Insert same parameters in the web form. Log statement should NOT be seen and
the ERROR message should be seen.
 - Insert new parameters in the web form. Log statement should be seen and the
SUCCESS message should be seen.

## Task 3

Convert your web form to use API for submitting data using AJAX. Use the route/function
in WebServicesController.php file (task 2) and NOT the ATGcontroller.php file (task 1)
on the web application form itself using AJAX.
- There should be no page refreshes at all (that’s what AJAX means).
- Based on the API’s JSON response, AJAX call should be able to determine the
response and show the appropriate message.
- Frontend: Email validation and pincode (6 digits exact) validation