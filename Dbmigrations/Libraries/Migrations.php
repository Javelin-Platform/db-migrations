<?php

namespace Module\Dbmigrations\Libraries;

use App\Libraries\Modules;

class Migrations
{
    public static function get() {
        // Loop through each module, check for a Database/Migrations folder. If so, loop through all the integration files and create an array of these with the file location (or module name if possible..!)
        $migrations = [];
        $modulesObj = Modules::getInstance();
        $modules = $modulesObj->getAll();

        foreach($modules as $module) {
            $moduleDirectory = ROOTPATH . '/module/' . $module['key'];
            $migrationDirectory = $moduleDirectory . '/Database/Migrations';

            if (is_dir($migrationDirectory)) {
                $files = scandir($migrationDirectory);
                foreach($files as $file) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }

                    // Create a presentable file name - for the file, get everything after the _ and remove the .php
                    $presentableFileName = str_replace('.php', '', substr($file, strpos($file, '_') + 1));

                    $migrations[] = [
                        'module' => $module['key'],
                        'file' => $file,
                        'presentable_file' => $presentableFileName,
                        'path' => $migrationDirectory . '/' . $file
                    ];
                }
            }
        }

        return $migrations;
    }

    public static function addToLog($module, $migrationFile, $method) {
        $file = WRITEPATH . '/dbmigrations.log';

        $log = date('Y-m-d H:i:s') . ' - ' . $module . ' - ' . $migrationFile . ' - ' . $method . "\n";

        file_put_contents($file, $log, FILE_APPEND);
    }
}