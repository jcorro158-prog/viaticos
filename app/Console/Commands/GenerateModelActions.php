<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class GenerateModelActions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:model-actions {--force : Overwrite existing actions}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Genera acciones (Create, Update, Delete, List) para cada modelo existente';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $modelsPath = app_path('Models');
        $files = File::allFiles($modelsPath);
        $actions = ['Show', 'Store', 'Update', 'Destroy', 'Index'];

        foreach ($files as $file) {
            $model = pathinfo($file->getFilename(), PATHINFO_FILENAME);
            $this->info("Generando acciones para modelo: $model");

            foreach ($actions as $action) {
                $actionClass = "{$action}{$model}";
                $namespace = "App\\Actions\\{$model}\\{$actionClass}";

                if (! $this->option('force') && class_exists($namespace)) {
                    $this->warn(" - {$actionClass} ya existe, saltando...");

                    continue;
                }

                Artisan::call('make:action', [
                    'name' => "{$model}/{$actionClass}",
                ]);

                $this->info(" - {$actionClass} creado");
            }

            // Add separator for better readability
            $this->line(str_repeat('-', 40));

        }

        $this->info('✅ Todas las acciones han sido generadas.');
    }
}
