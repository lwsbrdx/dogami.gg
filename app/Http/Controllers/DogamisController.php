<?php

namespace App\Http\Controllers;

use App\Models\Dogami;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class DogamisController extends BaseController
{
    public function all(Request $request)
    {
        $search = $request->search;
        if ($search != null) {
            $dogamis = Dogami::where('nftId', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        } else {
            $dogamis = Dogami::orderBy('nftId');
        }

        $dogamis = $dogamis->paginate(24);

        return view('dogamis.all', [
            'dogamis' => $dogamis,
            'search' => $search ?? '',
        ]);
    }

    public function one(int $dogami_id, Request $request)
    {
        $dogami = Dogami::find($dogami_id);

        return view('dogamis.one', [
            'dogami' => $dogami,
        ]);
    }
}
