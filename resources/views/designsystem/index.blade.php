@extends('layout.app')

@section('content')
    @include('components.button', [
        'label' => 'Custom label'
    ])

    @include('components.dogami-skills', [
        "dogami" => App\Models\Dogami::find(11611)
    ])
@endsection
