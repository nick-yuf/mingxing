<?php

namespace App\Admin\Controllers;

use App\Models\TeamWorkerModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class TeamWorkerController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(TeamWorkerModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new TeamWorkerModel());
        $grid->column(TeamWorkerModel::F_id, __('ID'))->sortable();
        $grid->column(TeamWorkerModel::F_worker_no, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_no]));
        $grid->column(TeamWorkerModel::F_worker_cost, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_cost]));
        $grid->column(TeamWorkerModel::F_worker_deposit, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_deposit]));
        $grid->column(TeamWorkerModel::F_remark, __(TeamWorkerModel::Note[TeamWorkerModel::F_remark]));
        $grid->column(TeamWorkerModel::F_status, __(TeamWorkerModel::Note[TeamWorkerModel::F_status]))
            ->editable('select', TeamWorkerModel::rtnEnumLang(TeamWorkerModel::StatusArray))->width(100);

        $grid->disableExport();
        $grid->actions(function ($actions) {
            $actions->disableView();
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
        $form = new Form(new TeamWorkerModel());

        $form->text(TeamWorkerModel::F_worker_no, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_no]))->required();
        $form->text(TeamWorkerModel::F_worker_name, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_name]));
        $form->text(TeamWorkerModel::F_worker_contact, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_contact]));
        $form->text(TeamWorkerModel::F_worker_cost, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_cost]))->required()->default(0);
        $form->text(TeamWorkerModel::F_worker_deposit, __(TeamWorkerModel::Note[TeamWorkerModel::F_worker_deposit]))->required()->default(0);
        $form->textarea(TeamWorkerModel::F_remark, __(TeamWorkerModel::Note[TeamWorkerModel::F_remark]));
        $form->radio(TeamWorkerModel::F_status, __(TeamWorkerModel::Note[TeamWorkerModel::F_status]))
            ->options($this->setLang(TeamWorkerModel::StatusArray))->default(TeamWorkerModel::status_1);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
