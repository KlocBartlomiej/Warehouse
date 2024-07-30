<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * This file create produkt (products) table
     *  and populate this table with data.
     */
    public function up(): void
    {
        Schema::dropIfExists(env('CUSTOM_DB_TABLE'));

        $content = File::get(env('CUSTOM_DB_CSV_SOURCE'));
        $lines = explode("\n", $content);

        $readHeaders = true;
        foreach ($lines as $line) {
            if ($readHeaders) {  //create table
                $headers = str_getcsv($line);

                Schema::create(env('CUSTOM_DB_TABLE'), function (Blueprint $table) use ($headers) {
                    $table->id()->autoIncrement();
                    $table->string($headers[0]);
                    $table->string($headers[1]);
                    $table->string($headers[2])->nullable();
                    $table->double($headers[3])->nullable();
                    $table->double($headers[4])->nullable();
                    $table->double($headers[5])->nullable();
                    $table->double($headers[6])->nullable();
                    $table->double($headers[7])->nullable();
                    $table->double($headers[8])->nullable();
                    $table->string($headers[9])->nullable();
                    $table->integer($headers[10])->nullable();
                    $table->string($headers[11])->nullable();
                });
                $readHeaders = false;
            } else {  //populate table
                $values = str_getcsv($line);
                //dump($values);
                DB::insert('insert into '.env('CUSTOM_DB_TABLE')." 
                    (
                        id,
                        $headers[0],$headers[1],$headers[2],$headers[3],
                        $headers[4],$headers[5],$headers[6],$headers[7],
                        $headers[8],$headers[9],$headers[10],$headers[11]
                    ) 
                    values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                    [
                        null,
                        $values[0], $values[1], $values[2], 
                        floatval($values[3]), floatval($values[4]),
                        floatval($values[5]), floatval($values[6]),
                        floatval($values[7]), floatval($values[8]),
                        $values[9], intval($values[10]), $values[11]
                    ]
                );
            }

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(env('CUSTOM_DB_TABLE'));
    }
};
