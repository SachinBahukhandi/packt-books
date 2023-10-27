<?php

namespace App\Services;

use App\Jobs\ImportDefaultBooks;
use App\Models\Book;
use Illuminate\Bus\Batch;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * BookService to manage the book based services
 */
class BookService
{
    /**
     * Does the task of importing data from the API Service and pushing it into Database.
     * Also, added a chunk of 10 items each.
     *
     * @return void
     */
    public static function import(Collection $books)
    {
        // Log::info(json_encode($books, JSON_PRETTY_PRINT));
        // dd($data);
        $chunks = collect($books->get('data'))->chunk(10);
        $batch = Bus::batch([]);
        $chunks->map(
            function ($chunk) use ($batch) {
                $batch->add(new ImportDefaultBooks($chunk));
            }
        );
        $batch->then(
            function (Batch $batch) {
                // All jobs completed successfully...
                logger('Batch '.$batch->id.' finished successfully!');
            }
        )->catch(
            function (Batch $batch, Throwable $e) {
                // First batch job failure detected...
                logger('Batch '.$batch->id.' did not finish successfully!');
            }
        )->finally(
            function (Batch $batch) {
                // The batch has finished executing...
                logger('Cleaning leftovers from batch '.$batch->id);
            }
        )->name('send_email')->dispatch();
    }

    /**
     * Adding the data 10 at a time.
     * Discarding using the model just because it could impact time using Eloquent's overhead
     *
     * @return void
     */
    public static function importIntoDB(Collection $data)
    {
        try {
            DB::beginTransaction();
            DB::table('books')->insertOrIgnore($data->toArray());
            DB::commit();

            Log::error(json_encode($data->toArray(), JSON_PRETTY_PRINT));
        } catch (QueryException $e) {
            DB::rollBack();
            Log::error(json_encode($e, JSON_PRETTY_PRINT));
        }

    }
}
