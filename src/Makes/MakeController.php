<?php
namespace janareit\L5scaffold\Makes;

use Illuminate\Console\AppNamespaceDetectorTrait;
use Illuminate\Filesystem\Filesystem;
use janareit\L5scaffold\Commands\ScaffoldMakeCommand;
use janareit\L5scaffold\Migrations\SchemaParser;
use janareit\L5scaffold\Migrations\SyntaxBuilder;


class MakeController
{
    use AppNamespaceDetectorTrait, MakerTrait;



    protected $scaffoldCommandObj;

    function __construct(ScaffoldMakeCommand $scaffoldCommand, Filesystem $files)
    {
        $this->files = $files;
        $this->scaffoldCommandObj = $scaffoldCommand;

        $this->start();

    }

    private function start()
    {
        // Cria o nome do arquivo do controller // TweetController


        $name = $this->scaffoldCommandObj->getObjName('Name') . 'Controller';

        // Verifica se o arquivo existe com o mesmo o nome
        if ($this->files->exists($path = $this->getPath($name))) {
            return $this->scaffoldCommandObj->error($name . ' already exists!');
        }

        // Cria a pasta caso nao exista
        $this->makeDirectory($path);

        // Grava o arquivo
        $this->files->put($path, $this->compileControllerStub());

        $this->scaffoldCommandObj->info('Controller created successfully.');

        //$this->composer->dumpAutoloads();
    }





    /**
     * Compile the migration stub.
     *
     * @return string
     */
    protected function compileControllerStub()
    {
        $stub = $this->files->get(__DIR__ . '/../stubs/controller.stub');

        $this->replaceClassName($stub, "controller")
            ->replaceModelPath($stub)
            ->replaceModelName($stub)
            ->replaceSchema($stub, 'controller');


        return $stub;
    }


    /**
     * Replace the class name in the stub.
     *
     * @param  string $stub
     * @return $this
     */
    protected function replaceClassName(&$stub)
    {

        $className = $this->scaffoldCommandObj->getObjName('Name') . 'Controller';
        $stub = str_replace('{{class}}', $className, $stub);

        return $this;
    }


    /**
     * Renomeia o endereço do Model para o controller
     *
     * @param $stub
     * @return $this
     */
    private function replaceModelPath(&$stub)
    {
        $model_name = $this->getAppNamespace()
            . str_replace('/', '\\', config('scaffold.models_command_path'))
            . str_replace('/', '\\', $this->getPrefix('model'))
            . $this->scaffoldCommandObj->getObjName('Name');
        $stub = str_replace('{{model_path}}', $model_name, $stub);

        return $this;

    }


    private function replaceModelName(&$stub)
    {
        $model_name_uc = $this->scaffoldCommandObj->getObjName('Name');
        $model_name = $this->scaffoldCommandObj->getObjName('name');
        $model_names = $this->scaffoldCommandObj->getObjName('names');
        $prefix = strtolower( str_replace('/', '.', $this->getPrefix('model')) );
        $clean_prefix = str_replace('/', '', $this->getPrefix('model'));

        $stub = str_replace('{{model_name_class}}', $model_name_uc, $stub);
        $stub = str_replace('{{model_name_var_sgl}}', $model_name, $stub);
        $stub = str_replace('{{model_name_var}}', $model_names, $stub);
        $stub = str_replace('{{model_prefix}}', $prefix, $stub);
        $stub = str_replace('{{clean_prefix}}', $clean_prefix, $stub);

        return $this;
    }


    /**
     * Replace the schema for the stub.
     *
     * @param  string $stub
     * @param string $type
     * @return $this
     */
    protected function replaceSchema(&$stub, $type = 'migration')
    {

        if ($schema = $this->scaffoldCommandObj->option('schema')) {
            $schema = (new SchemaParser)->parse($schema);
        }


        // Create controllers fields
        $schema = (new SyntaxBuilder)->create($schema, $this->scaffoldCommandObj->getMeta(), 'controller');
        $stub = str_replace('{{model_fields}}', $schema, $stub);


        return $this;
    }
}