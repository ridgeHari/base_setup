init:
	docker-compose up -d --build
	docker-compose exec app composer install
	docker-compose exec app npm install
	docker-compose exec app php artisan storage:link
	docker-compose exec app chmod -R 775 storage resources
	docker-compose exec app chown -R $(shell id -u):www-data /var/www/src
	docker-compose exec app php artisan key:generate
	docker-compose exec app php artisan migrate:fresh
	docker-compose exec app php artisan db:seed
	docker-compose exec app php artisan config:clear
	docker-compose exec app npm run dev
start:
	docker-compose up -d --build
	docker-compose exec app php artisan config:clear
	docker-compose exec app npm install
	docker-compose exec app npm run build
	docker-compose exec app npm run dev