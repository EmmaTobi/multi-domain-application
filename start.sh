#!/bin/bash
set -e

export VENDOR_EXISTS=../vendor
export LARADOCK_EXISTS=laradock

if [ -d "$LARADOCK_EXISTS" ]; then
    echo "laradock is Initialized"
else
    echo "Initializing laradock"
    git submodule init && git submodule update
fi
echo "Starting Application..."
cp .env.example .env 
echo "Copied .env.example to .env "
cp deploy_config/Caddyfile laradock/caddy/caddy/Caddyfile 
echo "Copied deploy_config/Caddyfile to laradock/caddy/caddy/Caddyfile"
cp deploy_config/.env.example laradock/.env.example \
        && cd ./laradock \
            && cp .env.example .env \
            && docker-compose up -d mysql caddy workspace 
            if [ -d "$VENDOR_EXISTS" ]; then
                echo "Vendor directory already exists. using existing dependencies"    
            else
                echo "Installing Laravel Dependencencies"
                docker-compose exec -T workspace composer install 
            fi
            docker-compose exec -T  workspace php artisan key:generate \
            && docker-compose exec -T workspace php artisan cache:clear \
            && docker-compose exec -T workspace php artisan config:cache \
            && docker-compose exec -T workspace php artisan migrate --seed \

# the -T flag disables pseudo-tty allocation.

