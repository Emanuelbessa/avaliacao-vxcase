<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaleRequest;
use App\Http\Requests\SaleRequestUpdate;
use App\Repositories\SaleRepository;
use Exception;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, SaleRepository $sale)
    {
        return response()->json($sale->listall($request), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaleRequest $request, SaleRepository $sale)
    {
        try {
            $save = $sale->save($request);

            if ($save instanceof Exception) {
                throw new Exception($save);
            }

            return response()->json(['message' => 'Venda realizada com sucesso!', $save], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, SaleRepository $sale)
    {
        return response()->json($sale->listbyid($id), Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaleRequestUpdate $request, $id, SaleRepository $sale)
    {
        try {
            $update = $sale->atualizar($request, $id);

            if ($update instanceof Exception) {
                throw $update;
            }

            return response()->json(['message' => 'Venda alterada com sucesso!', $update], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, SaleRepository $sale)
    {
        try {
            $delete = $sale->delete($id);

            if ($delete instanceof Exception) {
                throw $delete;
            }

            return response()->json(['message' => 'Venda Excluida!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
