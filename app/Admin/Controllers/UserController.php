<?php

namespace App\Admin\Controllers;

use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class UserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'User';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('paid_flag', __('Paid flag'));
        $grid->column('delete_flag', __('Delete flag'));
        $grid->column('delete_date', __('Delete date'));
        $grid->column('name', 'ユーザー名');
        $grid->column('email', 'Eメールアドレス');
        $grid->column('phone', '電話番号');
        $grid->column('area', '地域');
        $grid->column('age', __('Age'));
        $grid->column('job', __('Job'));
        $grid->column('created_at', __('Created at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });

        $grid->disableCreatebutton();

        $grid->actions(function($actions) {
            $actions->disableView();
            $actions->disableDelete();
        });

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->like('name', __('Name'));
            $filter->like('email', __('Email'));
            $filter->like('phone', __('Phone'));
            $filter->like('area', __('Area'));
            $filter->between('created_at', '登録日時')->datetime();
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
        $form = new Form(new User());

        $form->switch('paid_flag', __('Paid flag'));
        $form->switch('delete_flag', __('Delete flag'));
        $form->text('name', __('Name'));
        $form->email('email', __('Email'));
        $form->password('password', __('Password'));
        $form->text('phone', __('Phone'));
        $form->text('area', __('Area'));
        $form->number('age', __('Age'));
        $form->text('job', __('Job'));

        $form->saving(function(Form $form) {
            if($form->password && $form->model()->password != $form->password) {
                $form->password = bcrypt($form->password);
            } else {
                $form->password = $form->model()->password;
            }
        });

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
            $tools->disableDelete();
        });

        return $form;
    }
}
