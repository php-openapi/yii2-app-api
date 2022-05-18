# set user to "root" to run commands as root in docker
USER=$$(whoami)
# The docker command to execute commands directly in docker
DOCKER=docker-compose exec --user=$(USER) backend-php
# The PHP binary to use, you may add arguments to PHP here
PHP=php
# directories writeable by webserver
WRITEABLE_DIRS=/app/runtime /app/logs /app/backend/web/assets


# default target lists general usage information
default:
	@echo "The following commands are available:"
	@echo ""
	@echo "  make start          start PHP built-in webserver"
	@echo "  make stop           stop PHP built-in webserver"
	@echo "  make start-docker   start docker environment"
	@echo "  make stop-docker    stop docker environment"
	@echo "  make cli            run bash in docker environment"
	@echo "  make bash           alias for 'make cli'"


.PHONY: start stop start-docker stop-docker clean test bash cli


## PHP runtime ##

# start PHP built-in webserver
start: config/components-dev.local.php config/components-test.local.php backend/config/cookie-validation.key env.php
	@echo "Starting server for api"
	cd api && $(MAKE) start
	@echo "Starting server for backend"
	cd backend && $(MAKE) start

# stop PHP built-in webserver
stop:
	cd api && $(MAKE) stop
	cd backend && $(MAKE) stop


## Docker Runtime ##

# run bash inside docker container
bash: cli
cli:
	$(DOCKER) bash

start-docker: runtime/build-docker config/components-dev.local.php config/components-test.local.php backend/config/cookie-validation.key env.php stop
	docker-compose up -d
	docker-compose exec -T backend-php bash -c "grep '^$(shell whoami):' /etc/passwd || useradd -m '$(shell whoami)' --uid=$(shell id -u) -G www-data -s /bin/bash"
	docker-compose exec -T backend-php bash -c "sed -i 's/#force_color_prompt=yes/force_color_prompt=yes/' /home/$(shell whoami)/.bashrc && sed -i 's~etc/bash_completion~etc/bash_completion.d/yii~' /home/$(shell whoami)/.bashrc"
	docker-compose exec -T backend-php bash -c "chgrp -R www-data $(WRITEABLE_DIRS) && chmod -R g+w $(WRITEABLE_DIRS)"
	$(DOCKER) sh -c 'cd /app && composer install --no-progress --no-interaction --ansi'
	@echo ""
	@echo "API:      http://localhost:8337/"
#	@echo "API docs: http://localhost:8337/docs/index.html" # not yet :)
	@echo "Backend:  http://localhost:8338/"
	@echo ""

stop-docker:
	docker-compose down

runtime/build-docker: */Dockerfile
	docker-compose build
	touch $@

# copy config files if they do not exist
config/components-%.local.php: config/components-ENV.local.php
	test -f $@ || cp $< $@
env.php: env.php.dist
	test -f $@ || cp $< $@
backend/config/cookie-validation.key:
	test -s $@ || php -r 'echo bin2hex(random_bytes(20));' > $@
