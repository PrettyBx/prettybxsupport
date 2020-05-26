.PHONY: all

SHELL=/bin/bash -e

.DEFAULT_GOAL := help

help: ## This help
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "\033[36m%-30s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

phpunit:  ## Run phpUnit tests
	@docker run --rm --interactive --tty   --volume $$PWD:/app   --user $$(id -u):$$(id -g)   composer test

dump-autoload:  ## Dumps composer autoload files
	@docker run --rm --interactive --tty   --volume $PWD:/app   --user $(id -u):$(id -g)   composer dump-autoload
