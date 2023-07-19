@php
    $nbf = new NumberFormatter('fr_FR', NumberFormatter::CURRENCY);
@endphp
<a href="{{
    route('property.show',
    [
    'slug' => $property->slug(),
    'property' => $property
     ]
     )
}}" class="block rounded-lg p-4 shadow-lg shadow-indigo-100 hover:-translate-y-2 ease-in duration-150 relative overflow-hidden">
    @if($property->sold)
        <div class="flex items-center justify-center bg-teal-500 text-white w-32 h-8 absolute top-0 right-0 rotate-45 translate-x-1/4 translate-y-3">
            <span class="text-sm">Vendu !</span>
        </div>
    @endif
    <img
        alt="Home"
        src="https://images.unsplash.com/photo-1613545325278-f24b0cae1224?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1770&q=80"
        class="h-56 w-full rounded-md object-cover"
    />

    <div class="mt-2">
        <dl>
            <div>
                <dt class="sr-only">Prix</dt>

                <dd class="text-sm text-indigo-500 font-bold">{{ $nbf->formatCurrency($property->price, 'EUR') }}</dd>
            </div>

            <div class="mb-2">
                <dt class="sr-only">Titre</dt>

                <dd class="font-medium">{{ $property->title }} - {{ $property->city }}</dd>
            </div>
            <div>
                <div class="text-md">{{ $property->surface }}m2 - {{ $property->rooms }} Pièces</div>
            </div>
        </dl>
        @if($property->options->count() > 0)
            <div class="mt-6">
                <h3>Options</h3>
                <div class=" mt-2 flex items-center gap-8 text-xs">
                    <div class="sm:inline-flex sm:shrink-0 sm:items-center sm:gap-2">
                        @foreach($property->options as $option)
                            <div class="mt-1.5 sm:mt-0 color text-indigo-700">
                                <p class="text-md text-black-500">{{ $option->name }}</p>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        @endif
    </div>
</a>

