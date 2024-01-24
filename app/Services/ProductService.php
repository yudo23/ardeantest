<?php

namespace App\Services;

use App\Services\BaseService;
use App\Http\Requests\Product\StoreRequest;
use App\Http\Requests\Product\UpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;
use Throwable;

class ProductService extends BaseService
{
    protected $product;

    public function __construct()
    {
        $this->product = new Product();
    }

    public function index(Request $request, bool $paginate = true)
    {
        $search = (empty($request->search)) ? null : trim(strip_tags($request->search));

        $table = $this->product;
        if (!empty($search)) {
            $table = $this->product->where(function ($query2) use ($search) {
                $query2->where('name', 'like', '%' . $search . '%');
                $query2->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        if ($paginate) {
            $table = $table->orderBy('created_at', 'DESC');
            $table = $table->paginate(10);
            $table = $table->withQueryString();
        } else {
            $table = $table->orderBy('created_at', 'ASC');
            $table = $table->get();
        }

        $table->transform(function($item){
            return [
                'id' => $item->id,
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'rupiah' => $item->price * 14000,
                'created_at' => $item->created_at,
                'updated_at' => $item->updated_at,
            ];
        });

        return $this->response(true, 'Berhasil mendapatkan data', $table);
    }

    public function show($id)
    {
        try {
            $result = $this->product;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan",null,Response::HTTP_NOT_FOUND);
            }

            $data = [
                'id' => $result->id,
                'name' => $result->name,
                'description' => $result->description,
                'price' => $result->price,
                'rupiah' => $result->price * 14000,
                'created_at' => $result->created_at,
                'updated_at' => $result->updated_at,
            ];

            return $this->response(true, 'Berhasil mendapatkan data', $data);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $description = (empty($request->description)) ? null : trim(strip_tags($request->description));
            $price = (empty($request->price)) ? null : trim(strip_tags($request->price));

            $create = $this->product->create([
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]);

            return $this->response(true, 'Berhasil menambahkan data',$create);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function update(UpdateRequest $request, $id)
    {
        try {
            $name = (empty($request->name)) ? null : trim(strip_tags($request->name));
            $description = (empty($request->description)) ? null : trim(strip_tags($request->description));
            $price = (empty($request->price)) ? null : trim(strip_tags($request->price));

            $result = $this->product;
            $result = $result->findOrFail($id);

            $result->update([
                'name' => $name,
                'description' => $description,
                'price' => $price,
            ]);

            return $this->response(true, 'Berhasil mengubah data',$result);
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }

    public function delete($id)
    {
        try {
            $result = $this->product;
            $result = $result->where("id",$id);
            $result = $result->first();

            if(!$result){
                return $this->response(false, "Data tidak ditemukan",null,Response::HTTP_NOT_FOUND);
            }
            
            $result->delete();

            return $this->response(true, 'Berhasil menghapus data');
        } catch (Throwable $th) {
            Log::emergency($th->getMessage());

            return $this->response(false, "Terjadi kesalahan saat memproses data");
        }
    }
}
