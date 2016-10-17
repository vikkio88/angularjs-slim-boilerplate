<?php


namespace App\Lib\Slime\Console\Commands;


use App\Lib\Slime\Console\SlimeCommand;

class MigrateCommand extends SlimeCommand
{
    const MIGRATIONS_PATH = 'database/migrations';

    /**
     * @return int
     */
    public function run()
    {
        $files = glob(self::MIGRATIONS_PATH . '/*.php');
        $this->runMigrations($files);
    }

    private function runMigrations($files)
    {
        foreach ($files as $file) {
            require_once($file);
            $class = basename($file, '.php');
            $obj = new $class;
            $obj->run();
        }
    }
}