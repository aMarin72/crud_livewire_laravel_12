<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    // public $products;

    // Cuando se carga el componente se ejecuta el método mount
    public function mount()
    {
        // $this->products = Product::take(10)->get();
        // $this->products = []; // simulo que no hay productos
        // $this->products = Product::all();
        // $this->products = Product::paginate(10);
    }

    // Para la paginacion los elementos deben de estar en el metodo render, no usamos el método mount
    public function render()
    {
        return view('livewire.products.index', [
            // 'products' => Product::all(),
            // 'products' => Product::simplePaginate(10),
            'products' => Product::paginate(10),
        ]);
    }
}
