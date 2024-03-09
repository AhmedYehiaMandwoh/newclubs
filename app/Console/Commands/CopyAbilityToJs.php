<?php

namespace App\Console\Commands;

use App\Classes\Abilities;
use Illuminate\Console\Command;

class CopyAbilityToJs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ability:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'trans Ability.php permissions to js';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $permissions=collect(Abilities::cases())->pluck('value','name');
        $data='export const Ability = '.json_encode($permissions);
        file_put_contents(resource_path('js/ability.js'), $data);
        $this->info("Success Copy Ability To Js!");
    }
}
