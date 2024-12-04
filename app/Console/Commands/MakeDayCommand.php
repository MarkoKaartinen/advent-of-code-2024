<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class MakeDayCommand extends Command
{
    protected $signature = 'make:day {number}';

    protected $description = 'Makes a day scaffolding';

    public Filesystem $filesystem;

    public function __construct(Filesystem $filesystem)
    {
        parent::__construct();

        $this->filesystem = $filesystem;
    }

    public function handle(): void
    {
        $this->createDayFile();
        $this->createDayTestFile();
        $this->createDayInputFile();
    }

    public function createDayFile()
    {
        $path = base_path('app/Days') . '/Day' . $this->argument('number') . '.php';
        $contents = $this->getStubContents($this->getDayStubPath(), $this->getStubVariables());

        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $contents);
            $this->info("File : $path created");
        } else {
            $this->info("File : $path already exits");
        }
    }

    public function createDayTestFile()
    {
        $path = base_path('tests/Feature') . '/Day' . $this->argument('number') . 'Test.php';
        $contents = $this->getStubContents($this->getDayTestStubPath(), $this->getStubVariables());
        if (! $this->filesystem->exists($path)) {
            $this->filesystem->put($path, $contents);
            $this->info("File : $path created");
        } else {
            $this->info("File : $path already exits");
        }
    }

    public function createDayInputFile()
    {
        $path = 'day' . $this->argument('number') . '.txt';
        if (! Storage::disk('inputs')->exists($path)) {
            Storage::disk('inputs')->put($path, $this->getDaysInput());
            $this->info("File : $path created");
        } else {
            $this->info("File : $path already exits");
        }
    }

    public function getDaysInput(): string
    {
        $url = 'https://adventofcode.com/2024/day/' . $this->argument('number') . '/input';
        $response = Http::withCookies(['session' => config('aoc.session')], 'adventofcode.com')->get($url);
        if ($response->successful()) {
            return trim($response->body());
        }

        return '';
    }

    public function getStubContents($stub, $stubVariables = []): array|bool|string
    {
        $contents = file_get_contents($stub);

        foreach ($stubVariables as $search => $replace) {
            $contents = str_replace('$' . $search . '$', $replace, $contents);
        }

        return $contents;
    }

    public function getDayStubPath(): string
    {
        return __DIR__ . '/../../../stubs/day.stub';
    }

    public function getDayTestStubPath(): string
    {
        return __DIR__ . '/../../../stubs/daytest.stub';
    }

    public function getStubVariables(): array
    {
        return [
            'NUMBER' => $this->argument('number'),
        ];
    }
}
