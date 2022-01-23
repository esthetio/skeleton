SCRIPT_DIR="$(dirname "$0")"

docker run --rm \
  -p 8080:8080 \
  -w /project -v "$(pwd)":/project \
  --env-file "$SCRIPT_DIR/.env" \
  -u "$(id -u):$(id -g)" \
  berrymore/php:8.1.1-fpm-base ./rr serve
