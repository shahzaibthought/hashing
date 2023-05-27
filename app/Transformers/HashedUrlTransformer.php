<?php

namespace App\Transformers;

use App\HashedUrl;

class HashedUrlTransformer
{
	/**
	 * @param HashedUrl $hashedUrl
	 *
	 * @return array
	 */
	public function transform(HashedUrl $hashedUrl) : array
	{
		return [
			'id' => $hashedUrl->id(),
            'url' => $hashedUrl->url(),
            'hashedUrl' => route('web.hashed.urls.show', ['hash' => $hashedUrl->hash()]),
            'clicks' => $hashedUrl->clicks(),
            'createdAt' => $hashedUrl->createdAt(),
            'updatedAt' => $hashedUrl->updatedAt(),
        ];
	}
}
