<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\WareGoodsModel;
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
        $this->title = __('tools');
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
        $grid->column(WareToolsModel::F_tools_name, __('工具名称'));
        $grid->column(WareToolsModel::F_tools_param, __('工具参数'));
        $grid->column(WareToolsModel::F_tools_total, __('数量'));
        $grid->column(WareToolsModel::F_remark, __('备注'));

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableView();
           // $actions->disableDelete();
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

        $form->text(WareToolsModel::F_tools_name, __('工具名称'))->required();
        $form->text(WareToolsModel::F_tools_param, __('工具参数'))->required();
        $form->text(WareToolsModel::F_tools_total, __('数量'))->default(0);
        $form->textarea(WareToolsModel::F_remark, __('备注'));

        $form->footer(function ($footer) {
            // 去掉`查看`checkbox
            $footer->disableViewCheck();
            // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();
            // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();
        });

        return $form;
    }
}
