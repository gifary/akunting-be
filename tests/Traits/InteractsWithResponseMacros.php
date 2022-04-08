<?php

namespace Tests\Traits;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Testing\TestResponse;

trait InteractsWithResponseMacros
{
    /**
     * List of macros
     *
     * @var array
     */
    protected $macros = [
        'data',
        'toArray',
        'hasPaginationKeys',
    ];

    /**
     * Boot the macros
     *
     * @return void
     */
    public function bootResponseMacros()
    {
        foreach ($this->macros as $callable) {
            if (! method_exists($this, $callable)) {
                continue;
            }

            call_user_func([$this, $callable]);
        }
    }

    /**
     * Get a response data based on the given key
     *
     * @return void
     */
    protected function data()
    {
        TestResponse::macro('data', function ($key = null) {
            if (! $key) {
                return $this->original;
            }

            if ($this->original instanceof Collection) {
                return $this->original->{$key};
            }

            return $this->original->getData()[$key];
        });
    }

    /**
     * Convert json response to array
     *
     * @return void
     */
    protected function toArray()
    {
        TestResponse::macro('toArray', function () {
            return (array) json_decode($this->getContent());
        });
    }

    /**
     * Check if response has pagination keys
     *
     * @throws \Exception
     * @return boolean
     */
    protected function hasPaginationKeys()
    {
        TestResponse::macro('hasPaginationKeys', function () {
            $pageKeys = ['current_page', 'per_page'];
            $resourcePageKeys = ['meta.current_page', 'meta.per_page'];

            if (Arr::has($this->json(), 'meta')) {
                return Arr::has($this->json(), $resourcePageKeys);
            }

            return Arr::has($this->json(), $pageKeys);
        });
    }
}
