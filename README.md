# Race conditions example in Laravel

Race conditions are useful when there are different users that could potencially make the same transaction, like bookings when there is a requirement to lock the transaction.

🚀 ## Start the project

Clone the project & Install dependencies:

```
git clone git@github.com:ArielMejiaDev/race-conditions-example.git
cd race-conditions
composer install
npm install
```

💾 ## Set the database

Take in mind that queue and cache drivers do not work with SQLite

Race conditions rely on a queue and cache driver that support both a great choice for this example is `database`, 
so please check both values in the `.env` file and the database name are correct before executing this commands:

```
CREATE DATABASE [IF NOT EXISTS] race_conditions. [CHARACTER SET charset_name] [COLLATE collation_name];
cp .env.example .env
php artisan key:generate
```

🏃🏻 ## Run the project

```
npm run dev
```

Open other terminal and run queue worker:

```
php artisan queue:work
```

Now open the browser in: `localhost:80/race-conditions`

There is a test user:

```
email: johh@doe.com
password: password
```

You can register and login with your own user.
