<?php

namespace Felipetti\ServiceLayer\Commands;

use Felipetti\ServiceLayer\Data\Data;
use Illuminate\Console\Command;

class BaseCommand extends Command
{
    // The final success message.
    protected string $finalSuccessMessage;

    // Paths, config and stub data injected.
    protected readonly Data $data;

    /*
    * Attributes that will provide data to both commands
    *
    */
    public function __construct()
    {
        parent::__construct();
        $this->data = new Data;
    }

    /**
     * Final success message of the command
     *
     * @return string
     */
    public function getFinalSuccessMessage(): string
    {
        return $this->finalSuccessMessage;
    }
}
