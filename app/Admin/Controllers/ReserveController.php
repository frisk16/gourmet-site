<?php

namespace App\Admin\Controllers;

use App\Models\Reserve;
use App\Models\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Carbon\Carbon;

class ReserveController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Reserve';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reserve());

        $grid->column('id', __('Id'))->sortable();
        $grid->column('user.name', __('Name'))->sortable();
        $grid->column('age', __('Age'))->sortable();
        $grid->column('job', __('Job'))->sortable();
        $grid->column('date', '来店日')->sortable();
        $grid->column('time', '来店時刻')->sortable();
        $grid->column('name', '店舗名');
        $grid->column('total_commission', __('Total commission'))->sortable()->totalRow(function($total) {
            return "<strong class='text-primary'>{$total}</strong>";
        });
        $grid->column('people', __('People'))->sortable();
        $grid->column('cancel_flag', __('Cancel flag'));
        $grid->column('created_at', __('Created at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });
        $grid->column('updated_at', __('Updated at'))->sortable()->display(function($date) {
            return Carbon::parse($date)->format('Y/m/d H:i:s');
        });

        $grid->disableCreateButton();

        $grid->filter(function($filter) {
            $filter->disableIdFilter();
            $filter->in('user_id', __('Name'))->multipleSelect(User::all()->pluck('name', 'id'));
            $filter->like('name', '店舗名');
            $filter->between('people', __('People'))->integer();
            $filter->between('age', __('Age'))->integer();
            $filter->in('job', __('Job'))->multipleSelect(User::all()->pluck('job', 'job'));
            $filter->equal('cancel_flag', __('Cancel flag'))->radio([0 => '予約完了', 1 => 'キャンセル']);
            $filter->between('created_at', __('Created at'))->datetime();
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
        $form = new Form(new Reserve());

        $form->date('date', '来店日')->format('YYYY/MM/DD');
        $form->time('time', '来店時刻')->format('H:mm');
        $form->text('name', '店舗名');
        $form->number('total_commission', __('Total commission'));
        $form->number('people', __('People'));
        $form->switch('cancel_flag', __('Cancel flag'));

        $form->tools(function(Form\Tools $tools) {
            $tools->disableView();
        });

        return $form;
    }
}
