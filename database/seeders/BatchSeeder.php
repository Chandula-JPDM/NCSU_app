<?php

namespace Database\Seeders;

use App\Models\Batch;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BatchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $batch_list = [
            ['id'=>16, 'batch'=>'16 batch'],
            ['id'=>17, 'batch'=>'17 batch'],
            ['id'=>18, 'batch'=>'18 batch'],
            ['id'=>19, 'batch'=>'19 batch'],
            ['id'=>20, 'batch'=>'20 batch'],
        ];

        //if the table batches has no data, seed them with dummy data
        if (DB::table('batches')->count() == 0) {
            foreach ($batch_list as $batch) {
                Batch::create($batch);
            }
        }
    }
}
