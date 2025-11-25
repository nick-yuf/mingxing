<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\WareGoodsModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfoContainerController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __('box');
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
        $grid->column(WareGoodsModel::F_goods_name, __('货物名称'));
        $grid->column(WareGoodsModel::F_goods_spec, __('货物规格'));

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
        $form = new Form(new WareGoodsModel());

        $form->text(WareGoodsModel::F_goods_name, __('货物名称'))->required();
        $form->text(WareGoodsModel::F_goods_spec, __('货物规格'))->required();
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
