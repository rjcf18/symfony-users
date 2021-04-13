# Symfony Users Api

## Requirements
If not already done, [install Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started
In order to set up the project and get it up and running run the following command inside the project folder root: 
```
./sail setup-project
```

* When the command finishes running, you can start to open http://localhost and use the API
* The command above already configures the whole project and leaves it running.
* If you wish to run the tests simply run `./sail test` or `./sail composer test`
* If there is any docker compose command or any php/composer command to run simply use the `sail` script (for example, `./sail composer test` or `./sail ps`)

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
