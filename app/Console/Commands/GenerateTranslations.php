<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Finder\Finder;

class GenerateTranslations extends Command
{
    protected $signature = 'translate:generate {locale}';
    protected $description = 'Generate JSON translation file for a given locale';

    public function handle()
    {
        $locale = $this->argument('locale');
        $langPath = lang_path();

        // Create lang directory if not exists
        if (!File::exists($langPath)) {
            File::makeDirectory($langPath, 0755, true, true);
            $this->info("Created language directory: {$langPath}");
        }

        $outputFile = lang_path("{$locale}.json");

        // Rest of the code remains the same
        $existingTranslations = [];
        if (File::exists($outputFile)) {
            $existingTranslations = json_decode(File::get($outputFile), true) ?? [];
        }

        $newTranslations = $this->findTranslationKeys();
        $mergedTranslations = array_merge(
            array_fill_keys($newTranslations, ''),
            $existingTranslations
        );

        ksort($mergedTranslations);

        File::put($outputFile, json_encode($mergedTranslations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));

        $this->info("Translation file generated for {$locale}: " . $outputFile);
        $this->info("Total keys: " . count($mergedTranslations));
    }

    // Rest of the findTranslationKeys() method remains the same
    private function findTranslationKeys(): array
    {
        $translationKeys = [];
        $functions = ['__', 'trans', '@lang'];

        $finder = new Finder();
        $files = $finder->in([
            app_path(),
            resource_path('views'),
            base_path('routes'),
        ])->name('*.php');

        foreach ($files as $file) {
            $content = File::get($file->getRealPath());

            foreach ($functions as $function) {
                $pattern = '/\b' . preg_quote($function) . '\s*\(\s*[\'"](.+?)[\'"]\s*[\),]/';
                preg_match_all($pattern, $content, $matches);

                if (!empty($matches[1])) {
                    $translationKeys = array_merge($translationKeys, $matches[1]);
                }
            }
        }

        return array_unique($translationKeys);
    }
}
/*namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class GenerateTranslations extends Command
{
    protected $signature = 'translate:generate {locale}';
    protected $description = 'Generate or update a JSON translation file for the given locale by scanning translatable strings';

    public function handle()
    {
        $locale = $this->argument('locale');
        $path = base_path("lang/{$locale}.json");
        // Ensure the lang directory exists
        if (!File::exists(base_path('lang'))) {
            File::makeDirectory(base_path('lang'), 0755, true);
        }

        // Ensure the locale file exists
        if (!File::exists($path)) {
            File::put($path, json_encode([], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }

        // Get existing translations from the locale file
        $translations = json_decode(File::get($path), true) ?? [];

        // Find all translatable strings
        $strings = $this->findTranslatableStrings();

        // Add missing translations to the locale file
        foreach ($strings as $string) {
            // Check if the translation is not already present
            if (!isset($translations[$string])) {
                $translations[$string] = ''; // Empty string to indicate untranslated
                $this->info("Added missing translation for: {$string}");
            }
        }

        // Write the updated translations back to the file
        File::put($path, json_encode($translations, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        $this->info("Translation file generated or updated: {$path}");
    }

    private function findTranslatableStrings()
    {
        $directories = [base_path('resources/views'), app_path(), base_path('routes'), base_path('app')];
        $strings = [];

        foreach ($directories as $directory) {
            $files = File::allFiles($directory);

            foreach ($files as $file) {
                $contents = $file->getContents();

                // Match __() calls with simple strings
                if (preg_match_all("/__\(\s*['\"](.*?)['\"]\s*(?:,\s*\[.*?\])?\)/", $contents, $matches)) {
                    $strings = array_merge($strings, $matches[1]);
                }

                // Match @lang() calls with simple strings
                if (preg_match_all("/@lang\(\s*['\"](.*?)['\"]\s*(?:,\s*\[.*?\])?\)/", $contents, $matches)) {
                    $strings = array_merge($strings, $matches[1]);
                }

                // Match __() calls with dynamic placeholders (e.g., __(':attribute is not valid :name'))
                if (preg_match_all("/__\(\s*['\"](.*?)['\"]\s*,\s*\[.*?\]\)/", $contents, $matches)) {
                    foreach ($matches[1] as $match) {
                        $pattern = $this->sanitizeStringWithPlaceholders($match);
                        if (!in_array($pattern, $strings)) {
                            $strings[] = $pattern;
                        }
                    }
                }

                // Match @lang() calls with dynamic placeholders
                if (preg_match_all("/@lang\(\s*['\"](.*?)['\"]\s*,\s*\[.*?\]\)/", $contents, $matches)) {
                    foreach ($matches[1] as $match) {
                        $pattern = $this->sanitizeStringWithPlaceholders($match);
                        if (!in_array($pattern, $strings)) {
                            $strings[] = $pattern;
                        }
                    }
                }
            }
        }

        return array_unique($strings);
    }

    private function sanitizeStringWithPlaceholders($string)
    {
        // This function sanitizes strings with dynamic placeholders by removing the placeholder values
        return preg_replace_callback('/:\w+/', function ($matches) {
            return ':placeholder'; // Normalize placeholder
        }, $string);
    }
}*/
