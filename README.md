# Eastvantage Assignment
This project is part of the requirements for my, Erwin Mesias, application as Full Stack Developer to Eastvantage.

## Installation

### Running the application using Docker

```
docker compose -p ev_assignment up --build -d
```

Go inside the Laravel Container
```
docker exec -it ev_assignment_laravel sh
```

Install project dependencies
```
composer install
```

Copy .env.example into .env
```
cp .env.example .env
```

Generate an Application Key:
```
php artisan key:generate
```

### Prepare DB Connection
In the `.env`, replace:
```
DB_HOST=127.0.0.1
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=
```

With:
```
DB_HOST=db
DB_DATABASE=local_ev_assignment
DB_USERNAME=ev_assignment
DB_PASSWORD=secret
```

### Create `local_ev_assignment` Database

Interact with the `db` container.  
Open a new terminal window and run:

```
docker exec -it ev_assignment_db bash
```

Login with MySQL:
```
mysql -u root -p
````
Then enter password the `MYSQL_ROOT_PASSWORD` value (which is `secret`)

Create `local_ev_assignment` db:
```
CREATE DATABASE local_ev_assignment;
```

Grant the `ev_assignment` user all privileges for the `local_ev_assignment` db:
```
GRANT ALL PRIVILEGES ON local_ev_assignment.* TO 'ev_assignment'@'%';
```

Exit out of MySQL:
```
exit
```

Exit out of the `db` container:
```
exit
```

### Migrate migrations and seeders

Go back into the terminal window where you're running `laravel` container.  

If you already closed it, just interact with it again using:
```
docker exec -it ev_assignment_laravel sh
```

Then run:
```
php artisan migrate --seed
```

That's it, you can now exit out of the `laravel` container:
```
exit
```

## Default Super Admin Credentials

Kindly view the `.env` for the default Super Admin credentials:
```
DEFAULT_USER_EMAIL=
DEFAULT_USER_PASSWORD=
```

You will use that credential to login into the React frontend.
