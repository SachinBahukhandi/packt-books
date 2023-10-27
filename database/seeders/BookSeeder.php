<?php

namespace Database\Seeders;

use App\Services\BookService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

/**
 * BookSeeder class to import data from DB
 */
class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $response = Http::get('https://fakerapi.it/api/v1/books?_quantity=100');
        BookService::import($response->collect());
    }
}
