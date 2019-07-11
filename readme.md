# iceCourse

A Laravel  api resource appication for courses

## USE Guide
- This solution uses laravel passport(password grant) to implement JWT
- When Setting Up please run php artisan passport:install after all migrations
- Note the client_secret and client_id generated for password grant
- - App Domain http://icecourse.herokuapp.com
- Posman Collection https://www.getpostman.com/collections/ed033f256485dd7c6624 (Import to postman to test)
- [![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/ed033f256485dd7c6624)

- Register
    Method: POST
    URL: http://icecourse.herokuapp.com/api/v1/register
    HEADER: Content-Type : application/json
    BODY: 
    {
        "email" : "tester1@gmail.com",
        "name" : "tester tester",
        "password" : "password",
        "password_confirmation" : "password"
    }
- Login
    Method: POST
    URL: http://icecourse.herokuapp.com/oauth/token
    HEADER: Content-Type : application/json
    BODY: 
    {
        "grant_type":"password",
        "client_id":"2",
        "client_secret":"aKkYW8iRS67ZbMZWRb4QHJGnrZ0nhGJdsC5WWyBw", //see php artisan passport:install output
        "username":"tester1@gmail.com", //your email
        "password":"password", //your password
        "scope":"*"
    
    }
## Your will get access_token required for the following endpoint from the Login endpoint
- Seed Course Table
    Method: GET
    URL: http://icecourse.herokuapp.com/oauth/token
    HEADER: Content-Type : application/json
            Authorization : Bearer <access_token>
    BODY: 
    {
        "grant_type":"password",
        "client_id":"2",
        "client_secret":"aKkYW8iRS67ZbMZWRb4QHJGnrZ0nhGJdsC5WWyBw",
        "username":"tester1@gmail.com",  //your email
        "password":"password", //your password
        "scope":"*"
    }

- Register Courses
    Method: POST
    URL: http://icecourse.herokuapp.com/api/v1/courses/user/register
    HEADER: Content-Type : application/json
            Authorization : Bearer <access_token>
    BODY: 
    {
	    "courses":[5,4,7,1] //this is and array of courses ids to register for
    }
- List Courses
    Method: GET
    URL: http://icecourse.herokuapp.com/api/v1/courses
    HEADER: Content-Type : application/json
            Authorization : Bearer <access_token>
    BODY: 
-   Download Courses CSV REPORT
    Method: GET
    URL: http://icecourse.herokuapp.com/api/v1/courses/download/csv
    HEADER: Content-Type : application/json
            Authorization : Bearer <access_token>
    BODY: 
    //note that this endpoint returns a file.

    //this is my personal Authorization
- Bearer  eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmOGMwYzlmMDdjNGU0NmYyZTk0OTI0OWZkM2U1NTA3MDAxYzU5NjgyYzk2M2IwYTAwZjEyYjk0NDBmMzk3NDIwMjQzZTBkZjE0NDViMGNkIn0.eyJhdWQiOiIyIiwianRpIjoiMmY4YzBjOWYwN2M0ZTQ2ZjJlOTQ5MjQ5ZmQzZTU1MDcwMDFjNTk2ODJjOTYzYjBhMDBmMTJiOTQ0MGYzOTc0MjAyNDNlMGRmMTQ0NWIwY2QiLCJpYXQiOjE1NjI4MTM1MjAsIm5iZiI6MTU2MjgxMzUyMCwiZXhwIjoxNTk0NDM1OTIwLCJzdWIiOiIyIiwic2NvcGVzIjpbIioiXX0.hEwSAQ1zTJKuH4JUSpDJSucqnGkDPvzhPD_E45EcjYgEE3n_9zi3WNRFMNodSWMtlPVFmNWhtUf5bBz2JGfoMJPlmwm1cy5HRlfpDQfA43d-CgMFlvW6yn25314jJrta2-OwTI26t-0-OaVWX0iiB25MqVTIVcGCnRHuS3fb2UIkiHSohlJlyD3BZGK5e61kpui_4IV-LW5rbIuLEtLFdz61W1NfDVOtTyMeI5FNS8OPebNiA-3m1v5QdROJGeZDDxMa30gk6ilHhUO0cDidmt05n65eU3T6dKooK93wogebzjNG5sJXuNlACw8QyfJf8Ybv39sYeqS-9YXcuunn6rz2cKLOE7s4WbKc7MdJVL4AyhYZ5yIqZ4_-IU2YNMuvksVIZJhU-KNrY3Qq0BBq_4L6UwN0XCqkmYqlXLdD1Bb9gvy1O3d3dKV8y0KucVfZ4U1O5XqUgvCWNzcXecgRYF7s6Z3N99DBINtfoPTLOM9KSj9dj6DqYEXeHjotm56on3klNUrhRDVO7SQAWuVAp6EVOvxPSIg-9-qmORaH0ijdL0uwEPZkSMpbg5cD11ALub1ARcpy831k3dyRMD5RWt7nNErzsQjeVZWpciE3toMSyjIUYYQ-gmqoECdmAKVN7p--soNzR7GeclbVT_rp-ejKC-1Da-ERExTruoTjor8
- The Course List endpointed is paginated: And Can be navigated using the links and metadata provided in the limk section of the response body. always append api_token=<API_TOKEN> to the links before sending request

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/ed033f256485dd7c6624)

## License

The Laravel framework is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).
