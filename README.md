
# EV route planner

Instantly find charging stations nearby

## Environment Variables

To run this project, you will need to add the following environment variables to your .env file

`DB_DATABASE`
`DB_USERNAME`
`DB_PASSWORD`
`MAP_KEY`

## Installation

Clone EV route planner

``` 
  git clone https://github.com/rrRRohith/ev.git
```

Go to the project directory

```bash
  cd ev
```

Install dependencies

``` 
  composer install
```

Run migration

``` 
  php artisan migrate
```

Run seeder

``` 
  php artisan db:seed --class=UserSeeder
```

Start application

``` 
  php artisan serve
```

Login to admin

``` 
  email    : test@example.com
  password : secret
```

## Screenshots

![App Screenshot](https://res.cloudinary.com/rr6/image/upload/v1679110263/FireShot_Capture_001_-_EV_-_Instantly_find_charging_stations_nearby_-_EV_-_127.0.0.1_anlr2x.png)

