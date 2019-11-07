<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Information;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Widgets\Table;
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
        $grid->column('name', __('项目名称'))->filter('like')->link(function () {
    return '../admin/information/'.  $this->id;
});
        $grid->column('content', __('项目情况'))->limit(30);
        $grid->column('industry', __('行业类别'));
        $grid->column('investment', __('投资金额'));
        $grid->column('cont_name', __('资方联系人'))->hide();
        $grid->column('cont_phone', __('资方联系方式'))->hide();
        $grid->column('staff_name', __('工作人员姓名'));
        $grid->column('staff_phone', __('工作人员电话'));
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
 
       $show->field('name', __('项目名称'));
        $show->field('industry', __('行业类别'));
        $show->field('investment', __('投资金额'));
        $show->field('cont_name', __('资方联系人'));
        $show->field('cont_phone', __('资方联系方式'));

        $show->field('staff_name', __('工作人员姓名'));
        $show->field('staff_phone', __('工作人员电话'));
      
        $show->field('content', __('项目情况'));
        $show->field('created_at', __('上报时间'));
        $show->field('updated_at', __('更新时间'));
        $show->adminuser('上传人信息', function ($adminuser) {

            $adminuser->setResource(Adminuser::class);
            $adminuser->field('name', __('姓名'));
            $adminuser->field('department', __('部门'));
            $adminuser->field('telephone', __('电话'));
            $adminuser->panel()->tools(function ($tools) {
                $tools->disableEdit();
                //$tools->disableList();
                $tools->disableDelete();
            });

        });

        $show->panel()->tools(function ($tools) {
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

       $form->text('name', __('项目名称'))->autofocus()->placeholder('例：上汽大众新能源汽车工厂项目')->required();
       $form->text('industry', __('行业类别'))->required();
        $form->currency('investment', __('投资金额'))->icon('fa-usd')->required();     
        $form->text('cont_name', __('资方联系人'))->placeholder('选填内容，可为空');
        $form->text('cont_phone', __('资方联系方式'))->placeholder('选填内容，可为空');
        $form->text('staff_name', __('工作人员姓名'));
        $form->text('staff_phone', __('工作人员电话'));
        $form->hidden('adminuser_id', __('adminuser_id'))->value(Admin::user()->id);
        $form->textarea('content', __('项目情况'))->required()->placeholder('请填写项目介绍（包括项目投资额度、产业类别等）、项目需求（如土地、排放、能耗等）、谈判进度等......');


        return $form;
    }
}
