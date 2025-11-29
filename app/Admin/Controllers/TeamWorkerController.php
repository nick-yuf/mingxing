<?php

namespace App\Admin\Controllers;

use App\Models\TeamWorkerModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Alert;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\InfoBox;
use Encore\Admin\Widgets\Tab;
use Encore\Admin\Widgets\Table;

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
        $grid->column('1', __(TeamWorkerModel::Note[TeamWorkerModel::F_remark]))->modal(__(TeamWorkerModel::Note[TeamWorkerModel::F_remark]), function ($model) {
           return new Box('',$model[TeamWorkerModel::F_remark]);
        })->width(100);
        $grid->column(TeamWorkerModel::F_status, __(TeamWorkerModel::Note[TeamWorkerModel::F_status]))
            ->editable('select', TeamWorkerModel::rtnEnumLang(TeamWorkerModel::StatusArray))->width(100);
        $grid->column(TeamWorkerModel::F_type, __(TeamWorkerModel::Note[TeamWorkerModel::F_type]))
            ->editable('select', TeamWorkerModel::rtnEnumLang(TeamWorkerModel::TypeArray))->width(100);

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
        $form->textarea(TeamWorkerModel::F_remark, __(TeamWorkerModel::Note[TeamWorkerModel::F_remark]));
        $form->radio(TeamWorkerModel::F_status, __(TeamWorkerModel::Note[TeamWorkerModel::F_status]))
            ->options($this->setLang(TeamWorkerModel::StatusArray))->default(TeamWorkerModel::status_1);
        $form->radio(TeamWorkerModel::F_type, __(TeamWorkerModel::Note[TeamWorkerModel::F_type]))
            ->options($this->setLang(TeamWorkerModel::TypeArray))->default(TeamWorkerModel::type_1);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
