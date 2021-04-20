<?php

namespace zobayer\LaravelFileManager\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class FileManagerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'FileManager:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Initialization Laravel File Manager Package';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        print_r("\n");
        print_r("\n");
        print_r("\e[1;32m Welcome to Laravel File Manager Initialization \n" . PHP_EOL);

        print_r("\n");
        print_r("\n");
        print_r("\e[1;35m Migrating Package Tables\n" . PHP_EOL);
        Artisan::call('migrate');
        print_r("\e[1;36m");
        print_r(Artisan::output());
        print_r("\e[1;34m ..................................\n" . PHP_EOL);
        print_r("\e[1;32m Migration Complete\n" . PHP_EOL);
        print_r("\n");
        print_r("\n");
        print_r("\e[1;33m List of available routes \n");
        Artisan::call('route:list', ['--name' => 'laravel.file.manager']);
        print_r(Artisan::output());
        print_r("\n");
        print_r("\n");
        print_r("\e[1;32m Initialization Completed\n" . PHP_EOL);

    }
}
