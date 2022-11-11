<?php


namespace Felipetti\ServiceLayer\Commands;


use Felipetti\ServiceLayer\Helper\StringHelper;
use Illuminate\Support\Facades\File;
use Exception;
use Error;


class MakeServiceCommand extends BaseCommand
{

    // Is the command line that triggers everything.
    protected $signature = 'make:service {service}';

    // Description of the functionality of the command.
    protected $description = 'Create a new service class';

    // Error message of service file already exists in the given directory.
    protected string $fileAlreadyExists = 'Service already exists';

    // Has the model folder path with checked existence
    protected string $serviceFolderPath;


    /**
     * Charges all needed variables for the command to initiate.
     */
    public function __construct()
    {
        parent::__construct();

        $serviceFolderPath = $this->data->getConfig()['service_folder_path'];
        $this->serviceFolderPath = empty($serviceFolderPath) ? app_path('Services') : $serviceFolderPath;
    }


    /**
     * Sets the final success message of the command
     *
     * @param string $serviceLocalPath
     * @return void
     */
    public function setFinalSuccessMessage(string $serviceLocalPath): void
    {
       $this->finalSuccessMessage = "Service [$serviceLocalPath] created successfully";
    }


    /**
     * Displays an error message and exits the application.
     *
     * @param string $message
     * @return void
     */
    public function throwError(string $message): void
    {
        echo PHP_EOL;
        $this->components->error($message);
        echo PHP_EOL;

        exit(1);
    }


    /**
     * Check if service file is already in the folder.
     *
     * @param string $serviceName
     * @return void
     */
    public function checkIfFileAlreadyExists(string $serviceName): void
    {
        $serviceFileName = $this->serviceFolderPath . '/' . $serviceName . '.php';

        if(File::exists($serviceFileName))
            $this->throwError($this->fileAlreadyExists);
    }


    /**
     * Perform string conversions and replace stub variables with them.
     *
     * @param string $serviceName
     * @return void
     */
    public function stringConversionsAndReplace(string $serviceName): void
    {
        try {
            $serviceFolderPath = $this->serviceFolderPath;
            $serviceFolderLocalPath = StringHelper::convertFullPathToLocalPath($serviceFolderPath);
            $serviceNamespacePath = StringHelper::convertToFirstLetterUpperCaseAndBackSlash($serviceFolderLocalPath);
            $serviceFileName = '/' . $serviceName . '.php';
            $newServiceFilePath = $serviceFolderPath . $serviceFileName;
            $this->setFinalSuccessMessage($serviceFolderLocalPath . $serviceFileName);

            $searchAndReplace = [
                '{{ serviceName }}' => $serviceName,
                '{{ servicePath }}' => $serviceNamespacePath
            ];

            $stub = file_get_contents($this->data->getStub());
            $replacedStub = str_replace(array_keys($searchAndReplace), array_values($searchAndReplace), $stub);
            File::ensureDirectoryExists($serviceFolderPath,0777);
            file_put_contents($newServiceFilePath, $replacedStub);
            chmod($newServiceFilePath, 0777);
        }
        catch (Exception|Error $exception){
            $this->throwError($exception->getMessage());
        }
    }


    /**
     * Generates all the functions to make the command perform.
     *
     * @return void
     */
    public function handle(): void
    {
        $serviceName = $this->argument('service');
        $this->checkIfFileAlreadyExists($serviceName);
        $this->stringConversionsAndReplace($serviceName);
        $this->components->info($this->getFinalSuccessMessage());
    }
}
