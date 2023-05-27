## Steps To Clone Project:-

git clone git@github.com:shahzaibthought/hashing.git

cd hashing

composer install

 - Please check `ASSUMPTIONS.md` if it gives an error.

Create a database with name `hashing`

cp .env.example .env

php artisan key:generate

php artisan migrate

  - You should be properly configured below values to make this command run successfully

    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=hashing
    DB_USERNAME=root
    DB_PASSWORD= 

php artisan serve

## API Endpoints:-

Hashing of URL:-

POST /api/hashed-urls

Example:- http://127.0.0.1:8000/api/hashed-urls

Request payload:- {
  "url": "https://www.linkedin.com/company/zigsaw-consultancy-services/"
}

Response:- {
  "url": "http://127.0.0.1:8000/hashed-urls/1ad5be0d"
}

Redirection to URL:-

GET http://127.0.0.1:8000/hashed-urls/1ad5be0d

It will redirect us to the URL attached with this hashed URL.

## Run the tests:-

php artisan test tests/Unit/HashedUrlRepositoryTest.php
