<?php

namespace App\Observers;

use Illuminate\Support\Facades\Cache;

class TitleObserver
{
    public function clearCache()
    {
        Cache::clear();
    }

    public function created()
    {
        $this->clearCache();
    }

    public function updated()
    {
        $this->clearCache();
    }

    public function deleted()
    {
        $this->clearCache();
    }
}
