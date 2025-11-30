<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Car\CarCase;

use App\Models\InfoLoadModel;
use App\Models\InfoPackModel;
use App\Models\InfoStripModel;
use Encore\Admin\Form;
use Encore\Admin\Grid;

class InfoLoadController extends BaseController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '';

    protected $stripId = 0;

    public function __construct()
    {
        $this->stripId = request('strip_id', 0);
        $this->title = __(InfoLoadModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new InfoLoadModel());
        $grid->column(InfoLoadModel::F_id, __('ID'))->sortable();
        $grid->column(InfoLoadModel::F_pack_no, __(InfoLoadModel::Note[InfoLoadModel::F_pack_no]));
        $grid->column(InfoLoadModel::F_box_total, __(InfoLoadModel::Note[InfoLoadModel::F_box_total]));
        $grid->column(InfoLoadModel::F_action, __(InfoLoadModel::Note[InfoLoadModel::F_action]));

        $grid->disableExport();
        $grid->disableCreateButton();
        $grid->disableColumnSelector();
        $stripId = $this->stripId;

        $grid->tools(function (Grid\Tools $tools) use ($stripId) {
            $url = $this->getRouteByName('info#strip');
            $createUrl = $this->getRouteByName('info#load', 'create', ['strip_id' => $stripId]);
            $tools->append('<a class="btn btn-sm btn-success" href="' . $createUrl . '" ><i class="fa fa-plus"></i><span class="hidden-xs">  ' . trans('admin.new') . '</span></a>');
            $tools->append('<a class="btn btn-sm btn-default" href="' . $url . '">' . trans('admin.back_to_list') . '</a>');
        });

        $grid->header(function ($query) use ($stripId) {
            $data = InfoStripModel::getInstance()->getOneById($stripId);
            return "<b style='padding: 20px; '>". __(InfoStripModel::Note[InfoStripModel::F_strip_no]) .':'."</b><b style='color:red '>". $data[InfoStripModel::F_strip_no]  . "</b>";
        });

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->disableDelete();
            $actions->add(new CarCase());
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
        $form = new Form(new InfoLoadModel());
        $stripId = $this->stripId;
        $form->select(InfoLoadModel::F_pack_no, __(InfoLoadModel::Note[InfoLoadModel::F_pack_no]))->options([])->ajax('/api/info/pack_no');
        $form->text(InfoLoadModel::F_box_total, __(InfoLoadModel::Note[InfoLoadModel::F_box_total]))->required();
        $form->select(InfoLoadModel::F_action, __(InfoLoadModel::Note[InfoLoadModel::F_action]))
            ->options($this->setLang(InfoLoadModel::ActionArray))->default(InfoLoadModel::action_1);

        $url = $this->getRouteByName('info#load', 'index', ['strip_id' => $stripId]);
        $form->header(function (Form\Tools $actions) use ($url) {
            $actions->disableList();
            $actions->append('<a class="btn btn-sm btn-default" href="' . $url . '">' . trans('admin.back_to_list') . '</a>');
            $actions->disableView();
            $actions->disableDelete();
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
