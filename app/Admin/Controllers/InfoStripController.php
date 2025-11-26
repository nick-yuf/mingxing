<?php

namespace App\Admin\Controllers;

use App\Models\InfoPackModel;
use App\Models\InfoStripModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

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
        $grid->column(InfoStripModel::F_arrive_date, __(InfoStripModel::Note[InfoStripModel::F_arrive_date]));
        $grid->column(InfoStripModel::F_close_date, __(InfoStripModel::Note[InfoStripModel::F_close_date]));
        $grid->column(InfoStripModel::F_leave_date, __(InfoStripModel::Note[InfoStripModel::F_leave_date]));
        $grid->column(InfoStripModel::F_box_total, __(InfoStripModel::Note[InfoStripModel::F_box_total]));
        $grid->column(InfoStripModel::F_boxA_total, __(InfoStripModel::Note[InfoStripModel::F_boxA_total]));
        $grid->column(InfoStripModel::F_boxB_total, __(InfoStripModel::Note[InfoStripModel::F_boxB_total]));

        $grid->disableExport();

        $grid->actions(function ($actions) {
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
        $form = new Form(new InfoPackModel());

        $form->text(InfoPackModel::F_contract_id, __(InfoPackModel::Note[InfoPackModel::F_contract_id]))->required();
        $form->text(InfoPackModel::F_transport_no, __(InfoPackModel::Note[InfoPackModel::F_transport_no]))->required();
        $form->text(InfoPackModel::F_box_count, __(InfoPackModel::Note[InfoPackModel::F_box_count]))->required();
        $form->radio(InfoPackModel::F_product_level, __(InfoPackModel::Note[InfoPackModel::F_product_level]))
            ->options($this->setLang(InfoPackModel::LevelArray))->default(InfoPackModel::product_level_1);
        $form->select(InfoPackModel::F_staff_id, __(InfoPackModel::Note[InfoPackModel::F_staff_id]))->options('/api/team/staff')->required();

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
