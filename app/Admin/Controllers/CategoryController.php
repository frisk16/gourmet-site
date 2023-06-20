<?php

namespace App\Admin\Controllers;

use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Category';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Category());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', 'カテゴリー名');
        $grid->column('created_at', __('Created at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });

        $grid->filter(function($filter) {
            $filter->like('name', 'カテゴリー名');
            $filter->between('created_at', '登録日時')->datetime();
        });

        $grid->actions(function($actions) {
            $actions->disableView();
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Category());

        $form->text('name', 'カテゴリー名');

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
