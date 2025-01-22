<?php

namespace Felipetti\ServiceLayer\Commands;

use Felipetti\ServiceLayer\Helper\StringHelper;

class MakeAllCommand extends BaseCommand
{
    // Command line that triggers everything.
    protected $signature = 'make:all {model}';

    // Description of the functionality of the command.
    protected $description = 'Create all layers specified by user';

    /**
     * Needed variables for the command to initiate.
     */
    public function __construct()
    {
        parent::__construct();
        $this->finalSuccessMessage = "All layers were created successfully";
    }

    /**
     * Generates all the functions to make the command perform.
     *
     * @return void
     */
    public function handle(): void
    {
        $name = $this->argument('model');
        $configParameters = $this->data->getConfig()['parameters'];
        $parameters = array_merge(compact('name'), StringHelper::makeModelParameters($configParameters));
        $serviceName =  $name . 'Service';

        $this->call("make:model", $parameters);
        $this->call('make:service', ['service' => $serviceName]);

        $this->components->info($this->getFinalSuccessMessage());
    }
}
