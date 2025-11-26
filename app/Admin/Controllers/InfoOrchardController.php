<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Info\Pack;
use App\Models\FinanceContractModel;
use App\Models\InfoOrchardModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Widgets\Table;

class InfoOrchardController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(InfoOrchardModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new InfoOrchardModel());
        $grid->column(InfoOrchardModel::F_id, __('ID'))->sortable();
        $grid->column(InfoOrchardModel::F_orchard_name, __(InfoOrchardModel::Note[InfoOrchardModel::F_orchard_name]));
        $grid->column('contract.contract_no', __(InfoOrchardModel::Note[InfoOrchardModel::F_contract_id]))->modal(__(InfoOrchardModel::Note[InfoOrchardModel::F_contract_id]), function ($model) {
            return new Table(['#' . __('Param') . '#', '#' . __('Value') . '#'], [
                [__(FinanceContractModel::Note[FinanceContractModel::F_contract_no]), $model['contract'][FinanceContractModel::F_contract_no]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_name]), $model['contract'][FinanceContractModel::F_supplier_name]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_phone]), $model['contract'][FinanceContractModel::F_supplier_phone]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_tonnage]), $model['contract'][FinanceContractModel::F_tonnage]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_deposit]), $model['contract'][FinanceContractModel::F_deposit]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_remark]), $model['contract'][FinanceContractModel::F_remark]],
            ], ['table', 'table-bordered', 'table-condensed', 'table-striped']);
        })->width(200);
        $grid->column(InfoOrchardModel::F_start_date, __(InfoOrchardModel::Note[InfoOrchardModel::F_start_date]));
        $grid->column(InfoOrchardModel::F_shipment_total, __(InfoOrchardModel::Note[InfoOrchardModel::F_shipment_total]))->width(100);
        $grid->column(InfoOrchardModel::F_box_total, __(InfoOrchardModel::Note[InfoOrchardModel::F_box_total]))->width(100);
//        $grid->column(InfoOrchardModel::F_remark, __(InfoOrchardModel::Note[InfoOrchardModel::F_remark]));
        $grid->column('user.name', __(InfoOrchardModel::Note[InfoOrchardModel::F_user_id]));

        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            $actions->add(new Pack());
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
        $form = new Form(new InfoOrchardModel());

        $form->text(InfoOrchardModel::F_orchard_name, __(InfoOrchardModel::Note[InfoOrchardModel::F_orchard_name]))->required();
        $form->select(InfoOrchardModel::F_contract_id, __(InfoOrchardModel::Note[InfoOrchardModel::F_contract_id]))->options('/api/finance/contract')->required();
        $form->date(InfoOrchardModel::F_start_date, __(InfoOrchardModel::Note[InfoOrchardModel::F_start_date]))->required();
        $form->textarea(InfoOrchardModel::F_remark, __(InfoOrchardModel::Note[InfoOrchardModel::F_remark]))->required();

        $form->hidden(InfoOrchardModel::F_user_id)->default(\Encore\Admin\Facades\Admin::user()->id);
        $form->footer(function ($footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
