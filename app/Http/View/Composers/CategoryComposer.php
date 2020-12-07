<?php

namespace App\Http\View\Composers;

use App\Category;
use Illuminate\View\View;

class CategoryComposer
{
    protected $category;

    /**
     * @param Category $category
     * @return void
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @param View $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->category->getCachedCategories());
    }
}
