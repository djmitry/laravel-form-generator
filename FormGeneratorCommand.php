<?php

namespace Djmitry\Widgets;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class WidgetCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'widget:do {name} {--table=}';
    //TODO: php artisan widget:do back/generate/test --table=portfolio

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        //$this->info('Display this on the screen');
        $arguments = $this->arguments();
        $options = $this->options();
        //print_r($arguments);
        //print_r($options);
        $schema = Schema::getColumnListing($this->option('table'));
        print_r($schema);

        $content = "@extends('back.layouts.app')\n@section('content')\n";
        $content .= "{!! Form::open(['method' => 'post', 'route' => 'home']) !!}\n";

        foreach ($schema as $key => $name) {
            $type = DB::getSchemaBuilder()->getColumnType($this->option('table'), $name);
            $this->info($type);
            $group = '';

            if ($type === 'string') {
                $group .= "\t\t{!! Form::label('$name', '$name', ['class' => 'label-control']) !!}\n";
                $group .= "\t\t{!! Form::text('$name', null, ['class' => 'form-control']) !!}\n";
            } else if ($type === 'text') {
                $group .= "\t\t{!! Form::label('$name', '$name', ['class' => 'label-control']) !!}\n";
                $group .= "\t\t{!! Form::textarea('$name', null, ['class' => 'form-control']) !!}\n";
            } else if ($type === 'boolean') {
                $group .= "\t\t{!! Form::label('$name', '$name', ['class' => 'label-control']) !!}\n";
                $group .= "\t\t{!! Form::checkbox('$name', 1, null, ['class' => 'checkbox']) !!}\n";
            } else if ($type === 'datetime') {
                $group .= "\t\t{!! Form::label('$name', '$name', ['class' => 'label-control']) !!}\n";
                $group .= "\t\t{!! Form::date('$name', 'Y-m-d H:i:s', ['class' => 'form-control']) !!}\n";
            }

            if ($group) {
                $group = "\t<div class='form-group'>\n" . $group . "\t</div>\n";
                $content .= $group;
            }
        }

        $content .= "\t<div class='form-group'>\n{!! Form::submit('Отправить', ['class' => 'btn btn-success']) !!}\t</div>\n";
        $content .= "{!! Form::close() !!}\n@endsection";
        
        Storage::disk('views')->put($this->argument('name') . '.blade.php', $content);
        $view = Storage::disk('views')->path($this->argument('name') . '.blade.php');
        $this->info('Ресурс создан: ' . $view);
    }
}
