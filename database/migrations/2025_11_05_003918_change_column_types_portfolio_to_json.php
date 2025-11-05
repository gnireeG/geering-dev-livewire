<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, convert existing string data to JSON format
        $portfolios = DB::table('portfolios')->get();
        
        foreach ($portfolios as $portfolio) {
            $updates = [];
            
            // Convert title to JSON if it's not already
            if (!empty($portfolio->title) && !$this->isJson($portfolio->title)) {
                $updates['title'] = json_encode(['de' => $portfolio->title]);
            }
            
            // Convert description to JSON if it's not already
            if (!empty($portfolio->description) && !$this->isJson($portfolio->description)) {
                $updates['description'] = json_encode(['de' => $portfolio->description]);
            }
            
            // Convert shortdesc to JSON if it's not already
            if (!empty($portfolio->shortdesc) && !$this->isJson($portfolio->shortdesc)) {
                $updates['shortdesc'] = json_encode(['de' => $portfolio->shortdesc]);
            }
            
            // Update the record if there are changes
            if (!empty($updates)) {
                DB::table('portfolios')->where('id', $portfolio->id)->update($updates);
            }
        }
        
        // Then change the column types to JSON
        Schema::table('portfolios', function (Blueprint $table) {
            $table->json('title')->nullable()->change();
            $table->json('description')->nullable()->change();
            $table->json('shortdesc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First change back to string type
        Schema::table('portfolios', function (Blueprint $table) {
            $table->text('title')->nullable()->change();
            $table->text('description')->nullable()->change();
            $table->text('shortdesc')->nullable()->change();
        });
        
        // Then convert JSON data back to string (taking German translation)
        $portfolios = DB::table('portfolios')->get();
        
        foreach ($portfolios as $portfolio) {
            $updates = [];
            
            // Convert title back to string
            if (!empty($portfolio->title) && $this->isJson($portfolio->title)) {
                $titleData = json_decode($portfolio->title, true);
                $updates['title'] = $titleData['de'] ?? $titleData[array_key_first($titleData)] ?? '';
            }
            
            // Convert description back to string
            if (!empty($portfolio->description) && $this->isJson($portfolio->description)) {
                $descData = json_decode($portfolio->description, true);
                $updates['description'] = $descData['de'] ?? $descData[array_key_first($descData)] ?? '';
            }
            
            // Convert shortdesc back to string
            if (!empty($portfolio->shortdesc) && $this->isJson($portfolio->shortdesc)) {
                $shortdescData = json_decode($portfolio->shortdesc, true);
                $updates['shortdesc'] = $shortdescData['de'] ?? $shortdescData[array_key_first($shortdescData)] ?? '';
            }
            
            // Update the record if there are changes
            if (!empty($updates)) {
                DB::table('portfolios')->where('id', $portfolio->id)->update($updates);
            }
        }
    }
    
    /**
     * Check if a string is valid JSON
     */
    private function isJson($string): bool
    {
        if (!is_string($string)) {
            return false;
        }
        
        json_decode($string);
        return json_last_error() === JSON_ERROR_NONE;
    }
};
