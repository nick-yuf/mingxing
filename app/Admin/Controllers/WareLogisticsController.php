<?php

namespace App\Admin\Controllers;

use App\Models\WareLogisticsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class WareLogisticsController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(WareLogisticsModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new WareLogisticsModel());
        $grid->column(WareLogisticsModel::F_id, __('ID'))->sortable();
        $grid->column('goods.goods_name', __(WareLogisticsModel::Note[WareLogisticsModel::F_goods_id]));
        $grid->column(WareLogisticsModel::F_count, __(WareLogisticsModel::Note[WareLogisticsModel::F_count]));
        $grid->column(WareLogisticsModel::F_action, __(WareLogisticsModel::Note[WareLogisticsModel::F_action]))
            ->editable('select', WareLogisticsModel::rtnEnumLang(WareLogisticsModel::ActionArray))->width(100);
        $grid->column(WareLogisticsModel::F_is_save, __(WareLogisticsModel::Note[WareLogisticsModel::F_is_save]))
            ->editable('select', WareLogisticsModel::rtnEnumLang(WareLogisticsModel::IsSaveArray))->width(100);
        $grid->column('worker.worker_no', __(WareLogisticsModel::Note[WareLogisticsModel::F_worker_id]));
        $grid->column('staff.staff_name', __(WareLogisticsModel::Note[WareLogisticsModel::F_staff_id]));

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
        $form = new Form(new WareLogisticsModel());

        $form->select(WareLogisticsModel::F_goods_id, __(WareLogisticsModel::Note[WareLogisticsModel::F_goods_id]))->options('/api/ware/goods')->required();
        $form->radio(WareLogisticsModel::F_action, __(WareLogisticsModel::Note[WareLogisticsModel::F_action]))
            ->options($this->setLang(WareLogisticsModel::ActionArray))->default(WareLogisticsModel::action_1);
        $form->date(WareLogisticsModel::F_action_date,__(WareLogisticsModel::Note[WareLogisticsModel::F_action_date]))->required();
        $form->number(WareLogisticsModel::F_count, __(WareLogisticsModel::Note[WareLogisticsModel::F_count]))->required();
        //暂时默认入库
        // $form->radio(WareLogisticsModel::F_is_save, __(WareLogisticsModel::Note[WareLogisticsModel::F_is_save]))
        //     ->options($this->setLang(WareLogisticsModel::IsSaveArray))->default(WareLogisticsModel::is_save_0);
        $form->select(WareLogisticsModel::F_worker_id, __(WareLogisticsModel::Note[WareLogisticsModel::F_worker_id]))->options('/api/team/worker')->default(0);
        $form->select(WareLogisticsModel::F_staff_id, __(WareLogisticsModel::Note[WareLogisticsModel::F_staff_id]))->options('/api/team/staff')->required();

        $form->saved(function (Form $form) {
            //录入一条统计数据
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
