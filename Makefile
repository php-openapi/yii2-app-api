
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
