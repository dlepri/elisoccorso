<?php

namespace App\Http\Controllers;

use App\Type;
use App\Pitch;
use App\Secondary;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSecondary;

class SecondaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $secondaries = Secondary::all();
        return view('secondaries.index', compact('secondaries'));
    }
    public function edit(Secondary $secondary)
    {
        $types = Type::orderBy('name')->get();
        $pitches = Pitch::whereActive(true)->get();
        return view('secondaries.edit', compact('secondary', 'types', 'pitches'));
    }
    public function update(StoreSecondary $request, Secondary $secondary)
    {
        $secondary->edit($request->validated());
        laraflash("Il punto è stato modificato con successo.", 'Ottimo!')->success();
        return redirect(route('secondaries.index'));
    }
    public function destroy(Secondary $secondary)
    {
        $secondary->delete();
        laraflash("Il punto è stato eliminato con successo.", 'Ottimo!')->success();
        return redirect(route('secondaries.index'));
    }
}
