<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Info\PackEdit;
use App\Models\FinanceContractModel;
use App\Models\InfoOrchardModel;
use App\Models\InfoPackModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class InfoPackController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    protected $orchardId = 0;
    public function __construct()
    {
        $this->orchardId = request('orchard_id', 0);
        $this->title = __(InfoPackModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new InfoPackModel());
        $grid->column(InfoPackModel::F_id, __('ID'))->sortable();
        $grid->column(InfoPackModel::F_pack_no, __(InfoPackModel::Note[InfoPackModel::F_pack_no]));
        $grid->column(InfoPackModel::F_delivery_date, __(InfoPackModel::Note[InfoPackModel::F_delivery_date]));
        $grid->column('worker.worker_no', __(InfoPackModel::Note[InfoPackModel::F_worker_id]));
        $grid->column(InfoPackModel::F_transport_no, __(InfoPackModel::Note[InfoPackModel::F_transport_no]));
        $grid->column(InfoPackModel::F_box_count, __(InfoPackModel::Note[InfoPackModel::F_box_count]));
        $grid->column(InfoPackModel::F_product_level, __(InfoPackModel::Note[InfoPackModel::F_product_level]))
            ->editable('select', InfoPackModel::rtnEnumLang(InfoPackModel::LevelArray))->width(100);
        $grid->column('staff.staff_name', __(InfoPackModel::Note[InfoPackModel::F_staff_id]));

        $grid->disableExport();
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $orchardId = $this->orchardId;

        $grid->tools(function (Grid\Tools $tools) use ($orchardId) {
            $url = $this->getRouteByName('info#orchard');
            $createUrl = $this->getRouteByName('info#pack', 'create', ['orchard_id' => $orchardId]);
            $tools->append('<a class="btn btn-sm btn-success" href="' . $createUrl . '" ><i class="fa fa-plus"></i><span class="hidden-xs">  ' . trans('admin.new') . '</span></a>');
            $tools->append('<a class="btn btn-sm btn-default" href="' . $url . '">' . trans('admin.back_to_list') . '</a>');
        });

        $grid->header(function ($query) use ($orchardId) {
            $data = InfoOrchardModel::getInstance()->getOneById($orchardId);
            return "<b style='padding: 20px;color:green '>" . $data[InfoOrchardModel::F_orchard_name]  . "</b>";
        });

        $grid->actions(function ($actions) use ($orchardId){
            $actions->add(new PackEdit($orchardId,$actions->getKey()));
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
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
        $form = new Form(new InfoPackModel());
        $orchardId = $this->orchardId;

        $form->hidden(InfoPackModel::F_pack_no)->value($orchardId);
        $form->number(InfoPackModel::F_transport_no, __(InfoPackModel::Note[InfoPackModel::F_transport_no]))->required()->default(0);
        $form->date(InfoPackModel::F_delivery_date, __(InfoPackModel::Note[InfoPackModel::F_delivery_date]))->required();
        $form->number(InfoPackModel::F_box_count, __(InfoPackModel::Note[InfoPackModel::F_box_count]))->required()->default(0);
        $form->radio(InfoPackModel::F_product_level, __(InfoPackModel::Note[InfoPackModel::F_product_level]))
            ->options($this->setLang(InfoPackModel::LevelArray))->default(InfoPackModel::product_level_1);
        $form->number(InfoPackModel::F_in_4, __(InfoPackModel::Note[InfoPackModel::F_in_4]))->default(0);
        $form->number(InfoPackModel::F_in_5, __(InfoPackModel::Note[InfoPackModel::F_in_5]))->default(0);
        $form->number(InfoPackModel::F_in_6, __(InfoPackModel::Note[InfoPackModel::F_in_6]))->default(0);
        $form->number(InfoPackModel::F_in_7, __(InfoPackModel::Note[InfoPackModel::F_in_7]))->default(0);
        $form->number(InfoPackModel::F_in_8, __(InfoPackModel::Note[InfoPackModel::F_in_8]))->default(0);
        $form->number(InfoPackModel::F_in_cl, __(InfoPackModel::Note[InfoPackModel::F_in_cl]))->default(0);
        $form->select(InfoPackModel::F_staff_id, __(InfoPackModel::Note[InfoPackModel::F_staff_id]))->options('/api/team/staff')->required();


        $form->saved(function (Form $form) {
            if($form->isCreating()) {
                $orchardId = $form->model()->getAttribute(InfoPackModel::F_pack_no);
                $orchard = InfoOrchardModel::getInstance()->getOneById($orchardId);
                //果园 id+日期+pk+班次
                $packNo = $orchardId . date('Ymd') . $form->model()->id . $form->model()->transport_no;
                InfoPackModel::getInstance()->updateById($form->model()->id, [
                    InfoPackModel::F_orchard_id => $orchardId,
                    InfoPackModel::F_contract_id => $orchard['contract'][FinanceContractModel::F_id],
                    InfoPackModel::F_pack_no => $packNo,
                    InfoPackModel::F_worker_id => $orchard['contract'][FinanceContractModel::F_worker_id]
                ]);
            }
            if($form->isEditing()) {
                $orchardId = $form->model()->orchard_id;
            }
            //更新果园数据
            //运载总数
            $count = InfoPackModel::getInstance()->getCountByOrchard($orchardId);
            //总件数
            $BoxTotal = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_box_count);
            $BoxTotal_a = InfoPackModel::getInstance()->getTotalByOrchardLevel($orchardId,InfoPackModel::product_level_1);
            $BoxTotal_b = InfoPackModel::getInstance()->getTotalByOrchardLevel($orchardId,InfoPackModel::product_level_2);
            $BoxTotal_4 = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_4);
            $BoxTotal_5 = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_5);
            $BoxTotal_6 = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_6);
            $BoxTotal_7 = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_7);
            $BoxTotal_8 = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_8);
            $BoxTotal_cl = InfoPackModel::getInstance()->getTotalByOrchard($orchardId,InfoPackModel::F_in_cl);

            InfoOrchardModel::getInstance()->updateById(
                $orchardId,
                [
                    InfoOrchardModel::F_box_total => $BoxTotal,
                    InfoOrchardModel::F_shipment_total => $count,
                    InfoOrchardModel::F_in_a => $BoxTotal_a,
                    InfoOrchardModel::F_in_b => $BoxTotal_b,
                    InfoOrchardModel::F_in_4 => $BoxTotal_4,
                    InfoOrchardModel::F_in_5 => $BoxTotal_5,
                    InfoOrchardModel::F_in_6 => $BoxTotal_6,
                    InfoOrchardModel::F_in_7 => $BoxTotal_7,
                    InfoOrchardModel::F_in_8 => $BoxTotal_8,
                    InfoOrchardModel::F_in_cl => $BoxTotal_cl,
                ]
            );
        });

        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        $url = $this->getRouteByName('info#pack', 'index', ['orchard_id' => $orchardId]);
        $form->header(function (Form\Tools $actions) use ($url) {
            $actions->disableList();
            $actions->append('<a class="btn btn-sm btn-default" href="' . $url . '">' . trans('admin.back_to_list') . '</a>');
            $actions->disableView();
            $actions->disableDelete();
        });

        return $form;
    }
}
