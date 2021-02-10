<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Http\Requests\ProductRequestUpdate;
use App\Repositories\ProductRepository;
use Exception;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ProductRepository $product, Request $request)
    {
        return response()->json($product->listall($request), Response::HTTP_OK);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, ProductRepository $product)
    {

        try {
            $save = $product->save($request);

            if ($save instanceof Exception) {
                throw new Exception($save);
            }

            return response()->json(['message' => 'Produto cadastrado!', $save], Response::HTTP_CREATED);
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
    public function show($id, ProductRepository $product)
    {
        return response()->json($product->listbyid($id), Response::HTTP_OK);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequestUpdate $request, $id, ProductRepository $product)
    {

        try {
            $update = $product->atualizar($request, $id);

            if ($update instanceof Exception) {
                throw $update;
            }

            return response()->json(['message' => 'Produto Atualizado!', $update], Response::HTTP_OK);
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
    public function destroy($id, ProductRepository $product)
    {
        try {
            $delete = $product->delete($id);

            if ($delete instanceof Exception) {
                throw $delete;
            }

            return response()->json(['message' => 'Produto Excluido!'], Response::HTTP_OK);
        } catch (\Exception $e) {
            return $e;
        }
    }
}
