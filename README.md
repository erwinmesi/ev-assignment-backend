# Eastvantage Assignment
This project is part of the requirements for my, Erwin Mesias, application as Full Stack Developer to Eastvantage.

## Installation

### Running the application using Docker

```
docker compose -p ev_assignment up --build -d
```

### Copy .env.example into .env
cp .env.example .env

Replace:
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

Interact with the `db` container

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
```
php artisan migrate --seed
```

## Default Super Admin Credentials

Kindly view the `.env` for the default Super Admin credentials:
```
DEFAULT_USER_EMAIL=
DEFAULT_USER_PASSWORD=
```
