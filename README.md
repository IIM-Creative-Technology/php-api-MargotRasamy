# Secured API students grade platform
##Framework : Laravel


## To see the project :

### Install PHP (at least 7.4 version) and MySQL 
Install [laragon] for Windows (https://laragon.org/)
Install [mamp] for MacOS (https://www.mamp.info/)

### Install a database reader such as TablePlus or SequelPro
Install [tableplus] for Windows (https://tableplus.com/)
Install [mysequelpro] for MacOS (https://www.sequelpro.com/)

### Install a client request tester such as Postman
Install [postman] (https://www.postman.com/downloads/)

### Install Composer 1

https://getcomposer.org/

### Clone the project

```console
git clone git@github.com:IIM-Creative-Technology/php-api-MargotRasamy.git
```

### Install the dependencies

* Enter the cloned directory in your terminal : 

```console
cd php-api-MargotRasamy && composer install
```

### Create a database named api-laravel

* Go on TablePlus or Sequel pro and create a database named api-laravel
* Launch your Php with Laragon or Mamp

### Launch the migrations and seeds

```console
php artisan migrate
```

### Launch the migrations and seeds

```console
php artisan db:seed
```

### Launch the app

```console
php artisan serve
```

### Launch the app

```console
php artisan serve
```

### Start testing routes on Postman

Login with admin accounts :
```console
GET /api/auth/login
```
Use either one of these emails : 
```console
nicolas.rauber@edu.devinci.fr | alexis.gybou@edu.devinci.fr | karine.mousdik@edu.devinci.fr
```
with the password : 
```console
password
```

You can now copy paste the token received and add it to the bearer for any routes :

#### CLASS PROMOTIONS

List of promotions
```console
GET /promotions
```

Get a specific promotion
```console
GET /promotions/{id}
```

Create a promotion
```console
POST /promotions with parameters 'name', 'year'
```

Update a promotion
```console
PUT /promotions/{id}
```

Delete a promotion
```console
DELETE /promotions/{id}
```

#### TEACHERS

List of teachers
```console
GET /teachers
```

Get a specific teacher
```console
GET /teachers/{id}
```

Create a teacher
```console
POST /teachers with parameters 'firstname','lastname','arrival_year'
```

Update a teacher
```console
PUT /teachers/{id}
```

Delete a teacher
```console
DELETE /teachers/{id}
```

#### STUDENTS

List of students
```console
GET /students
```

List of students of a specific promotion
```console
GET /students with query parameters 'promotionId' or 'promotionName' keys
```

Get a specific student
```console
GET /students/{id}
```

Create a student
```console
POST /students with parameters 'firstname','lastname','age','arrival_year','promotion_id'
```

Update a student
```console
PUT /students/{id} with any or all of the post parameters
```

Delete a student
```console
DELETE /students/{id}
```

#### COURSES

List of courses
```console
GET /courses
```

Get a specific course
```console
GET /courses/{id}
```

Create a course
```console
POST /courses with parameters 'name','start_at','end_at','promotion_id','teacher_id'
```

Update a course
```console
PUT /courses/{id} with any or all of the post parameters
```

Delete a course
```console
DELETE /courses/{id}
```

#### SCORES / GRADES

List of scores
```console
GET /scores
```

List of scores of a specific student
```console
GET /scores/{id} with query parameter 'studentId'
```

List of scores of a specific student in a specific course
```console
GET /scores/{id} with query parameter 'studentId', 'courseId'
```

Create a score for a student in a specific course
```console
POST /scores with parameters 'score', 'student_id', 'course_id'
```

## Enjoy the API !

© Margot RASAMY - 2021
