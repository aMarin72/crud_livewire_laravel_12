<?php

namespace App\Livewire\Forms;

use Livewire\Form;
use App\Models\Product;
use Livewire\Attributes\Validate;

class ProductForm extends Form
{
    // Propiedad para el componente update
    public ?Product $product;

    // Extraemos las propiedades del componente create
    #[Validate('required|string|max:255', as: 'product name')]
    public $name;

    #[Validate('nullable|string')]
    public $description;

    #[Validate('required|integer|min:0')]
    public $stock = 0;

    #[Validate('required|numeric|min:0')]
    public $price;

    public function setProduct(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->description = $product->description;
        $this->stock = $product->stock;
        $this->price = $product->price;
    }

    public function store()
    {
        $this->validate();
        Product::create([
            'name' => $this->name,
            'description' => $this->description,
            'stock' => $this->stock,
            'price' => $this->price,
        ]);
        $this->resetForm();
    }

    public function update()
    {
        $this->validate();
        $this->product->update($this->all());
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->name = '';
        $this->description = '';
        $this->stock = 0;
        $this->price = '0.00';
    }
}
