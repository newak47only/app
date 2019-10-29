<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Information;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InformationsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '流转项目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        $grid = new Grid(new Information);

        $grid->model()->where('adminuser_id', '!=', Admin::user()->id);

        $grid->column('id', __('Id'));
        $grid->column('name', __('项目名称'))->filter('like');
        $grid->column('content', __('项目简介'))->limit(30);
        $grid->column('ptime', __('项目时间'))->sortable();
        $grid->column('cont_name', __('资方联系人'))->hide();
        $grid->column('cont_phone', __('资方联系方式'))->hide();
        $grid->column('adminuser.department', __('上报单位'))->sortable();
        $grid->column('created_at', __('上报时间'))->sortable();
        $grid->column('updated_at', __('更新时间'))->hide();
        $grid->disableCreateButton();
        $grid->actions(function ($actions) {

        // 去掉删除
        $actions->disableDelete();

        // 去掉编辑
        $actions->disableEdit();

        // 去掉查看
        //$actions->disableView();
        });
        $grid->disableColumnSelector();
       // $grid->disableRowSelector();
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '项目名称');
            $filter->like('cont_name', '资方联系人');
            $filter->like('content', '项目简介');
            
             $filter->between('created_at', '筛选时间')->datetime();
             });


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
        $show->field('adminuser.department', __('上报部门'));
        $show->field('adminuser.name', __('上报人'));
        $show->field('adminuser.telephone', __('上报人电话'));
        $show->field('content', __('项目简介'));
        $show->field('created_at', __('上报时间'));
        $show->field('updated_at', __('更新时间'));
        $show->panel()
    ->tools(function ($tools) {
        $tools->disableEdit();
        //$tools->disableList();
        $tools->disableDelete();
    });
        


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

        $form->text('name', __('Name'));
        $form->date('ptime', __('Ptime'))->default(date('Y-m-d'));
        $form->text('cont_name', __('Cont name'));
        $form->text('cont_phone', __('Cont phone'));
        $form->number('userid', __('Userid'));
        $form->textarea('content', __('Content'));

        return $form;
    }
}
