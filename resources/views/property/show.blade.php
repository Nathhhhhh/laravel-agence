@extends('base');

@section('title', $property->title);

@section('content')
    @php
        $nbf = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
    @endphp
    <section>
        <div class="relative mx-auto max-w-screen-xl px-4 py-8 mt-16">
            <div class="grid grid-cols-1 items-start gap-8 md:grid-cols-2">
                <div class="grid grid-cols-2 gap-4 md:grid-cols-1">
                    <img
                        alt="Les Paul"
                        src="https://images.unsplash.com/photo-1456948927036-ad533e53865c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
                        class="aspect-square w-full rounded-xl object-cover"
                    />

                </div>

                <div class="sticky top-0">
                    <strong
                        class="rounded-full border bg-gray-100 px-3 py-0.5 text-xs font-medium tracking-wide
                        @if($property->sold)
                            text-red-600
                            border-red-600
                        @else
                            border-green-600
                            text-green-600
                        @endif"
                    >
                        @if($property->sold)
                            Vendu
                        @else
                            Disponible
                        @endif
                    </strong>
                    <div class="mt-8 flex justify-between">
                        <div class="max-w-[35ch] space-y-2">
                            <h1 class="text-xl font-bold sm:text-2xl">
                                {{ $property->title }}
                            </h1>
                            <h2 class="text-lg font-medium sm:text-xl">
                                {{ $property->rooms }} Pièces - {{ $property->surface }} m2
                            </h2>

                        </div>

                        <p class="text-lg font-bold">{{ $nbf->formatCurrency($property->price, 'EUR') }}</p>
                    </div>

                    <div class="mt-4 mb-5">
                        <div class="prose max-w-none">
                            <p>
                                {{ $property->description }}
                            </p>
                        </div>

                    </div>

                    <div class="mb-5">
                        <h3 class="text-lg font-medium sm:text-xl text-teal-800 mb-3">À savoir sur ce bien</h3>

                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                            <table class="w-full text-sm text-left text-teal-100">
                                <thead class="text-xs text-white uppercase bg-teal-600">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Chambres
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Étage
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Ville
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Adresse
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="bg-teal-500 border-b border-teal-400">
                                    <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                        {{ $property->bedrooms }}
                                    </th>
                                    <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                        {{ $property->floor }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                        {{ $property->city }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-white whitespace-nowrap">
                                        {{ $property->address }} - {{ $property->postal_code }}
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                        </div>

                    </div>
                    @if($property->options->count() > 0)
                        <div class="mt-8 mb-5">
                            <fieldset>
                                <legend class="text-sm font-medium mb-2">Options</legend>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($property->options as $option)
                                        <span class="group inline-block rounded-full border px-3 py-1 text-xs font-medium text-indigo-700"> {{ $option->name }} </span>
                                    @endforeach
                                </div>
                            </fieldset>
                        </div>
                    @endif
                    <div>
                        <h3 class="text-lg mb-5 font-bold">Intéressé par ce bien ?</h3>
                        <form method="POST" action="{{ route('property.mail', ['property' => $property]) }}">
                            @csrf
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="name" id="name" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="name" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Prénom</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="text" name="lastname" id="lastname" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="lastname" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Nom</label>
                            </div>
                            <div class="relative z-0 w-full mb-6 group">
                                <input type="email" name="email" id="email" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" " required />
                                <label for="email" class="peer-focus:font-medium absolute text-sm text-gray-500 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">Email</label>
                            </div>
                            <button
                                class="block rounded-md bg-teal-600 px-5 py-2.5 text-sm font-medium text-white transition hover:bg-teal-700"
                            >
                                Envoyer votre demande
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
