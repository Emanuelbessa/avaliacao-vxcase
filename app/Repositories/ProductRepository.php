<?php

namespace App\Repositories;

use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductRequestUpdate;
use App\Models\{Product};
use Illuminate\Http\Request;

class ProductRepository{

    private $product;


    public function __construct()
    {
        $this->product = new Product();
    }

    /**
     *
     *
     * @return void
     */
    public function listall()
    {
        return $this->product->all();
    }

    /**
     *
     *
     * @param [type] $id
     * @return void
     */
    public function listbyid($id)
    {
        return $this->product::find($id);
    }

    /**
     *
     *
     * @param Request $request
     * @return void
     */
    public function save(ProductRequest $request)
    {

        try {
            $this->product::create($request->all());
            return $this->product::orderBy('id', 'DESC')->first();

        } catch (\Exception $e) {
           return $e;
        }
    }

     /**
     *
     *
     * @param ProductRequestUpdate $request
     * @param [type] $id
     * @return void
     */
    public function atualizar(ProductRequestUpdate $request, $id)
    {
        try {
            $this->product::find($id)->update($request->all());
            return $this->product->find($id);

        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     *
     *
     * @return void
     */
    public function delete($id){

        try {
           $product = $this->product->find($id);
           $product->delete();

        } catch (\Exception $e) {
             return $e;
        }
     }

}
