# Wordpress Community Hive Plugin

[![Open in GitHub Codespaces](https://github.com/codespaces/badge.svg)](https://codespaces.new/DeschutesDesignGroupLLC/wordpress-community-hive)

## Starting A Local Wordpress Docker Development Environment

Download and install the project dependencies.

`yarn install && composer install`

Start and initialize the Docker containers.

`docker-compose up --build`

### Installing Wordpress

Run the bash script that will automatically install Wordpress and activate the plugin.

You may configure the WP-CLI script in `docker/cli/install-wordpress` for additional configuration and setup steps.

`docker-compose run --rm cli install-wordpress`

**Admin Details**<br>
Username: wordpress<br>
Password: wordpress

### Starting The Development Server

Compile and run the Webpack development server. Webpack will utilize hot reloading to show you the latest updates when a file is saved.

`npm run dev`

### Building For Production

Compile your assets for production.

`npm run build`

## CLI

The WP-CLI can be accessed using the following commands:

#### WP-CLI

`docker-compose run --rm cli wp [command]`

#### Laravel Artisan

Acorns comes with several Laravel Artisan commands. A current list can be found [here](https://roots.io/acorn/docs/wp-cli/).

`docker-compose run --rm cli wp acorn [artisan:command]`