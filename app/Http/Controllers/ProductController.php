<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ProductListResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'updated_at');
        $sortDirection = request('sort_direction', 'desc');
        return ProductListResource::collection(Product::query()
            ->where('title', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        $image = $data['image'] ?? null;
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = $relativePath;
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }

        $product = Product::create($data);
        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        $image = $data['image'] ?? null;

        if($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = $relativePath;
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            if($product->image) {
                Storage::deleteDirectory('public/' . dirname($product->image));
            }
        }
        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $disk = Storage::disk('public');
        if($product->image) {
            $disk->delete($product->image);
            $dir = dirname($product->image);
            if (empty($disk->files($dir)) && empty($disk->directories($dir))) {
                $disk->deleteDirectory($dir);
            }
        }

        $product->delete();
        return response()->noContent();
    }

    private function saveImage(UploadedFile $image) {
        $dir = 'images/' . Str::random();
        $disk = Storage::disk('public');
        if (!$disk->exists($dir)) {
            $disk->makeDirectory($dir);
        }
        $name = Str::slug(pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME)) . '-' . Str::random(6) . '.' . $image->getClientOriginalExtension();

        $path = $disk->putFileAs($dir, $image, $name);
        if(!$path) {
            throw new \RuntimeException('Unable to save file');
        }

        return $path;
    }
}
