<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\WareGoodsModel;
use App\Models\WareLogisticsModel;
use App\Models\WareStatisticsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WareStatisticsController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __('Car type');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new WareStatisticsModel());
        $grid->column(WareStatisticsModel::F_id, __('ID'))->sortable();
        $grid->column(WareStatisticsModel::F_goods_id, __('货物名称'))->display(function ($id) {
            $row = WareGoodsModel::getInstance()->getOneById($id);
            return "{$row[WareGoodsModel::F_goods_name]}";
        });;
        $grid->column(WareStatisticsModel::F_sum, __('库存总数'));

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            $actions->add(new CarCase());
        });

        return $grid;
    }


    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id): Show
    {
        $show = new Show(WareGoodsModel::findOrFail($id));

        $show->field(CarModel::F_car_type, __('Car type'));
        $show->field(CarModel::F_desc, __('Description'));
        $show->field(CarModel::F_images, __('Image'))->image();
        $show->field(CarModel::F_created_at, __('Created at'));
        $show->field(CarModel::F_updated_at, __('Updated at'));

        return $show;
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
