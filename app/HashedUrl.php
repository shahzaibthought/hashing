<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class HashedUrl extends Model
{
    /**
     * @return int
     */
    public function id() : int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function hash() : string
    {
        return $this->hash;
    }

    /**
     * @param string $url
     *
     * @return self
     */
    public function setUrl(string $url) : self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @param string $hash
     *
     * @return self
     */
    public function setHash(string $hash) : self
    {
        $this->hash = $hash;

        return $this;
    }

    /**
     * @param Builder $query
     * @param string $url
     *
     * @return Builder
     */
    public function scopeByUrl(Builder $query, string $url) : Builder
    {
        return $query->where('url', $url);
    }
}
