<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CV;
use Illuminate\Support\Facades\Log;

class FixCVFilePaths extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cv:fix-paths';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fix CV file paths by converting absolute paths to relative paths';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting CV file path fix...');
        
        $cvs = CV::all();
        $fixedCount = 0;
        $skippedCount = 0;
        
        foreach ($cvs as $cv) {
            $originalPath = $cv->file_path;
            
            // Check if the path is already relative (doesn't contain storage_path)
            if (!str_contains($originalPath, storage_path(''))) {
                $this->line("Skipping CV {$cv->id}: Already has relative path");
                $skippedCount++;
                continue;
            }
            
            // Extract the relative path from the absolute path
            $storagePath = storage_path('app/public/');
            if (str_contains($originalPath, $storagePath)) {
                $relativePath = str_replace($storagePath, '', $originalPath);
                
                // Update the CV record
                $cv->file_path = $relativePath;
                $cv->save();
                
                $this->info("Fixed CV {$cv->id}: {$originalPath} -> {$relativePath}");
                $fixedCount++;
                
                Log::info('Fixed CV file path', [
                    'cv_id' => $cv->id,
                    'original_path' => $originalPath,
                    'new_path' => $relativePath
                ]);
            } else {
                $this->warn("Could not fix CV {$cv->id}: Unexpected path format: {$originalPath}");
            }
        }
        
        $this->info("Completed! Fixed {$fixedCount} CV file paths, skipped {$skippedCount} already correct paths.");
        
        return Command::SUCCESS;
    }
}