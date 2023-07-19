@extends('base')

@section('content')

{{--    <x-alert color="green">--}}
{{--        Entité créé !--}}
{{--    </x-alert>--}}
    <section
        class="relative bg-[url(https://images.unsplash.com/photo-1604014237800-1c9102c219da?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80)] bg-cover bg-center bg-no-repeat h-screen"
    >
        <div
            class="absolute inset-0 bg-white/75 sm:bg-transparent sm:from-white/95 sm:to-white/25 sm:bg-gradient-to-r"
        ></div>

        <div
            class="relative mx-auto max-w-screen-xl px-4 py-32 sm:px-6 lg:flex lg:h-screen lg:items-center lg:px-8"
        >
            <div class="max-w-xl text-center sm:text-left rtl:sm:text-right">
                <h1 class="text-3xl font-extrabold sm:text-5xl">
                    Laissez-nous trouver

                    <strong class="block font-extrabold text-teal-700">
                       Votre maison.
                    </strong>
                </h1>

                <p class="mt-4 max-w-lg sm:text-xl/relaxed">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Nesciunt illo
                    tenetur fuga ducimus numquam ea!
                </p>

                <div class="mt-8 flex flex-wrap gap-4 text-center">
                    <a
                        href="#biens"
                        class="block w-full rounded bg-teal-600 px-12 py-3 text-sm font-medium text-white shadow hover:bg-teal-700 focus:outline-none focus:ring active:bg-teal-500 sm:w-auto"
                    >
                        Voir les biens
                    </a>

                    <a
                        href="#"
                        class="block w-full rounded bg-white px-12 py-3 text-sm font-medium text-teal-600 shadow hover:text-teal-700 focus:outline-none focus:ring active:text-teal-500 sm:w-auto"
                    >
                        Learn More
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="biens">
        <div class="max-w-screen-xl px-4 py-8 mx-auto sm:py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3 lg:items-stretch">
                <div class="grid p-6 bg-gray-100 rounded place-content-center sm:p-8">
                    <div class="max-w-md mx-auto text-center lg:text-left">
                        <header>
                            <h2 class="text-xl font-bold text-gray-900 sm:text-3xl">Nos derniers biens</h2>
                        </header>

                        <a
                            href="{{ route('property.index') }}"
                            class="inline-block px-12 py-3 mt-8 text-sm font-medium text-white transition bg-teal-700 border border-indigo-700 rounded hover:shadow focus:outline-none focus:ring"
                        >
                            Tout nos biens
                        </a>
                    </div>
                </div>

                <div class="lg:col-span-2 lg:py-8">
                    <ul class="grid grid-cols-2 gap-4">
                        @foreach($properties as $property)
                            <li>
                               @include('property.card')
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>
        </div>
    </section>


@endsection
