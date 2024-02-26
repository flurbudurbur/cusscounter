<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @return View 
     * @throws BindingResolutionException 
     */
    public function index(): View
    {
        $count = DB::table('counter')->latest('id')->value('count') ?? 0;
        $undo = session()->get('undo'); // Retrieve flashed 'undo' value from session
        return view('counter', compact('count', 'undo'));
    }


    /**
     * @return View 
     * @throws RuntimeException 
     * @throws BindingResolutionException 
     */
    public function increment(): View
    {
        $count = DB::table('counter')->get()->last()->count ?? 0;
        DB::table('counter')->insert(['count' => $count + 1]);
        $undo = true; // Ensure $undo is set to true
        return $this->index($undo);
    }

    /**
     * @return View 
     * @throws InvalidArgumentException 
     * @throws RuntimeException 
     * @throws BindingResolutionException 
     */
    public function decrement(): View
    {
        $count = DB::table('counter')->get()->last()->count ?? 0;
        $latestCounter = DB::table('counter')->latest('id')->first();
        if ($latestCounter) {
            DB::table('counter')->where('id', $latestCounter->id)->update(['count' => $count - 1]);
        }
        $undo = false; // Ensure $undo is set to false
        return $this->index($undo);
    }
}
