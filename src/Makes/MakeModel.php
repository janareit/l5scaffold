<?php
/**
 * Created by PhpStorm.
 * User: fernandobritofl
 * Date: 4/22/15
 * Time: 10:34 PM
 */

namespace janareit\L5scaffold\Makes;


use Illuminate\Filesystem\Filesystem;
use janareit\L5scaffold\Commands\ScaffoldMakeCommand;

class MakeModel {
    use MakerTrait;

    public function __construct(ScaffoldMakeCommand $scaffoldCommand, Filesystem $files)
    {
        $this->files = $files;
        $this->scaffoldCommandObj = $scaffoldCommand;

        $this->start();
    }


    protected function start()
    {

        $name = $this->scaffoldCommandObj->getObjName('Name');
        $modelPath = $this->getPath($name, 'model');

        if (! $this->files->exists($modelPath)) {
            $this->scaffoldCommandObj->call('make:model', [
                'name' => config('scaffold.models_command_path') . $this->getPrefix('model') . $name,
                '--no-migration' => true,
            ]);
        }

    }

}