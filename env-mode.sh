#!/usr/bin/env bash
# Switches APP_URL / SESSION_SECURE_COOKIE between local (plain HTTP) and ngrok (HTTPS) mode.
#
# Usage:
#   ./env-mode.sh local
#   ./env-mode.sh ngrok                          # auto-detects the running ngrok tunnel
#   ./env-mode.sh ngrok https://xxxx.ngrok-free.dev   # or pass the URL manually
set -euo pipefail

cd "$(dirname "$0")"

MODE="${1:-}"

if [ "$MODE" = "local" ]; then
    NEW_URL="http://localhost:8000"
    SECURE="false"

elif [ "$MODE" = "ngrok" ]; then
    NEW_URL="${2:-}"

    if [ -z "$NEW_URL" ]; then
        echo "Detecting active ngrok tunnel..."
        NEW_URL=$(curl -s http://127.0.0.1:4040/api/tunnels \
            | grep -o '"public_url":"https:[^"]*' \
            | head -1 \
            | cut -d'"' -f4)

        if [ -z "$NEW_URL" ]; then
            echo "Could not auto-detect a running ngrok tunnel (is ngrok started?)."
            echo "Pass the URL manually instead:"
            echo "  ./env-mode.sh ngrok https://xxxx.ngrok-free.dev"
            exit 1
        fi
    fi
    SECURE="true"

else
    echo "Usage:"
    echo "  ./env-mode.sh local"
    echo "  ./env-mode.sh ngrok [https://xxxx.ngrok-free.dev]"
    exit 1
fi

sed -i "s|^APP_URL=.*|APP_URL=${NEW_URL}|" .env
sed -i "s|^SESSION_SECURE_COOKIE=.*|SESSION_SECURE_COOKIE=${SECURE}|" .env

docker compose exec app php artisan config:clear
docker compose exec app php artisan view:clear

echo ""
echo "Switched to '${MODE}' mode:"
echo "  APP_URL=${NEW_URL}"
echo "  SESSION_SECURE_COOKIE=${SECURE}"
