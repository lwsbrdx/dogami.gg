<?php

namespace App\Http\Controllers;

use App\Models\Dogami;
use App\Services\DogamiService;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Artisan;

class DogamisController extends BaseController
{
    public function all(Request $request)
    {
        $search = $request->search;
        $breed = $request->breed;

        if ($search != null) {
            $dogamis = Dogami::where('nftId', 'LIKE', "%$search%")
                ->orWhere('name', 'LIKE', "%$search%");
        } else {
            $dogamis = Dogami::query();
        }

        if ($breed) {
            $dogamis = $dogamis->where('attr.trait_type', 'Breed')->where('attr.value', $breed);
        }

        $dogamis = $dogamis->orderBy('nftId')->paginate(24);

        return view('dogamis.all', [
            'dogamis' => $dogamis,
            'search' => $search ?? '',
            'breed' => $breed,
        ]);
    }

    public function one(int $dogami_id, Request $request)
    {
        $dogami = Dogami::find($dogami_id);

        return view('dogamis.one', [
            'dogami' => $dogami,
        ]);
    }

    public function update(int $dogami_id, DogamiService $dogamiService) {
        $dogami = $dogamiService->fetchDogami($dogami_id);
        $dogami->save();

        Artisan::call('dogamis:skills:rankings');

        return redirect()->route('dogamis.one', [$dogami->nftId]);
    }

    public function updateMany(string $dogamis_ids, DogamiService $dogamiService) {
        $ids = explode(',', $dogamis_ids);

        foreach ($ids as $id) {
            $int_id = intval($id);
            if ($int_id) {
                $dogami = $dogamiService->fetchDogami($int_id);
                $dogami->save();
            }
        }

        Artisan::call('dogamis:skills:rankings');

        return redirect()->route('compare', $dogamis_ids);
    }
}
