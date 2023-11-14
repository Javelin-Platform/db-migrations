<?php

namespace Module\Dbmigrations\Controllers;

use App\Controllers\BaseController;
use App\Libraries\FlashSession;
use Module\Dbmigrations\Libraries\Migrations;

class Executor extends BaseController {
    public function up() {
        return $this->run('up');
    }

    public function down() {
        return $this->run('down');
    }

    public function run($method) {
        $moduleName = $this->request->getGet('module');
        $migrationFile = $this->request->getGet('file');

        // If either are missing, return an error
        if (empty($moduleName) || empty($migrationFile)) {
            FlashSession::setAdminMessage('Module or migration file not specified', 'error');
            return redirect()->to('/admin/settings/info');
        }

        // Check the migration file ROOTPATH / module / $moduleName / Database / Migrations / $migrationFile
        $migrationFile = ROOTPATH . '/module/' . $moduleName . '/Database/Migrations/' . $migrationFile;

        if (!file_exists($migrationFile)) {
            FlashSession::setAdminMessage('Migration file not found or not executable', 'error');
            return redirect()->to('/admin/settings/info');
        }

        // Include the file
        include_once($migrationFile);

        // Get the class name
        $className = str_replace('.php', '', basename($migrationFile));

        // Remove everything before the last _
        $className = substr($className, strrpos($className, '_') + 1);

        // Add namespace
        $className = 'Module\\' . $moduleName . '\\Database\\Migrations\\' . $className;

        // Create an instance of the class
        $migrationClass = new $className();

        // Run the up() or down() method
        if ($method == 'up') {
            $migrationClass->up();
        } else {
            $migrationClass->down();
        }

        Migrations::addToLog($moduleName, $migrationFile, $method);

        // Redirect back to the settings page
        FlashSession::setAdminMessage('Migration complete', 'success');
        return redirect()->to('/admin/settings/info');
    }
}