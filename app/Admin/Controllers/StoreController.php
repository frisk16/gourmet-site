<?php

namespace App\Admin\Controllers;

use App\Models\Store;
use App\Models\Category;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class StoreController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Store';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Store());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('category.name', 'カテゴリー');
        $grid->column('name', '店舗名');
        $grid->column('commission', '手数料')->sortable();
        $grid->column('image', '画像')->image();
        $grid->column('address', '住所');
        $grid->column('tel', '電話番号');
        $grid->column('created_at', __('Created at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->in('category_id', 'カテゴリー')->multipleSelect(Category::all()->pluck('name', 'id'));
            $filter->like('name', '店舗名');
            $filter->between('commission', '手数料')->integer();
            $filter->like('address', '住所');
            $filter->like('tel', '電話番号');
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
        $form = new Form(new Store());

        $form->select('category_id', 'カテゴリー')->options(Category::all()->pluck('name', 'id'));
        $form->text('name', __('店舗名'));
        $form->number('commission', '手数料');
        $form->image('image', '店舗画像');
        $form->textarea('description', '詳細');
        $form->text('address', '住所');
        $form->text('tel', '電話番号');

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
