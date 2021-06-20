## Step 1
cd back end

## Step 2
composer install

## Step 3
copy .env.example .env


## Step 4
php artisan key:generate

## Step 3
php artisan jwt:secret

## Step 3
php artisan migarate:fresh --seed