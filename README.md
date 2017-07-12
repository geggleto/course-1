# Slim Framework Introduction

## Section 1

### 1. Installation

- `git clone <this repo>`
- `composer install`

### 2. Configuration

- Configuration is in `config/container.php`

### 3. Write some code!!

- New controllers should go in `src/Http`

### 4. Unit Tests

- Every controller should have a unit test in `tests/Http`

### 5. Run Things

- You can use `composer run` to run the PHP Built-in webserver
- You can use `composer run:tests` to run PHP Unit!


## Section 2

### Install Twig
- `composer require slim/twig-view`

### Configure Twig
- Add twig configuration to `config/container.php`

### Make Your First Twig Template
- Make a folder in the root directory called `templates`
- Create `home.twig`

### Wire/Hook it up
- Make a controller
- Attach controller with Route
- Add Controller to container
