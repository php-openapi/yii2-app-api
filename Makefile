
default:
	@echo "The following commands are available:"
	@echo ""
	@echo "  make start        start PHP built-in webserver"
	@echo "  make stop         stop PHP built-in webserver"

# start PHP built-in webserver
start:
	@echo "Starting server for api"
	cd api && $(MAKE) start
	@echo "Starting server for backend"
	cd backend && $(MAKE) start

# stop PHP built-in webserver
stop:
	cd api && $(MAKE) stop
	cd backend && $(MAKE) stop

test:
	cd api && $(MAKE) test

clean: stop

.PHONY: start stop clean test

docker-up: config/components-dev.local.php config/components-test.local.php env.php stop
	docker-compose up -d
	docker-compose exec backend-php sh -c 'cd /app && composer install'
	@echo ""
	@echo "API:      http://localhost:8337/"
#	@echo "API docs: http://localhost:8337/docs/index.html" # not yet :)
	@echo "Backend:  http://localhost:8338/"
	@echo ""

cli:
	docker-compose exec backend-php bash

# copy config files if they do not exist
config/components-%.local.php: config/components-ENV.local.php
	test -f $@ || cp $< $@
env.php: env.php.dist
	test -f $@ || cp $< $@
