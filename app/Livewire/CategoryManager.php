<?php

namespace App\Livewire;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class CategoryManager extends Component
{
    use WithPagination;

    public $name = '';
    public $display_name = '';
    public $description = '';
    public $editing = false;
    public $creating = false;
    public $categoryId = null;
    public $search = '';

    protected $rules = [
        'name' => 'required|min:3|unique:categories,name',
        'display_name' => 'nullable|min:3',
        'description' => 'nullable|min:3',
    ];

    public function render()
    {
        $categories = Category::search($this->search)->paginate(10);

        return view('livewire.category-manager', [
            'categories' => $categories,
        ]);
    }

    public function create()
    {
        $this->authorize('create', Category::class);
        $this->resetValidation();
        $this->reset(['name', 'display_name', 'description', 'editing', 'categoryId']);
        $this->creating = true;
    }

    public function edit(Category $category)
    {
        $this->authorize('update', $category);
        $this->editing = true;
        $this->creating = false;
        $this->categoryId = $category->id;
        $this->name = $category->name;
        $this->display_name = $category->display_name;
        $this->description = $category->description;
    }

    public function update()
    {
        $this->authorize('update', Category::class);

        $request = new UpdateCategoryRequest();
        $request->setContainer(app())
            ->setRouteResolver(function () {
                return ['category' => $this->categoryId];
            });

        $request->merge([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->validate($request->rules(), $request->messages());

        $category = Category::find($this->categoryId);
        $category->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'display_name', 'description', 'editing', 'categoryId', 'creating']);
        session()->flash('message', __('Category updated successfully.'));
    }

    public function store()
    {
        $this->authorize('create', Category::class);

        $request = new StoreCategoryRequest();
        $request->merge([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        $this->validate($request->rules(), $request->messages());

        Category::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        $this->reset(['name', 'display_name', 'description', 'creating']);
        session()->flash('message', __('Category created successfully.'));
    }

    public function delete($id)
    {
        $category = Category::findOrFail($id);

        try {
            $this->authorize('delete', $category);

            try {
                $category->forceDelete();
                session()->flash('message', __('Category deleted successfully.'));
            } catch (\Illuminate\Database\QueryException $e) {
                // Check if the error is due to foreign key constraint
                if ($e->getCode() == 23000) {
                    session()->flash('error', __('The category cannot be deleted because it is being used by one or more products. Please remove the category from all products or delete the products first.'));
                } else {
                    session()->flash('error', __('An error occurred while deleting the category.'));
                }
            }
        } catch (\Illuminate\Auth\Access\AuthorizationException $e) {
            session()->flash('error', __('The category cannot be deleted because it is being used by one or more products. Please remove the category from all products or delete the products first.'));
        }
    }

    public function cancel()
    {
        $this->reset(['name', 'display_name', 'description', 'editing', 'categoryId', 'creating']);
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
