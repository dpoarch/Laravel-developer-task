## Laravel Developers Task


## Backend Setup
Follow the instructions below to setup the Backend:

1. Open a CLI and navigate on `backend` directory.

2. Run command `composer install` to setup required package dependencies.

3. Configure `.env` environment file to your `mysql` User/DB credentials.

```shell
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_dev_task
DB_USERNAME=root
DB_PASSWORD=
```

4. Run command `php artisan migrate`.

5. Run command `php artisan db:seed` --create data with faker

6. Run command `php artisan passport:keys` to generate api keys.

7. Serve the backend with command `php artisan serve`.


## Frontend Setup

1. Open CLI and navigate to `frontend` directory.

2. Run command `npm install` --install required packages.

3. Run command `npm start`

4. Frontend application will run at `localhost:4200`

## API Routes

### [GET] Request
```
http://127.0.0.1:8000/api/newsletters"
```
```
http://127.0.0.1:8000/api/newsletters/{id}
```
```
http://127.0.0.1:8000/api/checkstatus/{id}
```

### [POST] Request

1. URL http://127.0.0.1:8000/api/send_subscription

JSON Request:
```js
{
"newsletter_id" : "",
"name" : "",
"email" : "",
"subject" : ""
}
```




2. URL http://127.0.0.1:8000/api/confirm_subscription

JSON Request:
```js
{
"newsletter_id" : "",
"email" : "",
"state" : "",
}
```



3. URL http://127.0.0.1:8000/api/unsubscribe

JSON Request:
```js
{
"id" : "",
"newsletter_id" : "",
}
```



4. URL http://127.0.0.1:8000/api/login

JSON Request:
```js
{
"email" : "",
"password" : "",
"remember_me" : false
}
```



5. URL http://127.0.0.1:8000/api/register

JSON Request:
```js
{
"name" : "",
"email" : "",
"password" : ""
}
```