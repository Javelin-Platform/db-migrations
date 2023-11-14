<?php

$routes->add('/admin/dbmigrations/run', '\Module\Dbmigrations\Controllers\Executor::up');
$routes->add('/admin/dbmigrations/revert', '\Module\Dbmigrations\Controllers\Executor::down');