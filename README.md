# First time run

```bash
docker run --name laravel -p 8000:8000 -v ${PWD}:/app bitnami/laravel:latest
```
# Stop/Start/Remove

```bash
docker container stop laravel
docker container start laravel
docker container rm laravel
```

# Run commands inside container

```bash
# Rebuild autoload.
docker container exec laravel composer dump-autoload

# Run tests.
docker container exec laravel php ./vendor/bin/phpunit
docker container exec laravel php ./vendor/bin/phpunit --filter NotificationControllerTest

# To have controll on input in case of tinker or if a command expects console input.
docker container exec -it laravel php artisan tinker
```

# API requests example
```bash
curl -X POST \
 -H "Content-Type: application/json" \
 -H "X-Requested-With-Api-Key: superSecretApiKe1y" \
 --data '{"to": "john@doe.com"}' \
 http://localhost:8000/api/notifications/send
```
