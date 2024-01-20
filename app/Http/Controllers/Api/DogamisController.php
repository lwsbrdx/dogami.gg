<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Dogami;
use Illuminate\Http\Request;

class DogamisController extends Controller {

    public function search(Request $request) {
        $search = $request->needle;
        $dogamis = [];

        if ($search != null) {
            $dogamis = Dogami::where('nftId', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%")->paginate(10);
        }

        return response()->json($dogamis);
    }
}
