<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Layout\Content;
use App\Admin\Models\Information;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InforcreatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '流转信息上报';
    public function index(Content $content)
    {

         return $content
            ->title('流转项目上报')
            ->row(InforcreatController::form())
            ->row(InforcreatController::Grid())
            ;
    }


    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Information);

        $grid->column('id', __('Id'));
        $grid->column('name', __('项目名称'));
        $grid->column('ptime', __('项目时间'));
        $grid->column('cont_name', __('资方联系人'));
        $grid->column('cont_phone', __('资方联系方式'));
        $grid->column('content', __('项目简介'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Information::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('项目名称'));
        $show->field('ptime', __('项目时间'));
        $show->field('cont_name', __('资方联系人'));
        $show->field('cont_phone', __('资方联系方式'));
        $show->field('userid', __('上报人'));
        $show->field('report_man', __('Report man'));
        $show->field('report_phone', __('Report phone'));
        $show->field('content', __('Content'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Information);

        $form->text('name', __('项目名称'));
        $form->date('ptime', __('项目时间'))->default(date('Y-m-d'));
        $form->text('cont_name', __('资方联系人'));
        $form->text('cont_phone', __('资方联系方式'));
  
        $form->textarea('content', __('项目简介'));

        

        return $form;
    }
}
