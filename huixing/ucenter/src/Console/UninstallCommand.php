<?php

namespace Huixing\UCenter\Console;

use Illuminate\Console\Command;

class UninstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var strin
     */
    protected $signature = 'ucenter:uninstall';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Uninstall the admin package';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        if (!$this->confirm('Are you sure to uninstall laravel-admin?')) {
            return;
        }

        $this->removeFilesAndDirectories();

        $this->line('<info>Uninstalling ucenter!</info>');
    }

    /**
     * Remove files and directories.
     *
     * @return void
     */
    protected function removeFilesAndDirectories()
    {
        $this->laravel['files']->deleteDirectory(config('ucenter.directory'));
        $this->laravel['files']->deleteDirectory(public_path('vendor/ucenter/'));
        $this->laravel['files']->delete(config_path('ucenter.php'));
    }
}
{

}