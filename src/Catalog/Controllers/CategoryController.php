<?php

namespace AvoRed\Framework\Catalog\Controllers;

use AvoRed\Framework\Support\Facades\Tab;
use AvoRed\Framework\Database\Models\Category;
use AvoRed\Framework\Catalog\Requests\CategoryRequest;
use AvoRed\Framework\Database\Contracts\CategoryModelInterface;
use Illuminate\Http\Request;

class CategoryController
{
    /**
     * Category Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\CategoryRepository
     */
    protected $categoryRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\CategoryModelInterface $categoryRepository
     */
    public function __construct(
        CategoryModelInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Show Category Index Page.
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $perPage = 10;
        $with = ['parent'];
        if ($request->get('filter')) {
            $categories = $this->categoryRepository->filter($request->get('filter'));
        } else {
            $categories = $this->categoryRepository->paginate($perPage, $with);
        }

        return view('avored::catalog.category.index')
            ->with(compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $categoryOptions = $this->categoryRepository->options();
        $tabs = Tab::get('catalog.category');

        return view('avored::catalog.category.create')
            ->with(compact('tabs', 'categoryOptions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        $this->categoryRepository->create($request->all());

        return redirect()->route('admin.category.index')
            ->with('successNotification', __(
                'avored::system.created_notification',
                ['attribute' => __('avored::system.category')]
            ));
    }

    /**
     * Show the form for editing the specified resource.
     * @param \AvoRed\Framework\Database\Models\Category $category
     * @return \Illuminate\View\View
     */
    public function edit(Category $category)
    {
        $categoryOptions = $this->categoryRepository
            ->options()
            ->filter(function ($option) use ($category) {
                return $option !== $category->name;
            });
        $tabs = Tab::get('catalog.category');

        return view('avored::catalog.category.edit')
            ->with(compact('category', 'tabs', 'categoryOptions'));
    }

    /**
     * Update the specified resource in storage.
     * @param \AvoRed\Framework\Catalog\Requests\CategoryRequest $request
     * @param \AvoRed\Framework\Database\Models\Category  $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect()->route('admin.category.index')
            ->with('successNotification', __(
                'avored::system.updated_notification',
                ['attribute' => __('avored::system.category')]
            ));
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(int $id)
    {
        Category::destroy($id);

        return redirect()
            ->route('admin.category.index')
            ->with([
                'successNotification' => __(
                    'avored::system.deleted_notification',
                    ['attribute' => __('avored::system.category')]
                ),
            ]);
    }
}
