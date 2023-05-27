<?php

namespace App\Http\Controllers\Api;

use App\HashedUrlRepository;
use App\Transformers\HashedUrlTransformer;
use App\Http\Controllers\Controller;
use App\Http\Requests\HashedUrl\StoreRequest;
use Illuminate\Http\JsonResponse;

class HashedUrlController extends Controller
{
    /**
     * @param StoreRequest $request
     * @param HashedUrlRepository $repository
     * @param HashedUrlTransformer $transformer
     *
     * @return JsonResponse
     */
    public function store(
        StoreRequest $request,
        HashedUrlRepository $repository,
        HashedUrlTransformer $transformer
    ) : JsonResponse {
        try {
            $hashedUrl = $repository->hashedUrl($request->url());

            return response()->json($transformer->transform($hashedUrl), 200);
        } catch (\Exception $e) {
            \Log::error('Error while generating the URL hash', ['message' => $e->getTraceAsString()]);

            return response()->json([
                'error' => 'There has been some errors while generating the URL hash.',
            ], 500);
        }
    }

    /**
     * @param HashedUrlRepository $repository
     * @param HashedUrlTransformer $transformer
     * @param string $hash
     *
     * @return mixed
     */
    public function show(HashedUrlRepository $repository, HashedUrlTransformer $transformer, string $hash)
    {
        try {
            $hashedUrl = $repository->findByHash($hash);

            if (! empty($hashedUrl)) {
                return response()->json($transformer->transform($hashedUrl), 200);
            }

            return response()->json([
                'error' => 'The URL was\'t found.',
            ], 404);
        } catch (\Exception $e) {
            \Log::error('Error while getting the URL statistics', ['message' => $e->getTraceAsString()]);

            return response()->json([
                'error' => 'There has been some errors while getting the URL statistics.',
            ], 500);
        }
    }
}
