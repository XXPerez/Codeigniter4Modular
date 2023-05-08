<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;
use CodeIgniter\Files\File;

class ModuleGenerator extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'Generators';

    /**
     * The Command's Name
     *
     * @var string
     */
    protected $name = 'make:module';

    /**
     * The Command's Description
     *
     * @var string
     */
    protected $description = 'Create CodeIgniter Modules in app/Modules/<ModuleName>';

    /**
     * The Command's Usage
     *
     * @var string
     */
    protected $usage = 'module:create [ModuleName] [Options]';

    /**
     * The Command's Arguments
     *
     * @var array
     */
    protected $arguments    = ['ModuleName' => 'Module name to be created'];

    /**
     * The Command's Options
     *
     * @var array
     */
    protected $options = [
        '-c' => 'Create only con[F]ig, [C]ontroller, [L]ibrary, [M]odel, [V]iew, [O]ther dirs'
    ];




    /**
     * Module folder (default /Modules/<ModuleName>)
     */
    protected $moduleFolder;

    /**
     * instance of the file locator
     */
    protected $locator;
    /**
     * Actually execute a command.
     *
     * @param array $params
     */
    public function run(array $params)
    {
        $moduleName = array_shift($params);

        if (empty($moduleName)) {
            $moduleName = CLI::prompt('Module name', null, 'required'); // @codeCoverageIgnore
        }

        if (strlen(preg_replace('/[^A-Za-z0-9]+/', '', $moduleName)) <> mb_strlen($moduleName)) {
            CLI::error("Module name must to be plain ascii characters A-Z or a-z, and can contain numbers 0-9");
            $moduleName = CLI::prompt('Mopdule name', null, 'required'); // @codeCoverageIgnore
        }

        // Get an instance of the file locator
        $this->locator = \Config\Services::locator();
        helper('filesystem');

        $moduleName = ucfirst($moduleName);
        $modulesFolder = APPPATH . 'Modules';
        $this->moduleFolder = $modulesFolder . DIRECTORY_SEPARATOR . $moduleName;
        CLI::write('Creating module in: ' . CLI::color($modulesFolder . DIRECTORY_SEPARATOR . $moduleName, 'green'));

        if (!is_dir($modulesFolder)) {
            mkdir($modulesFolder, 0777, true);
        }
        if (!is_dir($this->moduleFolder)) {
            mkdir($this->moduleFolder, 0777, true);
        }

        try {
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'F')) {
                $this->createConfig($moduleName);
            }
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'C')) {
                $this->createController($moduleName);
            }
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'L')) {
                $this->createLibrary($moduleName);
            }
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'M')) {
                $this->createModel($moduleName);
            }
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'V')) {
                $this->createView($moduleName);
            }
            if (CLI::getOption('c') == '' || strstr(CLI::getOption('c'), 'O')) {
                $this->createOtherDirs($moduleName);
            }
            $this->updateAutoload($moduleName);
            CLI::write('Module created!', 'green');
            CLI::write('Try to browse to http://localhost:8080/index.php/' . strtolower($moduleName), 'green');
        } catch (\Exception $e) {
            CLI::error($e);
        }
    }

    protected function createOtherDirs(string $moduleName)
    {
        $templateLanguage = $this->locator->locateFile('language.tpl.php', 'Commands/Generators/Views/ModuleCreate/Language/en');
        // If the template file is not found
        if ($templateLanguage === false) {
            // Show an error message and exit
            CLI::error('Unable to locate the template file for the Language.');
            return;
        }
        $this->createDir('Database', true);
        $this->createDir('Database/Migrations', true);
        $this->createDir('Database/Seeds', true);
        CLI::write('Created new directory: ' . CLI::color('Database', 'green'));
        CLI::write('Created new directory: ' . CLI::color('Database' . DIRECTORY_SEPARATOR . 'Migrations', 'green'));
        CLI::write('Created new directory: ' . CLI::color('Database' . DIRECTORY_SEPARATOR . 'Seeds', 'green'));

        $this->createDir('Filters', true);
        CLI::write('Created new directory: ' . CLI::color('Filters', 'green'));

        $this->createDir('Validation', true);
        CLI::write('Created new directory: ' . CLI::color('Validation', 'green'));

        $this->createDir('Language', true);
        $this->createDir('Language/en', true);
        $file = new File($templateLanguage);
        $content = file_get_contents($file->getRealPath());
        $content = str_replace('{moduleName}', $moduleName, $content);
        write_file($this->moduleFolder . DIRECTORY_SEPARATOR . 'Language/en' . DIRECTORY_SEPARATOR . $moduleName . '.php', $content);
        CLI::write('Created new directory: ' . CLI::color('Language', 'green'));
        CLI::write('Created new directory: ' . CLI::color('Language' . DIRECTORY_SEPARATOR . 'en', 'green'));
        CLI::write('Created new language file:: ' . CLI::color('Language' . DIRECTORY_SEPARATOR . 'en' . DIRECTORY_SEPARATOR . $moduleName . '.php', 'green'));
    }

    protected function createDir($folder, $gitkeep = false)
    {
        $dir = $this->moduleFolder . DIRECTORY_SEPARATOR .  $folder;
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
            if ($gitkeep) {
                file_put_contents($dir .  '/.gitkeep', '');
            }
        }
        return $dir;
    }

    private function createConfig(string $moduleName)
    {
        $configPath = $this->createDir('Config');
        $templateConfig = $this->locator->locateFile('router.tpl.php', 'Commands/Generators/Views/ModuleCreate/Config');
        if ($templateConfig === false) {
            CLI::error('Unable to locate the template file for the Router.');
            return;
        }

        if (!file_exists($configPath . DIRECTORY_SEPARATOR . 'Routes.php')) {
            $routeName = strtolower($moduleName);
            $file = new File($templateConfig);
            $content = file_get_contents($file->getRealPath());
            $content = str_replace(['{moduleName}', '{routeName}'], [$moduleName, $routeName], $content);
            CLI::write('Created new config file:: ' . CLI::color('Config' . DIRECTORY_SEPARATOR . 'Routes.php', 'green'));
            write_file($configPath . DIRECTORY_SEPARATOR . 'Routes.php', $content);
        } else {
            CLI::error("Routes Config allready exists!");
        }
    }

    protected function createController(string $moduleName)
    {
        $controllerPath = $this->createDir('Controllers');
        $templateController = $this->locator->locateFile('controller.tpl.php', 'Commands/Generators/Views/ModuleCreate/Controllers');
        if ($templateController === false) {
            CLI::error('Unable to locate the template file for the Controller.');
            return;
        }

        if (!file_exists($controllerPath . DIRECTORY_SEPARATOR . $moduleName . '.php')) {
            $file = new File($templateController);
            $content = file_get_contents($file->getRealPath());
            $content = str_replace(['{moduleName}', '{filename}'], [$moduleName, strtolower($moduleName)], $content);
            CLI::write('Created new controller file:: ' . CLI::color('Controllers' . DIRECTORY_SEPARATOR . $moduleName . '.php', 'green'));
            write_file($controllerPath . DIRECTORY_SEPARATOR . $moduleName . '.php', $content);
        } else {
            CLI::error("Controller allready exists!");
        }
    }

    protected function createLibrary(string $moduleName)
    {
        $librariesPath = $this->createDir('Libraries');
        $templateLibraries = $this->locator->locateFile('library.tpl.php', 'Commands/Generators/Views/ModuleCreate/Libraries');
        if ($templateLibraries === false) {
            CLI::error('Unable to locate the template file for the Library.');
            return;
        }

        if (!file_exists($librariesPath . DIRECTORY_SEPARATOR . $moduleName . '.php')) {
            $file = new File($templateLibraries);
            $content = file_get_contents($file->getRealPath());
            $content = str_replace(['{moduleName}'], [$moduleName], $content);
            CLI::write('Created new library file:: ' . CLI::color('Libraries' . DIRECTORY_SEPARATOR . $moduleName . '.php', 'green'));
            write_file($librariesPath . DIRECTORY_SEPARATOR . $moduleName . 'Library.php', $content);
        } else {
            CLI::error("Library allready exists!");
        }
    }
    protected function createModel(string $moduleName)
    {
        $modelPath = $this->createDir('Models');
        $templateLibraries = $this->locator->locateFile('model.tpl.php', 'Commands/Generators/Views/ModuleCreate/Models');
        if ($templateLibraries === false) {
            CLI::error('Unable to locate the template file for the Model.');
            return;
        }

        if (!file_exists($modelPath . DIRECTORY_SEPARATOR . $moduleName . '.php')) {
            $file = new File($templateLibraries);
            $content = file_get_contents($file->getRealPath());
            $content = str_replace(['{moduleName}'], [$moduleName], $content);
            CLI::write('Created new model file:: ' . CLI::color('Models' . DIRECTORY_SEPARATOR . $moduleName . '.php', 'green'));
            write_file($modelPath . DIRECTORY_SEPARATOR . $moduleName . 'Model.php', $content);
        } else {
            CLI::error("Model allready exists!");
        }
    }

    protected function createView(string $moduleName)
    {
        $viewPath = $this->createDir('Views');
        $templateView = $this->locator->locateFile('view.tpl.php', 'Commands/Generators/Views/ModuleCreate/Views');
        if ($templateView === false) {
            CLI::error('Unable to locate the template file for the View.');
            return;
        }

        if (!file_exists($viewPath . DIRECTORY_SEPARATOR . $moduleName . '.php')) {
            $file = new File($templateView);
            $content = file_get_contents($file->getRealPath());
            $content = str_replace(['{moduleName}'], [$moduleName], $content);
            CLI::write('Created new view file:: ' . CLI::color('Views' . DIRECTORY_SEPARATOR . $moduleName . '.php', 'green'));
            write_file($viewPath . DIRECTORY_SEPARATOR . $moduleName . '.php', $content);
        } else {
            CLI::error("View allready exists!");
        }
    }

    protected function updateAutoload(string $moduleName)
    {
        $Autoload = new \Config\Autoload;
        $psr4 = $Autoload->psr4;
        if (isset($psr4[ucfirst($moduleName)])) {
            return false;
        }
        $file = fopen(APPPATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Autoload.php', 'r');
        if (!$file) {
            CLI::error("Config/Autoload.php nor readable!");
            return false;
        }

        $newcontent = '';
        $posfound = false;
        $posline = 0;

        $psr4Add = "                '" . $moduleName . "' => " . 'APPPATH . ' . "'Modules/" . $moduleName . "',";

        while (($buffer = fgets($file, 4096)) !== false) {
            if ($posfound && strpos($buffer, ']')) {
                //Last line of $psr4
                $newcontent .= $psr4Add . "\n";
                $posfound = false;
            }
            if ($posfound && $posline > 3 && substr(trim($buffer), -1) != ',') {
                $buffer = str_replace("\n", ",\n", $buffer);
            }
            if (strpos($buffer, 'public $psr4 = [')) {
                $posfound = true;
                $posline = 1;
                //First line off $psr4
            }
            if ($posfound) {
                $posline++;
            }
            $newcontent .= $buffer;
        }
        CLI::write('Update file:: ' . CLI::color('Config/Autoload.php', 'green'));
        $file = fopen(APPPATH . DIRECTORY_SEPARATOR . 'Config' . DIRECTORY_SEPARATOR . 'Autoload.php', 'w');
        if (!$file) {
            CLI::error("Config/Autoload.php nor writable!");
            return false;
        }
        fwrite($file, $newcontent);
        fclose($file);

        return true;
    }
}
