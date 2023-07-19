@extends('base');

@section('title', 'Tout nos biens')

@section('content')
    <div class="container mx-auto mt-16">

            @livewire('search')

        <div class="mt-10 mx-auto">
            {{ $properties->links() }}
        </div>
    </div>
@endsection
