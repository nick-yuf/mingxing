<?php

namespace App\Admin\Controllers;

use App\Models\FinanceContractModel;
use Encore\Admin\Widgets\Table;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FinanceContractController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(FinanceContractModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new FinanceContractModel());
        $grid->column(FinanceContractModel::F_id, __('ID'))->sortable();
        $grid->column(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $grid->column(FinanceContractModel::F_supplier_name, __(FinanceContractModel::Note[FinanceContractModel::F_supplier_name]));
        $grid->column('222', __('info'))->modal(__('info'), function ($model) {
            return new Table(['#' . __('Param') . '#', '#' . __('Value') . '#'], [
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_name]), $model[FinanceContractModel::F_supplier_name]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_id]), $model[FinanceContractModel::F_supplier_id]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_address]), $model[FinanceContractModel::F_supplier_address]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_supplier_phone]), $model[FinanceContractModel::F_supplier_phone]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_tonnage]), $model[FinanceContractModel::F_tonnage]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_priceA]), $model[FinanceContractModel::F_priceA]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_priceB]), $model[FinanceContractModel::F_priceB]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_remark]), $model[FinanceContractModel::F_remark]],
                [__(FinanceContractModel::Note[FinanceContractModel::F_sign_date]), $model[FinanceContractModel::F_sign_date]],
            ], ['table', 'table-bordered', 'table-condensed', 'table-striped']);
        })->width(100);

        $grid->column(FinanceContractModel::F_sign_date, __(FinanceContractModel::Note[FinanceContractModel::F_sign_date]));
        $grid->column('staff.staff_name', __(FinanceContractModel::Note[FinanceContractModel::F_staff_id]));
        $grid->column(FinanceContractModel::F_status, __(FinanceContractModel::Note[FinanceContractModel::F_status]))
            ->editable('select', FinanceContractModel::rtnEnumLang(FinanceContractModel::StatusArray))->width(100);
        $grid->disableExport();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
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
        $show = new Show(FinanceContractModel::findOrFail($id));

        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));
        $show->field(FinanceContractModel::F_contract_no, __(FinanceContractModel::Note[FinanceContractModel::F_contract_no]));


        return $show;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form(): Form
    {
        $form = new Form(new FinanceContractModel());

        $form->text(FinanceContractModel::F_supplier_name, __(FinanceContractModel::Note[FinanceContractModel::F_supplier_name]))->required();
        $form->text(FinanceContractModel::F_supplier_id, __(FinanceContractModel::Note[FinanceContractModel::F_supplier_id]));
        $form->text(FinanceContractModel::F_supplier_address, __(FinanceContractModel::Note[FinanceContractModel::F_supplier_address]));
        $form->text(FinanceContractModel::F_supplier_phone, __(FinanceContractModel::Note[FinanceContractModel::F_supplier_phone]));
        $form->text(FinanceContractModel::F_deposit, __(FinanceContractModel::Note[FinanceContractModel::F_deposit]))->default(0);
        $form->text(FinanceContractModel::F_priceA, __(FinanceContractModel::Note[FinanceContractModel::F_priceA]))->default(0);
        $form->text(FinanceContractModel::F_priceB, __(FinanceContractModel::Note[FinanceContractModel::F_priceB]))->default(0);
        $form->text(FinanceContractModel::F_tonnage, __(FinanceContractModel::Note[FinanceContractModel::F_tonnage]));
        $form->select(FinanceContractModel::F_staff_id, __(FinanceContractModel::Note[FinanceContractModel::F_staff_id]))->options('/api/team/staff')->required();
        $form->radio(FinanceContractModel::F_status, __(FinanceContractModel::Note[FinanceContractModel::F_status]))
            ->options($this->setLang(FinanceContractModel::StatusArray))->default(FinanceContractModel::status_1);
        $form->textarea(FinanceContractModel::F_remark, __(FinanceContractModel::Note[FinanceContractModel::F_remark]));
        $form->hidden(FinanceContractModel::F_contract_no);
        $form->date(FinanceContractModel::F_sign_date, __(FinanceContractModel::Note[FinanceContractModel::F_sign_date]))->required();

        $form->saving(function (Form $form) {
            //
        });

        $form->saved(function (Form $form) {
            $contractNo = 'A';
            if($form->priceA <> 0 && $form->priceB <> 0) {
                $contractNo = 'AB';
            }elseif($form->priceA == 0) {
                $contractNo = 'B';
            }
            $id = $form->model()->id;
            $contractNo .= date('Ymd').$id;

            FinanceContractModel::getInstance()->updateById($id, [
                FinanceContractModel::F_contract_no => $contractNo
            ]);
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
