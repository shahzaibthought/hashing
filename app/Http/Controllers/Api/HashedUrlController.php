<?php

namespace App\Http\Controllers\Api;

use App\HashedUrlRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\HashedUrl\StoreRequest;
use Illuminate\Http\JsonResponse;

class HashedUrlController extends Controller
{
    /**
     * @param StoreRequest $request
     * @param HashedUrlRepository $repository
     *
     * @return JsonResponse
     */
    public function store(StoreRequest $request, HashedUrlRepository $repository) : JsonResponse
    {
        try {
            $urlHash = $repository->urlHash($request->url());

            return response()->json([
                'url' => route('web.hashed.urls.show', ['id' => $urlHash]),
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error while generating the URL hash', ['message' => $e->getTraceAsString()]);

            return response()->json([
                'error' => 'There has been some errors while generating the URL hash.',
            ], 500);
        }
    }
}
