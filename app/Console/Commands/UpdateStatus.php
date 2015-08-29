<?php
namespace App\Console\Commands;

use App\Status;
use Illuminate\Console\Command;

class UpdateStatus extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'status:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updates the status record.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $db = app('db');

        if (!$db->table('status')->where('component', 'scheduler')->first()) {
            $db->table('status')->insert([
                'component' => 'scheduler',
            ]);
        }

        app('queue')->push(function ($job) {

            $db = app('db');

            if (!$db->table('status')->where('component', 'queue')->first()) {
                $db->table('status')->insert(['component' => 'queue']);
            }

            $job->delete();
        });
    }
}
