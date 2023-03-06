<?php

namespace OutMart\Modules\Catalog\Http\Livewire\Products;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;
use OutMart\Dashboard\Builder\Contracts\hasGenerateFields;
use OutMart\Dashboard\Builder\Contracts\hasGenerateTabs;
use OutMart\Dashboard\Builder\FormBuilder;
use OutMart\Models\Product\Category;
use OutMart\Modules\Catalog\Models\Product;

class ProductEdit extends FormBuilder implements hasGenerateFields, hasGenerateTabs
{
    use LivewireAlert;
    use WithFileUploads;

    public $product;

    public $product_type;
    public $name;
    public $slug;
    public $sku;
    public $description;
    public $price;
    public $discount_price;

    protected $pagePretitle = 'Catalog';
    protected $pageTitle = 'Update product';

    public function mount(Product $product)
    {
        $this->product = $product->setStoreViewId($this->storeViewId);

        $this->name = $this->product->name;
        $this->slug = $this->product->slug;
        $this->sku = $this->product->sku;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->discount_price = $this->product->discount_price;
    }

    public function changeStoreViewId()
    {
        $this->product = $this->product->setStoreViewId($this->storeViewId);

        $this->name = $this->product->name;
        $this->slug = $this->product->slug;
        $this->sku = $this->product->sku;
        $this->description = $this->product->description;
        $this->price = $this->product->price;
        $this->discount_price = $this->product->discount_price;
    }

    public function generateTabs($tabs)
    {
        $tabs->addTab([
            'id' => 'basic',
            'name' => 'Basic info',
        ]);

        $tabs->addTab([
            'id' => 'priceing',
            'name' => 'Priceing',
        ]);

        $tabs->addTab([
            'id' => 'images',
            'name' => 'Images',
        ]);
    }

    public function generateFields($form)
    {
        $form->addField('select', [
            'label' => 'Categorys',
            'model' => 'categories',
            'options' => Category::get()->map(function ($category) {
                return [
                    'label' => $category->name,
                    'value' => $category->id,
                ];
            }),
            'rules' => 'nullable',
            'order' => 1,
            'hint' => 'You can not select.',
        ]);

        $form->addField('text', [
            'label' => 'Product name',
            'model' => 'name',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        $form->addField('text', [
            'label' => 'Product slug',
            'model' => 'slug',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        $form->addField('text', [
            'label' => 'Product sku',
            'model' => 'sku',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        $form->addField('text', [
            'label' => 'Product description',
            'model' => 'description',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        // priceing
        $form->addField('price', [
            'tab' => 'priceing',
            'label' => 'Product price',
            'model' => 'price',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        $form->addField('price', [
            'tab' => 'priceing',
            'label' => 'Product discount price',
            'model' => 'discount_price',
            'rules' => 'nullable',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        // images
        $form->addField('file', [
            'tab' => 'images',
            'label' => 'Product thumbnail',
            'model' => 'images_thumbnail',
            'rules' => 'nullable',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($validatedData['slug'], '-');

        $product = $this->product->setStoreViewId($this->storeViewId);
        $product->categories = $validatedData['categories'];
        $product->name = $validatedData['name'];
        $product->slug = $validatedData['slug'];
        $product->sku = $validatedData['sku'];
        $product->description = $validatedData['description'];
        $product->price = $validatedData['price'];
        $product->discount_price = $validatedData['discount_price'];

        if ($this->images_thumbnail) {
            $product->images_thumbnail = $this->images_thumbnail->store('products', 'public');
        }

        $product->save();

        return $this->alert('success', 'Saved!');
    }
}