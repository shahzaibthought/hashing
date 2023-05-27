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
  "id": 1,
  "url": "https://www.linkedin.com/company/zigsaw-consultancy-services/",
  "hash": "1ad5be0d",
  "hashedUrl": "http://127.0.0.1:8000/hashed-urls/1ad5be0d",
  "clicks": 0,
  "createdAt": "2023-05-26T22:17:58.000000Z",
  "updatedAt": "2023-05-27T01:24:18.000000Z"
}

Redirection to URL:-

GET http://127.0.0.1:8000/hashed-urls/1ad5be0d

It will redirect us to the URL attached with this hashed URL.

Clicks of URL:-

GET /api/hashed-urls/{hash}

Response:- {
  "id": 1,
  "url": "https://www.linkedin.com/company/zigsaw-consultancy-services/",
  "hash": "1ad5be0d",
  "hashedUrl": "http://hashing.testing/hashed-urls/1ad5be0d",
  "clicks": 45,
  "createdAt": "2023-05-26T22:17:58.000000Z",
  "updatedAt": "2023-05-27T01:55:31.000000Z"
}

## Run the tests:-

php artisan test tests/Unit/HashedUrlRepositoryTest.php
