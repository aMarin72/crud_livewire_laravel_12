<?php

namespace App\Livewire\Products;

use Livewire\Component;
use App\Livewire\Forms\ProductForm;

class Create extends Component
{
    public ProductForm $form;

    public function save()
    {
        $this->form->store();
        session()->flash('success', 'Product created successfully');
        $this->redirectRoute('products.index', navigate: true);
    }

    public function render()
    {
        return view('livewire.products.create');
    }
}
