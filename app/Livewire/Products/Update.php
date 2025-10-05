<?php

namespace App\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use App\Livewire\Forms\ProductForm;

class Update extends Component
{
    public ProductForm $form;

    public function mount(Product $product)
    {
        // Creamos un nuevo producto para acceder a las propiedades del producto
        $this->form->setProduct($product);
    }

    public function save()
    {
        $this->form->update();
        session()->flash('success', 'Product updated successfully');
        $this->redirectRoute('products.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.products.create');
    }
}
