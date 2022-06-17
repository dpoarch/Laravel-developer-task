## Laravel Developers Task


## Backend Setup
Follow the instructions below to setup the Backend:

1. Open a CLI and navigate on `backend` directory.

2. Run command `composer install` to setup required package dependencies.

3. Configure `.env` environment file to your `mysql` User/DB credentials.

4. Run command `php artisan migrate`.

5. Run command `php artisan passport:keys` to generate api keys.

6. Serve the backend with command `php artisan serve`.


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
```
http://127.0.0.1:8000/api/send_subscription
```
```js
{
"newsletter_id" : "",
"name" : "",
"email" : "",
"subject" : ""
}
```



```
http://127.0.0.1:8000/api/confirm_subscription
```
```js
{
"newsletter_id" : "",
"email" : "",
"state" : "",
}
```


```
http://127.0.0.1:8000/api/unsubscribe
```
```js
{
"id" : "",
"newsletter_id" : "",
}
```


```
http://127.0.0.1:8000/api/login
```

```js
{
"email" : "",
"password" : "",
"remember_me" : false
}
```


```
http://127.0.0.1:8000/api/register
```

```js
{
"name" : "",
"email" : "",
"password" : ""
}
```