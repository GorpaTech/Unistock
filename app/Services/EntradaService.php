<?php

namespace App\Services;

use App\Http\Requests\StoreUpdateEntradaFormRequest;
use App\Models\Entrada;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class EntradaService
{

    public function getAll() {
        return Entrada::orderBy('id')->get();
    }

    public function store(StoreUpdateEntradaFormRequest $request){
        Entrada::create($request->all());
    }

    public function getById($id) {
        $entrada = Entrada::find($id);
        return $entrada;
    }

    public function update(Request $request, Entrada $entrada){
        $entrada->update($request->all());
    }

    public function destroy(Entrada $entrada){
        $entrada->delete();
    }

    public function filter(Builder $query){

    }
}
