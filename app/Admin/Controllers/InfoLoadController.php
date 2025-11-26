<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\InfoLoadModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class InfoLoadController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(InfoLoadModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new InfoLoadModel());
        $grid->column(InfoLoadModel::F_id, __('ID'))->sortable();
        $grid->column(InfoLoadModel::F_pack_id, __(InfoLoadModel::Note[InfoLoadModel::F_pack_id]));
        $grid->column(InfoLoadModel::F_container_id, __(InfoLoadModel::Note[InfoLoadModel::F_container_id]));
        $grid->column(InfoLoadModel::F_count, __(InfoLoadModel::Note[InfoLoadModel::F_count]));
        $grid->column(InfoLoadModel::F_action, __(InfoLoadModel::Note[InfoLoadModel::F_action]));

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            $actions->add(new CarCase());
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
        $form = new Form(new InfoLoadModel());

        $form->text(InfoLoadModel::F_pack_id, __(InfoLoadModel::Note[InfoLoadModel::F_pack_id]))->required();
        $form->text(InfoLoadModel::F_container_id, __(InfoLoadModel::Note[InfoLoadModel::F_container_id]))->required();
        $form->text(InfoLoadModel::F_count, __(InfoLoadModel::Note[InfoLoadModel::F_count]))->required();
        $form->select(InfoLoadModel::F_action, __(InfoLoadModel::Note[InfoLoadModel::F_action]))
            ->options($this->setLang(InfoLoadModel::ActionArray))->default(InfoLoadModel::action_1);

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
