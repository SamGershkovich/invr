<?php

namespace App\Console\Commands;

use App\Models\Product;
use App\Models\Inventory;
use Log;
use App\Models\Shrink;
use Illuminate\Console\Command;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class GenerateDailyInventoryRecords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:generateDailyInventoryRecords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the daily inventory and shrink records for a number of random products';

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
      $products =  Product::all()->random(100);
      foreach($products as $product){
        $inv_record = Inventory::create([
          'product_id' => $product->id,
          'inventory_date' => Carbon::now(),
          'updated_by' => 0,
        ]);
        //Log::debug(['inv record' => $inv_record->id]);
        Shrink::create([
            'inventory_id' => $inv_record->id,
            'updated_by' => 0,
        ]);
      }
    }
}
