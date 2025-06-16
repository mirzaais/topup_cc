FROM php:8.1-cli

WORKDIR /app

COPY . .

CMD [ "sh", "-c", "php -S 0.0.0.0:$PORT boilerplate/index.php" ]