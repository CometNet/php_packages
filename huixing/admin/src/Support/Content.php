<?php

namespace Huixing\Admin\Support;

use Huixing\Admin\Facades\Admin;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Arr;

class Content implements Renderable
{

    /**
     * Render this content.
     *
     * @return string
     */
    public function render()
    {
        $items = [
        ];

        return view('admin::content', $items)->render();
    }
}