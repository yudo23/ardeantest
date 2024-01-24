<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Http\Response;
use App\Helpers\ResponseHelper;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    protected $productService;

    public function __construct()
    {
        $this->productService = new ProductService();
    }

    public function index(Request $request)
    {
        try {
            $response = $this->productService->index($request,true);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , $response->data, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $response = $this->productService->store($request);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function update(UpdateRequest $request,$id)
    {
        try {
            $response = $this->productService->update($request,$id);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , null, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function show($id)
    {
        try {
            $response = $this->productService->show($id);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , $response->data, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function destroy($id)
    {
        try {
            $response = $this->productService->delete($id);
            if (!$response->success) {
                return ResponseHelper::apiResponse(false, $response->message , null, $response->code);
            }

            return ResponseHelper::apiResponse(true, $response->message , $response->data, $response->code);
        } catch (\Throwable $th) {
            Log::emergency($th->getMessage());

            return ResponseHelper::apiResponse(false, $th->getMessage() , null, Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
