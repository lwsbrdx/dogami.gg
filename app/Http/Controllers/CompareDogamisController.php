<?php

namespace App\Http\Controllers;

use App\Models\Dogami;

class CompareDogamisController extends Controller
{
    public function show(string $dogamis_list) {
        $dogamis_ids = explode(',', $dogamis_list) ?? [];
        $int_dogamis_ids = [];

        foreach ($dogamis_ids as $dogami_id) {
            $int_dogami_id = intval($dogami_id);
            if ($int_dogami_id !== 0) {
                $int_dogamis_ids[] = $int_dogami_id;
            }
        }

        /** @var Dogami[] $dogamis */
        $dogamis = Dogami::whereIn('nftId', $int_dogamis_ids)->limit(2)->get();

        return view('compare.show', [
            'dogamis' => $dogamis
        ]);
    }
}
