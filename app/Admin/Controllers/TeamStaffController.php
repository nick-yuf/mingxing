<?php

namespace App\Admin\Controllers;

use App\Models\TeamStaffModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class TeamStaffController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    public function __construct()
    {
        $this->title = __(TeamStaffModel::table_name);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new TeamStaffModel());
        $grid->column(TeamStaffModel::F_id, __('ID'))->sortable();
        $grid->column(TeamStaffModel::F_staff_name, __(TeamStaffModel::Note[TeamStaffModel::F_staff_name]));
        $grid->column(TeamStaffModel::F_staff_job, __(TeamStaffModel::Note[TeamStaffModel::F_staff_job]));
        $grid->column(TeamStaffModel::F_contact,__(TeamStaffModel::Note[TeamStaffModel::F_contact]));
        $grid->column(TeamStaffModel::F_staff_status, __(TeamStaffModel::Note[TeamStaffModel::F_staff_status]))
            ->editable('select', TeamStaffModel::rtnEnumLang(TeamStaffModel::StaffStatusArray))->width(100);
        $grid->column(TeamStaffModel::F_staff_type, __(TeamStaffModel::Note[TeamStaffModel::F_staff_type]))
            ->editable('select', TeamStaffModel::rtnEnumLang(TeamStaffModel::StaffTypeArray))->width(100);

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
        $form = new Form(new TeamStaffModel());

        $form->text(TeamStaffModel::F_staff_name, __(TeamStaffModel::Note[TeamStaffModel::F_staff_name]))->required();
        $form->text(TeamStaffModel::F_staff_job, __(TeamStaffModel::Note[TeamStaffModel::F_staff_job]))->required();
        $form->text(TeamStaffModel::F_contact, __(TeamStaffModel::Note[TeamStaffModel::F_contact]))->required();
        $form->radio(TeamStaffModel::F_staff_type, __(TeamStaffModel::Note[TeamStaffModel::F_staff_type]))
            ->options($this->setLang(TeamStaffModel::StaffTypeArray))->default(TeamStaffModel::staff_type_1);
        $form->radio(TeamStaffModel::F_staff_status, __(TeamStaffModel::Note[TeamStaffModel::F_staff_status]))
            ->options($this->setLang(TeamStaffModel::StaffStatusArray))->default(TeamStaffModel::staff_status_1);


        $form->footer(function (Form\Footer $footer) {
            $footer->disableViewCheck();
            $footer->disableEditingCheck();
            $footer->disableCreatingCheck();
            $footer->disableReset();
        });

        return $form;
    }
}
