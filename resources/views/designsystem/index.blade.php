@extends('layout.app')

@section('content')
    @livewire('dogami-skills', [
        "dogami" => App\Models\Dogami::find(11611)
    ])
@endsection
