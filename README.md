# Database Migration Tool for Javelin
Run module database migrations manually through the Javelin admin panel. This may be useful if you have a backlog of migrations to execute, or a module hasn't successfully executed it's own migrations on installation.

***IMPORTANT: This is a development tool only. Using this module may expose file access and potential code execution exploits, only enable this module on development sites, NEVER on live sites!***

<img width="1456" alt="db-migrations-for-javelin" src="https://github.com/Javelin-Platform/db-migrations/assets/13433133/5bb08562-db53-484d-a002-3b419580a57b">

## Installation
### Manual Installation
* Download this repository
* Put the "Dbmigrations" directory from this repository into the "/modules" directory of your Javelin store.

## Use
*Dbmigrations* creates a new panel under Settings -> System Information -> Caching & Indexing. This will list all of the migrations available for any currently installed modules. Please note that this tool will not let you access Javelin app code migrations, only modules.

For the migration you want to run, you can either "Migrate Up" for when you have installed a new module or an update for a module. You can also "Migrate Down", which should revert back any changes from the last migration. 

**Up and down migrations are executed directly from the module migration file, so this code will be executed directly from this. This module allows any code within the migrations to run, so be sure to check the migration first if you did not create the module yourself, as this could be a potentially dangerous action.**
