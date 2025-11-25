<?php

namespace App\Admin\Controllers;

use App\Models\WareGoodsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class WareGoodsController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(WareGoodsModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new WareGoodsModel());
        $grid->column(WareGoodsModel::F_id, __('ID'))->sortable();
        $grid->column(WareGoodsModel::F_goods_name, __(WareGoodsModel::Note[WareGoodsModel::F_goods_name]));
        $grid->column(WareGoodsModel::F_goods_spec, __(WareGoodsModel::Note[WareGoodsModel::F_goods_spec]));
        $grid->column(WareGoodsModel::F_remark, __(WareGoodsModel::Note[WareGoodsModel::F_remark]));

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
        $form = new Form(new WareGoodsModel());

        $form->text(WareGoodsModel::F_goods_name, __(WareGoodsModel::Note[WareGoodsModel::F_goods_name]))->required();
        $form->text(WareGoodsModel::F_goods_spec, __(WareGoodsModel::Note[WareGoodsModel::F_goods_spec]))->required();
        $form->textarea(WareGoodsModel::F_remark, __(WareGoodsModel::Note[WareGoodsModel::F_remark]));
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
