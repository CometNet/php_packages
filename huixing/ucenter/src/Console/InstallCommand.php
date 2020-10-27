<?php

namespace Huixing\UCenter\Console;

use Illuminate\Console\Command;

/**
 * 安装后台命令
 * Class InstallCommand
 * @package Huixing\Admin\Console
 */
class InstallCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'ucenter:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Install the ucenter package';

    /**
     * Install directory.
     *
     * @var string
     */
    protected $directory = '';

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->initDatabase();

        $this->initAdminDirectory();
    }

    /**
     * Create tables and seed it.
     *
     * @return void
     */
    public function initDatabase()
    {
        $this->call('migrate');

        $userModel = config('ucenter.database.users_model');

        if ($userModel::count() == 0) {
            $this->call('db:seed', ['--class' => \Huixing\UCenter\Database\Seeders\DatabaseSeeder::class]);
        }
    }

    /**
     * Initialize the admAin directory.
     *
     * @return void
     */
    protected function initAdminDirectory()
    {
        $this->directory = config('ucenter.directory');

        if (is_dir($this->directory)) {
            fwrite(STDOUT, "路径已存在是否覆盖：(Y/N)");
            $code = trim(fgets(STDIN));
            if($code != "Y"){
                $this->line("<error>{$this->directory} directory already exists !</error> ");
                return;
            }

        }

        $this->makeDir('/');
        $this->line('<info>Admin directory was created:</info> '.str_replace(base_path(), '', $this->directory));

        $this->makeDir('Controllers');

        $this->createHomeController();
        $this->createAuthController();
        $this->createExampleController();

        $this->createRoutesFile();
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createHomeController()
    {
        $homeController = $this->directory.'/Controllers/HomeController.php';
        $contents = $this->getTemplate('HomeController');

        $this->laravel['files']->put(
            $homeController,
            str_replace('DummyNamespace', config('ucenter.route.namespace'), $contents)
        );
        $this->line('<info>HomeController file was created:</info> '.str_replace(base_path(), '', $homeController));
    }

    /**
     * Create AuthController.
     *
     * @return void
     */
    public function createAuthController()
    {
        $authController = $this->directory.'/Controllers/AuthController.php';
        $contents = $this->getTemplate('AuthController');

        $this->laravel['files']->put(
            $authController,
            str_replace('DummyNamespace', config('ucenter.route.namespace'), $contents)
        );
        $this->line('<info>AuthController file was created:</info> '.str_replace(base_path(), '', $authController));
    }

    /**
     * Create HomeController.
     *
     * @return void
     */
    public function createExampleController()
    {
        $exampleController = $this->directory.'/Controllers/ExampleController.php';
        $contents = $this->getTemplate('ExampleController');

        $this->laravel['files']->put(
            $exampleController,
            str_replace('DummyNamespace', config('ucenter.route.namespace'), $contents)
        );
        $this->line('<info>ExampleController file was created:</info> '.str_replace(base_path(), '', $exampleController));
    }


    /**
     * Create routes file.
     *
     * @return void
     */
    protected function createRoutesFile()
    {
        $file = $this->directory.'/routes.php';

        $contents = $this->getTemplate('routes');
        $this->laravel['files']->put($file, str_replace('DummyNamespace', config('ucenter.route.namespace'), $contents));
        $this->line('<info>Routes file was created:</info> '.str_replace(base_path(), '', $file));
    }

    /**
     * Get template contents.
     *
     * @param $name
     *
     * @return string
     */
    protected function getTemplate($name)
    {
        return $this->laravel['files']->get(__DIR__."/templates/$name.template");
    }

    /**
     * Make new directory.
     *
     * @param string $path
     */
    protected function makeDir($path = '')
    {
        $this->laravel['files']->makeDirectory("{$this->directory}/$path", 0755, true, true);
    }
}
