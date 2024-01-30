@extends('layout.app')

@section('content')
    @livewire('dogami-details', [
        'dogami' => $dogami ?? null
    ])
@endsection
