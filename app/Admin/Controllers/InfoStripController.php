<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Info\Load;
use App\Admin\Actions\Info\Pack;
use App\Models\InfoStripModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;

class InfoStripController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(InfoStripModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new InfoStripModel());
        $grid->column(InfoStripModel::F_id, __('ID'))->sortable();
        $grid->column(InfoStripModel::F_strip_no, __(InfoStripModel::Note[InfoStripModel::F_strip_no]));
        $grid->column('11', '柜号信息')->modal('柜号信息成本：100000', function ($model) {
            return new Table(['#' . __('Param') . '#', '#' . __('Value') . '#'], [
                [__(InfoStripModel::Note[InfoStripModel::F_arrive_date]), $model[InfoStripModel::F_arrive_date]],
                [__(InfoStripModel::Note[InfoStripModel::F_close_date]), $model[InfoStripModel::F_close_date]],
                [__(InfoStripModel::Note[InfoStripModel::F_leave_date]), $model[InfoStripModel::F_leave_date]],
                [__(InfoStripModel::Note[InfoStripModel::F_box_total]), $model[InfoStripModel::F_box_total]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_a]), $model[InfoStripModel::F_in_a]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_b]), $model[InfoStripModel::F_in_b]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_4]), $model[InfoStripModel::F_in_4]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_5]), $model[InfoStripModel::F_in_5]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_6]), $model[InfoStripModel::F_in_6]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_7]), $model[InfoStripModel::F_in_7]],
                [__(InfoStripModel::Note[InfoStripModel::F_in_8]), $model[InfoStripModel::F_in_8]],
                [__(InfoStripModel::Note[InfoStripModel::F_remark]), $model[InfoStripModel::F_remark]],
            ], ['table', 'table-bordered', 'table-condensed', 'table-striped']);
        });

        $grid->column(InfoStripModel::F_status, __(InfoStripModel::Note[InfoStripModel::F_status]))
            ->editable('select', InfoStripModel::rtnEnumLang(InfoStripModel::StatusArray));
        $grid->column('staff.staff_name', __(InfoStripModel::Note[InfoStripModel::F_staff_id]));

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->add(new Load());
            $actions->disableView();
            $actions->disableDelete();
        });

        return $grid;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new InfoStripModel());

        $form->text(InfoStripModel::F_strip_no, __(InfoStripModel::Note[InfoStripModel::F_strip_no]))->required();
        $form->date(InfoStripModel::F_arrive_date, __(InfoStripModel::Note[InfoStripModel::F_arrive_date]));
        $form->date(InfoStripModel::F_leave_date, __(InfoStripModel::Note[InfoStripModel::F_leave_date]));
        $form->date(InfoStripModel::F_close_date, __(InfoStripModel::Note[InfoStripModel::F_close_date]));
        $form->radio(InfoStripModel::F_status, __(InfoStripModel::Note[InfoStripModel::F_status]))
            ->options($this->setLang(InfoStripModel::StatusArray))->default(InfoStripModel::status_1);
        $form->textarea(InfoStripModel::F_remark, __(InfoStripModel::Note[InfoStripModel::F_remark]));
        $form->select(InfoStripModel::F_staff_id, __(InfoStripModel::Note[InfoStripModel::F_staff_id]))->options('/api/team/staff')->required();

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
