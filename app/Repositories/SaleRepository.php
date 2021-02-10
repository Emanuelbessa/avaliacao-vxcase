<?php

namespace App\Repositories;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\SaleRequestUpdate;
use App\Models\{Sale};
use Illuminate\Http\Request;
use Carbon\Carbon;

class SaleRepository
{

    private $sale;


    public function __construct()
    {
        $this->sale = new Sale();
    }

    /**
     *
     * @param Request $request
     * @return void
     */
    public function listall(Request $request)
    {
        if (isset($request->per_page))
            $per_page = $request->per_page;
        else
            $per_page = 20;

        return Sale::with('products:name,delivery_days')->paginate($per_page);
    }

    /**
     *
     *
     * @param [type] $id
     * @return void
     */
    public function listbyid($id)
    {
        return $this->sale::find($id);
    }

    /**
     *
     *
     * @param Request $request
     * @return void
     */
    public function save(SaleRequest $request)
    {

        try {
            $this->sale->purchase_at = Carbon::parse($request->purchase_at);
            $this->sale->amount = $request->amount;
            $this->sale->delivery_days = $request->delivery_days;
            $this->sale->save();
            $this->sale->products()->sync($request->products);
            return $this->sale::orderBy('id', 'DESC')->first();
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     *
     *
     * @param SaleRequestUpdate $request
     * @param [type] $id
     * @return void
     */
    public function atualizar(SaleRequestUpdate $request, $id)
    {
        try {

            $this->sale = Sale::find($id);
            $this->sale->purchase_at = Carbon::parse($request->purchase_at);
            $this->sale->save();
            $this->sale->products()->sync($request->products);
            return $this->sale->find($id);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     *
     *
     * @return void
     */
    public function delete($id)
    {

        try {
            $sale = $this->sale->find($id);
            $sale->delete();
        } catch (\Exception $e) {
            return $e;
        }
    }
}
