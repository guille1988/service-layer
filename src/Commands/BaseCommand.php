<?php


namespace Felipetti\ServiceLayer\Commands;


use Felipetti\ServiceLayer\Data\Data;
use Illuminate\Console\Command;


class BaseCommand extends Command
{

    // Has the final success message.
    protected string $finalSuccessMessage;

    // Has all paths, config and stub data injected.
    protected readonly Data $data;


    /*
    * Sets the attributes that will provide data to both commands
    *
    */
    public function __construct()
    {
        parent::__construct();
        $this->data = app(Data::class);
    }


    /**
     * Gets the final success message of the command
     *
     * @return string
     */
    public function getFinalSuccessMessage(): string
    {
        return $this->finalSuccessMessage;
    }
}
