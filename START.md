# Start / Reopen Guide

How to bring the app back up after closing everything (PC restart, stopped Docker, closed ngrok).

## Quick start (one command)

```powershell
.\start.ps1
```

This starts Docker, rebuilds assets, and opens the ngrok tunnel on port 8000.

## Manual steps

```powershell
# 1. Start the Docker stack (app + nginx + mysql)
docker compose up -d

# 2. Rebuild front-end assets (needed if you last ran `npm run dev`)
npm run build

# 3. Start the tunnel — port 8000, NOT 80
ngrok http 8000
```

Open the ngrok URL it prints. The local app is at http://localhost:8000.

## Important rules

- **DB / artisan commands run inside the container** (so the `db` host resolves):
  ```powershell
  docker compose exec app php artisan migrate
  docker compose exec app php artisan migrate:fresh --force   # wipes + reseeds DB
  ```
- **Always tunnel port 8000**, never 80 (port 80 is XAMPP).
- **Never run `npm run dev` while sharing via ngrok** — it creates `public/hot`,
  which points assets at the local Vite dev server and breaks styling through the
  tunnel. Use `npm run build` instead. For normal local dev, `npm run dev` is fine.
- The ngrok URL changes each session unless you have a reserved domain. If it
  changes, update `APP_URL` in `.env` then run:
  ```powershell
  docker compose exec app php artisan config:clear
  ```

## Health check

```powershell
docker compose ps     # app, nginx, mysql should all say "Up"
```

## Stop everything

```powershell
docker compose down    # stop containers (DB data is preserved)
# Ctrl+C in the ngrok window to close the tunnel
```
