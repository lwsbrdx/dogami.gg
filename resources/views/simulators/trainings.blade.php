@extends('layout.app')

@section('content')
    <form action="{{ route('simulators.training.skills') }}" method="post">
        @csrf

        <input type="hidden" name="simulate" value="true">

        <div class="px-4 flex flex-col gap-y-2">
            <label for="starting_bonus">
                Start at :
                <input
                    id="starting_bonus"
                    type="number"
                    name="starting_bonus"
                    value="0"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::MAX_BONUSES }}"
                    step="1"
                />
            </label>

            <label for="starting_bonus_xp">
                With XP points :
                <input
                    id="starting_bonus_xp"
                    type="number"
                    name="starting_bonus_xp"
                    value="0"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::BONUS_LEVEL_CEILING }}"
                    step="1"
                />
            </label>

            <label for="end_bonus">
                End at :
                <input
                    id="end_bonus"
                    type="number"
                    name="end_bonus"
                    value="0"
                    min="0"
                    max="{{ App\Classes\Dogami\Training\DogamiTraining::MAX_BONUSES }}"
                    step="1"
                />
            </label>

            <label for="treat_type">
                Treats to use :
                <select name="treat_type" id="treat_type">
                    @foreach (App\Classes\Dogami\ObjectEnums\DogamiTreatType::all() as $treats_type)
                        <option value="{{ $treats_type->slug }}">{{ $treats_type->name }}</option>
                    @endforeach
                </select>
            </label>

            <label for="unlimited_stars">
                Unlimited Stars :
                <input type="checkbox" name="unlimited_stars" id="unlimited_stars">
            </label>
            <label for="stars_bag">
                How much do you want to use :
                <input
                    id="stars_bag"
                    type="number"
                    name="stars_bag"
                    value="0"
                    min="0"
                    step="1"
                />
            </label>

            <button class="mx-auto bg-[#2d123b] rounded-md w-full max-w-32 sm:max-w-40 h-11 px-2 py-1">
                Simulate
            </button>
        </div>
    </form>

    @if ($results !== null)
        <p>
            {{ $results->total_training_cost }}
        </p>
    @endif
@endsection
