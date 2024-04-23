@extends('layout.site.app')

@use(App\Classes\Dogami\ObjectEnums\DogamiSkillEnum)
@use(App\Classes\Dogami\ObjectEnums\DogamiTreatType)

@section('content')
    <form action="{{ route('simulators.training.dogami') }}" method="post" class="flex flex-col items-center">
        @csrf

        <div class="flex flex-col sm:flex-row justify-items-center items-center gap-4">
            <select name="dogami_id" class="dogamis-selector" style="width: 280px">
                <option selected disabled>Search a DOGAMI...</option>
            </select>

            @include('components.button', [
                'label' => 'Validate',
            ])
        </div>
    </form>

    @if (empty($results) === false)
        <div class="mt-10 max-w-[768px] mx-auto">
            <div class="text-center font-bold text-lg">
                <p>Results</p>
            </div>
            <div class="splide trainings-results-all mt-6 pb-6">
                <div class="splide__track">
                    <ul class="splide__list sm:!text-center">
                        @foreach (DogamiTreatType::all() as $treatType)
                            <li class="splide__slide">
                                <div class="px-8">
                                    <p class="text-center">{{ $treatType->name }}</p>
                                    <p class="text-center">Total Cost : {{ $totals_costs[$treatType->slug] }}</p>
                                    <p class="text-center">Total Trainings : {{ $totals_trainings[$treatType->slug] }}</p>

                                    <div class="splide trainings-results-{{ $treatType->slug }} mt-6 pb-6">
                                        <div class="splide__track">
                                            <div class="splide__list sm:!text-center sm:!grid sm:!grid-cols-2 sm:!gap-y-6 sm:!justify-items-center">
                                                @foreach(DogamiSkillEnum::all() as $skill)
                                                    @foreach ($results[$skill->value] as $result)
                                                        @if($result->treatType !== $treatType)
                                                            @continue
                                                        @endif

                                                        <div class="splide__slide sm:max-w-80">
                                                            <p class="text-center">{{ $skill->label }}</p>

                                                            <div class="px-8">
                                                                <p>You started with bonus : +{{ $result->starting_bonus }}</p>
                                                                <p>Simulation ended at bonus : +{{ $result->end_bonus }}</p>
                                                                <p>Treats used : {{ $result->treatType->name }}</p>

                                                                @if ($result->starsLeft !== INF)
                                                                    <p>Yours stars left : {{ number_format($result->starsLeft, decimals: 0, thousands_separator: ",") }}</p>
                                                                @endif
                                                                <p>Total trainings : {{ $result->total_trainings }}</p>
                                                                <p>Total cost : {{ number_format($result->total_training_cost, decimals: 0, thousands_separator: ",") }}</p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endforeach
                                            </div>

                                            <ul class="splide__pagination !static"></ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <ul class="splide__pagination !bottom-0"></ul>
            </div>
        </div>
    @endif
@endsection
