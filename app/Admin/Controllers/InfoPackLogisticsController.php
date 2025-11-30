<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Info\PackLogisticsEdit;
use App\Models\InfoOrchardModel;
use App\Models\WareLogisticsModel;
use Encore\Admin\Grid;

class InfoPackLogisticsController extends BaseController
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
        $this->title = __(WareLogisticsModel::$tableComment);
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid(): Grid
    {
        $grid = new Grid(new WareLogisticsModel());
        $grid->model()->where(WareLogisticsModel::F_contract_id,13);
        $grid->column(WareLogisticsModel::F_id, __('ID'))->sortable();
        $grid->column('goods.goods_name', __(WareLogisticsModel::Note[WareLogisticsModel::F_goods_id]));
        $grid->column(WareLogisticsModel::F_count, __(WareLogisticsModel::Note[WareLogisticsModel::F_count]));
        $grid->column(WareLogisticsModel::F_action, __(WareLogisticsModel::Note[WareLogisticsModel::F_action]))
            ->editable('select', WareLogisticsModel::rtnEnumLang(WareLogisticsModel::ActionArray))->width(100);

        $orchardId = $this->orchardId;
        $grid->disableExport();
        $grid->disableCreateButton();
        $grid->disableColumnSelector();

        $grid->tools(function (Grid\Tools $tools) use ($orchardId) {
            $url = $this->getRouteByName('info#orchard');
            $tools->append('<a class="btn btn-sm btn-default" href="' . $url . '">' . trans('admin.back_to_list') . '</a>');
        });

        $grid->header(function ($query) use ($orchardId) {
            $data = InfoOrchardModel::getInstance()->getOneById($orchardId);
            return "<b style='padding: 20px;color:green '>" . $data[InfoOrchardModel::F_orchard_name]  . "</b>";
        });
        $grid->actions(function ($actions) use($orchardId) {
            $actions->add(new PackLogisticsEdit($orchardId,$actions->getKey()));
            $actions->disableView();
            $actions->disableEdit();
            $actions->disableDelete();
        });

        return $grid;
    }


}
