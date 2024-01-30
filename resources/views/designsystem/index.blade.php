@extends('layout.app')

@section('content')
    @include('components.button', [
        'label' => 'Custom label'
    ])

    @include('components.button', [
        'label' => 'Custom disabled label',
        'disabled' => true
    ])

    @include('components.dogami-skills', [
        "dogami" => App\Models\Dogami::find(11611)
    ])
@endsection
