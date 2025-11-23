<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\WareGoodsModel;
use App\Models\WareLogisticsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

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
        $this->title = __('物流明细');
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
        $grid->column(WareLogisticsModel::F_goods_id, __('货物名称'))->display(function ($id) {
            $row = WareGoodsModel::getInstance()->getOneById($id);
            return "{$row[WareGoodsModel::F_goods_name]}";
        });;
        $grid->column(WareLogisticsModel::F_action, __('行为'))
            ->editable('select', WareLogisticsModel::rtnEnumLang(WareLogisticsModel::ActionArray))->width(100);
        $grid->column(WareLogisticsModel::F_count, __('数量'));

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

        $form->select(WareLogisticsModel::F_goods_id, __('货物'))->options('/api/ware/goods')->required()->default(1);
        $form->select(WareLogisticsModel::F_action, __('行为'))->options($this->setLang(WareLogisticsModel::ActionArray))->default(WareLogisticsModel::action_1);
        $form->text(WareLogisticsModel::F_count, __('数量'))->required();
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
