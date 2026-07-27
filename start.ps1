# start.ps1 - Bring the Laravel app + tunnel back up.
# Usage:  .\start.ps1            (build assets + start tunnel)
#         .\start.ps1 -NoBuild   (skip the asset rebuild)
#         .\start.ps1 -NoNgrok   (don't start the ngrok tunnel)

param(
    [switch]$NoBuild,
    [switch]$NoNgrok
)

$ErrorActionPreference = "Stop"
Set-Location -Path $PSScriptRoot

Write-Host "==> Starting Docker stack (app + nginx + mysql)..." -ForegroundColor Cyan
docker compose up -d

Write-Host "==> Removing stale Vite hot file (forces built assets)..." -ForegroundColor Cyan
if (Test-Path "public/hot") { Remove-Item "public/hot" -Force }

if (-not $NoBuild) {
    Write-Host "==> Building front-end assets (npm run build)..." -ForegroundColor Cyan
    npm run build
} else {
    Write-Host "==> Skipping asset build (-NoBuild)." -ForegroundColor Yellow
}

Write-Host "==> Clearing Laravel caches..." -ForegroundColor Cyan
docker compose exec -T app php artisan view:clear
docker compose exec -T app php artisan config:clear

Write-Host "==> Container status:" -ForegroundColor Cyan
docker compose ps

Write-Host ""
Write-Host "Local app:  http://localhost:8000" -ForegroundColor Green

if (-not $NoNgrok) {
    Write-Host "==> Starting ngrok tunnel on port 8000 (Ctrl+C to stop)..." -ForegroundColor Cyan
    ngrok http 8000
} else {
    Write-Host "==> Skipping ngrok (-NoNgrok). Start it manually with: ngrok http 8000" -ForegroundColor Yellow
}
