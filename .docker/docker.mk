.PHONY: build
build: ## build environment and initialize composer and project dependencies
	docker build .docker/php$(DOCKER_PHP_VERSION)-dev/ -t $(DOCKER_SERVER_HOST)/$(DOCKER_PROJECT_PATH)/php$(DOCKER_PHP_VERSION)-dev:$(DOCKER_IMAGE_VERSION) \
	--build-arg DOCKER_SERVER_HOST=$(DOCKER_SERVER_HOST) \
	--build-arg DOCKER_PROJECT_PATH=$(DOCKER_PROJECT_PATH) \
	--build-arg DOCKER_PHP_VERSION=$(DOCKER_PHP_VERSION) \
	--build-arg DOCKER_IMAGE_VERSION=$(DOCKER_IMAGE_VERSION)

.PHONY: stop
stop:
	docker-compose stop
