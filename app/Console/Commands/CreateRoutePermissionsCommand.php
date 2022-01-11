<?php

namespace App\Console\Commands;

use App\Http\Requests\NewsRequest;
use App\Repositories\NewsRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Spatie\Permission\Models\Permission;

class CreateRoutePermissionsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:create-permission-routes';
    protected $repo;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a permission routes.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }

    public function handle()
    {
        $products= Products::where('items.$.avQuantity', '=', 0)->get();
        foreach ($products as $product){
            $product->update(['status'=> INACTIVE]);
            Log::info("product status changed". $product->_id );
        }

    }
}
