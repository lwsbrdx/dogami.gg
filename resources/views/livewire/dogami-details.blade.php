<div>
    @if ($dogami !== null)
        <div class="min-w-60 w-min mx-auto text-center">
            <img class="rounded-md" src="{{ $dogami->image }}" alt="{{ $dogami->name }}">
            <p class="mt-4 mb-0">{{ $dogami->rarity }}</p>
            <p class="mt-1">{{ $dogami->name }}</p>
            @if ($dogami->isPuppy)
                <p class="mt-1 mb-4">{{ $dogami->breed->name }}</p>
            @endif
            @include('components.button', [
                'link' => "https://objkt.com/tokens/dogami/$dogami->nftId",
                'label' => 'See on objkt.com'
            ])
        </div>

        <div class="flex flex-col gap-2 w-fit mx-auto my-3">
            @include('components.button', [
                'label' => 'Update this Dogami',
                'attributes' => [
                    'wire:click' => 'update',
                    'wire:loading.attr' => 'disabled',
                ]
            ])
        </div>

        @if ($dogami->isPuppy)
            <div class="flex flex-col w-fit mx-auto text-center">
                <p>ID : {{ $dogami->nftId }}</p>
                <p>Level : {{ $dogami->level }}</p>
            </div>
            <div class="max-w-fit mx-auto mt-4">
                @include('components.button', [
                    'label' => $use_max_values ? 'Use actual values' : 'Use max values',
                    'attributes' => [
                        'wire:click' => 'toggleUseMax'
                    ]
                ])
            </div>
        @endif

        @if (count($dogami->skills) > 0)
            <div class="flex flex-row items-center justify-center mt-8">
                @include('components.dogami-skills', [
                    "dogami" => $dogami,
                    "use_max_values" => $use_max_values,
                    "attributes" => [
                        'wire:loading.class' => "opacity-60",
                        'wire:target' => 'update'
                    ]
                ])
            </div>
        @endif
    @else
        <div>
            Dogami does not exists
        </div>
    @endif
</div>
