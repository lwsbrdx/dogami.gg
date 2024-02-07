<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dogami;
use Illuminate\Http\Request;

class DogamisController extends Controller {

    public function search(Request $request) {
        $search = $request->needle;
        $isComparator = (bool) $request->comparator;
        $dogamis = [];

        if ($search != null) {
            $dogamis = Dogami::where('nftId', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        }

        if ($isComparator) {
            $dogamis = $dogamis->where('attr.trait_type', 'Status')->where('attr.value', 'Puppy');
        }

        $dogamis = $dogamis->paginate(10);

        return response()->json($dogamis);
    }
}
