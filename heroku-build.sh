# Because the build process installs only production dependencies,
# we need to temporarily install `Scribe` and generate docs before deployment.
composer install knuckleswtf/scribe --no-dev
php artisan scribe:generate
composer remove knuckleswtf/scribe

# Execute database migrations
php artisan migrate --force

# Run optimizations
php artisan config:cache
php artisan route:cache
