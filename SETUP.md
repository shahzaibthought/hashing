## Steps To Clone Project:-

git clone git@github.com:shahzaibthought/hashing.git

cd hashing

composer install

cp .env.example .env

php artisan key:generate

php artisan migrate

php artisan serve

## API Endpoints:-

Hashing of URL:-

POST /api/hashed-urls

Payload:- { 
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
