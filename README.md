GraphP Challenge App
=======================

Installation
------------
The recommended way to get a working copy of this project is to clone the repository
setup database (in config/db.global.php.dist remove .dist suffix and add valid
database configuration) and run build script command:

    ./bin/build

Requirements
------------
PHP 5.6+
PostgreSQL 9.5

How to use console commands
---------------------------
Application is command line only. For list of all available commands run:

    ./bin/console

For import test data, run from app root:

    ./bin/console import import.sample.xml

To query with sample data:

    ./bin/console query query.sample.json

To save response as json:

    ./bin/console query query.sample.json > result.json