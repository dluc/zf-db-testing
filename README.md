# Database testing with Zend Framework and PHPUnit

A demo Zend Framework application illustrating how to write database unit tests using SQLite and XML fixtures.

SQLite can be replaced with other PDO supported databases.

* see [techPortal article](http://techportal.ibuildings.com/2010) for all the details

## Required Packages

* [PHPUnit](http://www.phpunit.de/manual/current/en/installation.html)
* [Zend framework](http://framework.zend.com/download)
* [PHP 5](http://www.php.net/downloads.php) *sqlite extension is enabled by default*

## Optional Packages

* SQLite 3

## Running the demo

After downloading the repository, enter the tests folder from the command line and run phpunit to see all the tests passing.

    git clone git://github.com/ibuildings/zf-db-testing
    cd zf-db-testing/tests
    phpunit

    ==> OK (4 tests, 4 assertions)

## Extending the demo

* Create a new *Test Case* in *tests/application/models* extending Ibuildings_Test_PHPUnit_DatabaseTestCase_Abstract
* Create new *Fixtures Data* in *tests/fixtures/models* to describe the expected data
* Add new *Tables* to the testing db in *tests/fixtures/db* using the schema of the expected data
* Create the new *Models* in *application/models*
