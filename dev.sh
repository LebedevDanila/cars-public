docker compose -f docker-compose.dev.yml up -d --build
docker compose -f docker-compose.dev.yml exec -it backend php artisan cache:clear
docker compose -f docker-compose.dev.yml exec -it backend php artisan migrate:fresh --seed