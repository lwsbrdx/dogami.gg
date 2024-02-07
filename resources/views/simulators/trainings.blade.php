@extends('layout.app')

@section('content')
    <form action="{{ route('simulators.training.skills') }}" method="post">
        @csrf

        <input type="hidden" name="simulate" value="true">

        <div class="px-4 flex flex-col gap-y-2">
            <label class="text-center flex flex-col items-center" for="starting_bonus">
                <p class="mb-2">Start at</p>
                <input
                    class="text-center w-72 border-4 border-[#60297a] rounded-sm"
                    id="starting_bonus"
                    type="number"
                    name="starting_bonus"
                    value="{{ $training_datas->starting_bonus }}"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::MAX_BONUSES }}"
                    step="1"
                />
            </label>

            <label class="text-center flex flex-col items-center" for="starting_bonus_xp">
                <p class="mb-2">With XP points</p>
                <input
                    class="text-center w-72 border-4 border-[#60297a] rounded-sm"
                    id="starting_bonus_xp"
                    type="number"
                    name="starting_bonus_xp"
                    value="{{ $training_datas->starting_bonus_xp }}"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::BONUS_LEVEL_CEILING }}"
                    step="1"
                />
            </label>

            <label class="text-center flex flex-col items-center" for="end_bonus">
                <p class="mb-2">End at</p>
                <input
                    class="text-center w-72 border-4 border-[#60297a] rounded-sm"
                    id="end_bonus"
                    type="number"
                    name="end_bonus"
                    value="{{ $training_datas->end_bonus }}"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::MAX_BONUSES }}"
                    step="1"
                />
            </label>

            <label class="text-center flex flex-col items-center max-w-fit mx-auto" for="unlimited_stars">
                <p class="mb-2">Unlimited Stars</p>
                <input
                    class="border-4 border-[#60297a] rounded-sm"
                    type="checkbox"
                    name="unlimited_stars"
                    id="unlimited_stars"
                    checked="{{ $training_datas->stars_bag === INF }}"
                />
            </label>
            <label class="text-center flex flex-col items-center" for="stars_bag">
                <p class="mb-2">How much stars do you want to use</p>
                <input
                    class="text-center w-72 border-4 border-[#60297a] rounded-sm"
                    id="stars_bag"
                    type="number"
                    name="stars_bag"
                    value="{{ $training_datas->stars_bag === INF ? 0 : $training_datas->stars_bag }}"
                    min="0"
                    step="1"
                />
            </label>

            <div class="mx-auto max-w-32 sm:max-w-40">
                @include('components.button', [
                    'label' => 'Simulate',
                ])
            </div>
        </div>
    </form>

    @if ($results !== null)
        <div class="mt-10 max-w-[768px] mx-auto">
            <div class="text-center font-bold text-lg">
                <p>Results</p>
            </div>
            <div class="splide trainings-results mt-6 pb-6">
                <div class="splide__track">
                    <div class="splide__list sm:!text-center sm:!grid sm:!grid-cols-2 sm:!gap-y-6 sm:!justify-items-center">
                        @foreach ($results as $result)
                            <div class="splide__slide sm:max-w-80">
                                <div class="px-8">
                                    <p>You started with bonus : +{{ $result->starting_bonus }}</p>
                                    <p>Simulation ended at bonus : +{{ $result->end_bonus }}</p>
                                    @if ($result->treatType !== App\Classes\Dogami\ObjectEnums\DogamiTreatType::NO_TREATS)
                                        <p>Treats used : {{ $result->treatType->name }}</p>
                                    @endif
                                    @if ($result->starsLeft !== INF)
                                        <p>Yours stars left : {{ number_format($result->starsLeft, decimals: 0, thousands_separator: ",") }}</p>
                                    @endif
                                    <p>Total trainings : {{ $result->total_trainings }}</p>
                                    <p>Total cost : {{ number_format($result->total_training_cost, decimals: 0, thousands_separator: ",") }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <ul class="splide__pagination !bottom-0"></ul>
            </div>

            <div class="text-center px-4 pt-4 text-xs text-gray-600">
                <p>The above results are only indicative and approximate.</p>
            </div>
        </div>
    @endif
@endsection
