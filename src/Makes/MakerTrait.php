<?php namespace janareit\L5scaffold\Makes;

use Illuminate\Filesystem\Filesystem;
use janareit\L5scaffold\Commands\ScaffoldMakeCommand;

trait MakerTrait {

    /**
     * The filesystem instance.
     *
     * @var Filesystem
     */
    protected $files;
    protected $scaffoldCommandM;

    /**
     * @param ScaffoldMakeCommand $scaffoldCommand
     * @param Filesystem $files
     */
    public function __construct(ScaffoldMakeCommand $scaffoldCommand, Filesystem $files){
        $this->files = $files;
        $this->scaffoldCommandM = $scaffoldCommand;

        $this->generateNames($scaffoldCommand);
    }


    /**
     * Get the path to where we should store the controller.
     *
     * @param $file_name
     * @param string $path
     * @return string
     */
    protected function getPath($file_name, $path='controller'){

        if($path == "controller"){
            return config('scaffold.controllers_path') . $this->getPrefix('controller') . $file_name . '.php';

        } elseif($path == "model"){
            return config('scaffold.models_path') . $this->getPrefix('model') . $file_name . '.php';

        } elseif($path == "seed"){
            return config('scaffold.seeds_path') . $this->getPrefix('seed') . $file_name . '.php';

        } elseif($path == "view-index"){
            return config('scaffold.views_path') . $this->getPrefix('view') . $file_name . '/index.blade.php';

        } elseif($path == "view-edit"){
            return config('scaffold.views_path') . $this->getPrefix('view') . $file_name . '/edit.blade.php';

        } elseif($path == "view-show"){
            return config('scaffold.views_path') . $this->getPrefix('view') . $file_name . '/show.blade.php';

        } elseif($path == "view-create"){
            return config('scaffold.views_path') . $this->getPrefix('view') . $file_name . '/create.blade.php';

        }
    }


    /*
     * Detect appropriate prefixes for each path
     */
    protected function getPrefix($type) {
        if ($type == "controller") {
            return config('scaffold.prefix_controllers') == true ? $this->scaffoldCommandObj->prefix . '/' : '';
        }
        elseif ($type == "model") {
            return config('scaffold.prefix_models') == true ? $this->scaffoldCommandObj->prefix . '/' : '';
        }
        elseif ($type == "seed") {
            return config('scaffold.prefix_seeds') == true ? $this->scaffoldCommandObj->prefix . '/' : '';
        }
        elseif ($type == "view") {
            return config('scaffold.prefix_views') == true ? $this->scaffoldCommandObj->prefix . '/' : '';
        }
    }


    /**
     * Build the directory for the class if necessary.
     *
     * @param  string  $path
     * @return string
     */
    protected function makeDirectory($path)
    {

        if ( ! $this->files->isDirectory(dirname($path)))
        {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }



}