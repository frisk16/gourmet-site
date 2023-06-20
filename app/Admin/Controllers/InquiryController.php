<?php

namespace App\Admin\Controllers;

use App\Models\Inquiry;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class InquiryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Inquiry';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Inquiry());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('name', '名前');
        $grid->column('email', __('Email'));
        $grid->column('type', __('Type'))->sortable();
        $grid->column('title', __('Title'));
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
            $filter->in('name', '名前')->multipleSelect(Inquiry::all()->pluck('name', 'name'));
            $filter->in('email', __('Email'))->multipleSelect(Inquiry::all()->pluck('email', 'email'));
            $filter->equal('type', __('Type'))->radio(Inquiry::all()->pluck('type', 'type'));
            $filter->like('title', __('Title'));
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
        $form = new Form(new Inquiry());

        $form->text('name', '名前');
        $form->email('email', __('Email'));
        $form->text('type', __('Type'));
        $form->text('title', __('Title'));
        $form->textarea('content', __('Content'));

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
