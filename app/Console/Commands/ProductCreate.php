<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\ProductRepository;
use Exception;

class ProductCreate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'product:create {name} {reference} {price=99999} {delivery_days=999999}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um produto na base de dados';

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
    public function handle(ProductRepository $product)
    {
        $data = collect(['name' => $this->argument('name'), 'reference' => $this->argument('reference'), 'price' => $this->argument('price'), 'delivery_days' => $this->argument('delivery_days')]);
        $saved = $product->saveterminal($data->toArray());
        if($saved instanceof Exception){
           return $this->error('Erro ao cadastrar produto!. Reveja os campos');
        }
        dump($data);
        $this->info('Produto cadastrado com sucesso!');
    }
}
