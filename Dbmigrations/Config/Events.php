<?php

namespace Module\Dbmigrations\Events;

use App\Libraries\System\Events;
use Module\Dbmigrations\Libraries\Migrations;

Events::on('admin_settings_info_panels', function ($html) {
    $html .= view('\Module\Dbmigrations\Views\migrations.php', [
        'migrations' => Migrations::get()
    ]);
    return $html;
});