<?php

namespace App\Admin\Controllers;

use App\Models\WareToolsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class WareToolsController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(WareToolsModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new WareToolsModel());
        $grid->column(WareToolsModel::F_id, __('ID'))->sortable();
        $grid->column(WareToolsModel::F_tools_name, __(WareToolsModel::Note[WareToolsModel::F_tools_name]));
        $grid->column(WareToolsModel::F_tools_param, __(WareToolsModel::Note[WareToolsModel::F_tools_param]));
        $grid->column(WareToolsModel::F_tools_total, __(WareToolsModel::Note[WareToolsModel::F_tools_total]));
        $grid->column(WareToolsModel::F_remark, __(WareToolsModel::Note[WareToolsModel::F_remark]));

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
        $form = new Form(new WareToolsModel());

        $form->text(WareToolsModel::F_tools_name, __(WareToolsModel::Note[WareToolsModel::F_tools_name]))->required();
        $form->text(WareToolsModel::F_tools_param, __(WareToolsModel::Note[WareToolsModel::F_tools_param]))->required();
        $form->text(WareToolsModel::F_tools_total, __(WareToolsModel::Note[WareToolsModel::F_tools_total]))->default(0);
        $form->textarea(WareToolsModel::F_remark, __(WareToolsModel::Note[WareToolsModel::F_remark]));

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
