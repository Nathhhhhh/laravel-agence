<?php

namespace App\Http\Controllers;

use App\Events\ContactRequestEvent;
use App\Http\Requests\PropertyBookingMailRequest;
use App\Http\Requests\SearchPropertiesRequest;
use App\Mail\BookingProperty;
use App\Models\Property;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Mail;

class PropertyController extends Controller
{
    public function index(SearchPropertiesRequest $request)
    {
        $properties = Property::query()->orderByDesc('updated_at')->paginate(16);
        return view('property.index', [
            'properties' => $properties
        ]);
    }

    public function show(string $slug, Property $property)
    {
        if($slug !== $property->slug()) {
            return to_route('property.show', ['slug' => $property->slug(), 'property' => $property]);
        }
        return view('property.show', [
            'property' => $property
        ]);
    }

    public function sendMail(Property $property, PropertyBookingMailRequest $request, Dispatcher $dispatcher) {

        $dispatcher->dispatch(new ContactRequestEvent($property, $request->validated()));

//        Mail::cc($request->input('email'))->send(new BookingProperty($property, $request->validated()));
        return back()->with('success', 'Demande envoyée');
    }
}
