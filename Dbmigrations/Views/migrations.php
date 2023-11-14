<div class="panel margin-top" x-show="tab == 'caching'">
    <div class="panel-header">
        Database Migrations
    </div>
    <div class="panel-body">
        <div class="alert">Running database migrations without knowing what you're doing can cause irreversible damage to your database. Please make sure you have a backup before running any migrations.</div>
        <br>
        <table class="crud-table margin-top">
            <thead>
                <tr>
                    <th>Module</th>
                    <th>Migration</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <? foreach ($migrations as $migration) { ?>
                    <tr>
                        <td><?= $migration['module'] ?></td>
                        <td><?= $migration['presentable_file'] ?></td>
                        <td>
                            <a href="/admin/dbmigrations/run?module=<?= $migration['module'] ?>&file=<?= $migration['file'] ?>" class="button"><i class="fa-solid fa-arrow-up left"></i> Migrate Up</a>
                            <a href="/admin/dbmigrations/revert?module=<?= $migration['module'] ?>&file=<?= $migration['file'] ?>" class="button danger button-crud-delete"><i class="fa-solid fa-arrow-down left"></i> Migrate Down</a>
                        </td>
                    </tr>
                <? } ?>
            </tbody>
        </table>
    </div>
</div>