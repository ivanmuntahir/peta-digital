<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Place;

class Map extends Component
{
        public $places; 

        public function mount()
        {
            $this->places = Place::with(['user', 'category'])->get();
        }

        public function render()
        {
            return view('livewire.map', [
                'places' => $this->places,
            ]);
        }
}
