<?php

namespace App\Http\Controllers;

use App\Models\Dogami;
use Illuminate\Http\Request;

class CompareDogamisController extends Controller
{
    public function show(Request $request, string $dogamis_list = '') {
        if ($request->dogamis) {
            $dogamis_ids = $request->dogamis;
        } else {
            $dogamis_ids = explode(',', $dogamis_list) ?? [];
        }

        $int_dogamis_ids = [];

        foreach ($dogamis_ids as $dogami_id) {
            $int_dogami_id = intval($dogami_id);
            if ($int_dogami_id !== 0) {
                $int_dogamis_ids[] = $int_dogami_id;
            }
        }

        /** @var Dogami[] $dogamis */
        $dogamis = Dogami::whereIn('nftId', $int_dogamis_ids)->limit(2)->get()->all();

        return view('compare.show', [
            'dogamis' => $dogamis
        ]);
    }
}
