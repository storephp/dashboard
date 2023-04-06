<?php

namespace Basketin\Modules\Catalog\Http\Livewire\Categories;

use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Basketin\Dashboard\Builder\Contracts\hasGenerateFields;
use Basketin\Dashboard\Builder\FormBuilder;
use Basketin\Models\Product\Category;

class CategoryEdit extends FormBuilder implements hasGenerateFields
{
    use LivewireAlert;

    protected $pagePretitle = 'Catalog';
    protected $pageTitle = 'Update this category';
    protected $submitLabel = 'Update';

    public $category;

    public $parent_id;
    public $name;
    public $slug;

    protected $rules = [
        'parent_id' => 'nullable',
        'name' => 'required',
        'slug' => 'required',
    ];

    public function mount(Category $category)
    {
        $this->category = $category->setStoreViewId($this->storeViewId);

        $this->parent_id = $this->category->parent_id;
        $this->name = $this->category->name;
        $this->slug = $this->category->slug;
    }

    public function changeStoreViewId()
    {
        $this->category = $this->category->setStoreViewId($this->storeViewId);

        $this->name = $this->category->name;
    }

    public function generateFields($form)
    {
        $form->addField('select', [
            // 'tab' => 'basic.id',
            'label' => 'Parent category',
            'model' => 'parent_id',
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
            // 'tab' => 'basic.id',
            'label' => 'Name category',
            'model' => 'name',
            'rules' => 'required',
            'order' => 10,
            'hint' => 'dsf dsf dsff',
        ]);

        $form->addField('text', [
            // 'tab' => 'basic.id',
            'label' => 'Slug category',
            'model' => 'slug',
            'rules' => 'required',
            'order' => 20,
        ]);

        // AddFieldsToCategoryCreate::dispatch($this->form);
    }

    public function buildSlug()
    {
        $this->slug = Str::slug($this->name, '-');
    }

    public function submit()
    {
        $validatedData = $this->validate();

        $validatedData['slug'] = Str::slug($validatedData['slug'], '-');

        if ($validatedData['parent_id'] == 'remove') {
            $validatedData['parent_id'] = null;
        }

        $this->category->update($validatedData);

        return $this->alert('success', 'Updated!');
    }
}
