# Symfony Users Api

## Requirements
If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started
Run the following commands inside the project folder: 
```
./sail up -d && ./sail setup-project
```

* When the commands finish running, you can start to open http://localhost
* The commands above already configure the whole project and leave it running
* If there is any docker command or any php/composer command to run simply use the `sail` script (for example, `./sail composer test`)
* If you wish to run the tests simply run `./sail composer test`

## Objective
* Write a simple API (using the Symfony Framework) to display a list of users, create new users, and change or delete an existing user.
* The aim is to exchange the data source (e.g. a database, an XML file, ...) for users without having to touch the code that uses the data source and returns the response.
* Please provide documentation on how to use the API.
```
{
    data: object
    message: 'error message if any'
}
```
### Examples:
* HTTP GET http://localhost/users
 ```
 {
     data: [
        {
            userId:1,
            name:'John',
            email:'john@email.com',
        },
        {
            userId:2,
            name:'Mary',
            email:'mary@email.com',
        },
        {
            userId:3,
            name:'Edward',
            email:'edward@email.com',
        }
    ]
 }
 ```
* HTTP POST http://localhost/users
 ```
 {
     data: null,
     message: 'Invalid email was specified'
 }
 ```
