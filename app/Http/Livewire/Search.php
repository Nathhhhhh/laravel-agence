<?php

namespace App\Http\Livewire;

use App\Http\Requests\SearchPropertiesRequest;
use App\Models\Property;
use Illuminate\Support\Collection;
use Livewire\Component;

class Search extends Component
{
    public $searchPrice;
    public $searchSurface;
    public $searchRooms;
    public $searchTitle;

    public function render(SearchPropertiesRequest $request)
    {
        $query = Property::query()->with('options');

        if($this->searchPrice && is_numeric($this->searchPrice)) {
            $query = $query->where('price', '<=', $this->searchPrice);
        }

        if($this->searchSurface && is_numeric($this->searchSurface)) {
            $query = $query->where('surface', '>=', $this->searchSurface);
        }

        if($this->searchRooms && is_numeric($this->searchRooms)) {
            $query = $query->where('rooms', '>=', $this->searchRooms);
        }

        if($this->searchTitle && is_string($this->searchTitle)) {
            $query = $query->where('title', 'ILIKE', '%'.$this->searchTitle.'%');
        }

        $properties = $query->paginate(16);

        return view('livewire.search', [
            'properties' => $properties
        ]);
    }
}
