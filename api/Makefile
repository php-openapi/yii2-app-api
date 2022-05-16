# additional arguments to PHP binary
PHPARGS=
# enable XDEBUG for the test runner
XDEBUG=0
# enable XDEBUG for the webserver
XDEBUGW=0

WEBPORT=8337

ifeq ($(XDEBUG),1)
  XDEBUGARGS=-dzend_extension=xdebug.so -dxdebug.mode=debug,develop -dxdebug.start_with_request=yes -dxdebug.discover_client_host=yes -dxdebug.remote_enable=1 -dxdebug.remote_autostart=1
endif
ifeq ($(XDEBUGW),1)
  XDEBUGARGSW=-dzend_extension=xdebug.so -dxdebug.mode=debug,develop -dxdebug.start_with_request=yes -dxdebug.discover_client_host=yes -dxdebug.remote_enable=1 -dxdebug.remote_autostart=1
endif


current_dir=$(shell pwd)

default:

start: stop
	@echo "Starting PHP webserver at http://localhost:$(WEBPORT), see logs/php-api.log for access log."
	@echo ""
	@echo "Run  make stop  to stop it."
	@echo ""
	YII_ENV=dev php $(PHPARGS) $(XDEBUGARGSW) -S localhost:$(WEBPORT) -t web $(current_dir)/router.php >../logs/php-api.log 2>&1 & echo "$$!" > php.pid

stop:
	@echo "Stopping PHP webserver..."
	@-if [ -f php.pid ] ; then kill $$(cat php.pid); fi
	@rm -f php.pid
	@rm -f session_mm_*.sem

clean: stop
	rm -f php.log

.PHONY: start stop  clean
