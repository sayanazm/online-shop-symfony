set -e

echo "⏳ Waiting for test database to be ready..."

until docker-compose exec -T db pg_isready -U user_db -d online_shop_db_test > /dev/null 2>&1; do
  sleep 1
done

echo "✅ Test database is up"

docker-compose exec -T app php bin/console doctrine:database:create --env=test --if-not-exists

docker-compose exec -T app php bin/console doctrine:migrations:migrate --env=test --no-interaction

echo "✅ Test database prepared"