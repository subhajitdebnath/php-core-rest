# php-core-rest

Apis:

Register API Endpoint: POST `http://localhost/php-rest/api/register.php`
Body: `{
    "name": "Test Name",
    "email": "test@mail.com",
    "password": "123456"
}`

Login API Endpoint: POST `http://localhost/php-rest/api/login.php`
Body: `{
    "email": "test@mail.com",
    "password": "123456"
}`


Profile API Endpoint: POST `http://localhost/php-rest/api/user-profile.php`
Header: 
`Content-Type:application/json
Authorization:Bearer Token`
