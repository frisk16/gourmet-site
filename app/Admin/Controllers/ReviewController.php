<?php

namespace App\Admin\Controllers;

use App\Models\Review;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class ReviewController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Review';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Review());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('store_id', __('Store id'))->sortable();
        $grid->column('name', __('Name'))->sortable();
        $grid->column('score', __('Score'))->sortable();
        $grid->column('comment', __('Comment'));
        $grid->column('created_at', __('Created at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });

        $grid->disableCreateButton();

        $grid->actions(function($actions) {
            $actions->disableView();
        });

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->equal('store_id', 'Store ID')->integer();
            $filter->in('name', __('Name'))->multipleSelect(User::all()->pluck('name', 'name'));
            $filter->in('score', 'スコア')->checkbox(Review::all()->pluck('score', 'score'));
            $filter->like('comment', 'コメント');
            $filter->between('created_at', __('Created at'))->datetime();
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
        $form = new Form(new Review());

        $form->number('store_id', __('Store id'));
        $form->select('name', __('Name'))->options(User::all()->pluck('name', 'name'));
        $form->number('score', __('Score'));
        $form->textarea('comment', __('Comment'));

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
