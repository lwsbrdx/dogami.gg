<div class="grid grid-cols-2 sm:grid-cols-3 gap-y-4 justify-items-center">
    @foreach (\App\Classes\Dogami\Attribute\DogamiSkill::SKILLS as $skill)
        <a class="flex flex-col justify-center text-center bg-[#2d123b] rounded-md w-full max-w-32 sm:max-w-40 h-11 px-2 py-1" href="{{ route('leaderboard', ['skill_type' => $skill]) }}">
            <p class="m-0 p-0">{{ ucfirst($skill) }}</p>
        </a>
    @endforeach
</div>
