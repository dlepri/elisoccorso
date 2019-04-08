<?php

namespace App\Http\Controllers;

use App\Type;
use Illuminate\Http\Request;
use App\Http\Requests\StoreType;

class TypeController extends Controller
{
    public function index()
    {
        $types = Type::all();
        return view('types.index', compact('types'));
    }
    public function create()
    {
        return view('types.create');
    }
    public function store(StoreType $request)
    {
        $type = new Type;
        $type->add($request->validated());
        laraflash()->message()->content('Some content')->title('Some title')->type('success');
        return redirect(route('types.index'));
    }
    public function edit(Type $type)
    {
        return view('types.edit', compact('type'));
    }
    public function update(StoreType $request, Type $type)
    {
        $type->edit($request->validated());
        laraflash("Il tipo è stato modificato con successo.", 'Ottimo!')->success();
        return redirect(route('types.index'));
    }
    public function destroy(Type $type)
    {
        $type->delete();
        laraflash("Il tipo è stato eliminato con successo.", 'Ottimo!')->success();
        return redirect(route('types.index'));
    }
}
