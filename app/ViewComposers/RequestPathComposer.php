<?php namespace App\Http\ViewComposers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;

class RequestPathComposer
{
    protected $path;

    public function __construct(Request $request)
    {
        $this->path = $request->path();
    }

    public function compose(View $view)
    {
        $view->with('path', $this->path);
    }
}
