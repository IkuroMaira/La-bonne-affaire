## Clear cache
cache-clear:
	symfony console cache-clear

## Database
### Create a new database
database-create:
	symfony console d:d:c --if-not-exists

### Drop a database
database-drop:
	symfony console d:d:d --force --if-exists

### Make migration
database-migration:
	symfony console make:migration

### Migrate migrations
database-migrate:
	symfony console d:m:m --no-interaction

### Laod fixtures
database-fixtures-load:
	symfony console d:f:l --no-interaction

### Alias : database-migration
migration:
	$(MAKE) database-migration

### Alias : database-migrate
migrate:
	$(MAKE) database-migrate

### Alias : database-fixtures-load
fixtures:
	$(MAKE) database-fixtures-load

### Initialize the database
database-init:
	$(MAKE) database-drop
	$(MAKE) database-create
	$(MAKE) database-migrate
	$(MAKE) fixtures
