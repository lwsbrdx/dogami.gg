@extends('layout.app')

@section('content')
    @livewire('dogami-details', [
        'dogami' => $dogami ?? null,
        'use_max_values' => $use_max_values,
    ])
@endsection
