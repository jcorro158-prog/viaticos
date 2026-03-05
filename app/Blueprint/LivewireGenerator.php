<?php

namespace App\Blueprint;

use Blueprint\Contracts\Generator;
use Blueprint\Tree;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

class LivewireGenerator implements Generator
{
    public function __construct(protected Filesystem $files)
    {
        //
    }

    public function output(Tree $tree): array
    {
        $output = [];

        $models = $tree->models();

        if (empty($models)) {
            return $output;
        }

        foreach ($models as $name => $model) {

            // Generar componentes Livewire para cada modelo
            $methods = ['Index', 'Create', 'Edit', 'Delete'];

            foreach ($methods as $method) {
                $componentName = $name.'s/'.$method.$name;

                Artisan::call('make:livewire', [
                    'name' => $componentName,
                ]);

                $output[] = "Livewire component created: {$componentName}";
            }
        }

        return $output;
    }

    public function types(): array
    {
        return ['controllers'];
    }
}
