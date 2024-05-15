#!/bin/bash

# Start PHP-FPM
php-fpm -D
#install php dependencies
composer install
# Run npm install initially
npm install
# Run npm run dev initially
#npm run dev    // we will run this command until find the accurate solution
# This script will keep running until the container is stopped
while true; do
    # Add any other startup commands here if needed

    sleep 1
done




# Watch for changes using npm run watch
#npm run watch
