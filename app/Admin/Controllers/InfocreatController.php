<?php

namespace App\Admin\Controllers;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Admin\Models\Information;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class InfocreatController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    

    public function index(Content $content)
    {

         return $content
            ->title('流转项目上报')
            ->row(InfocreatController::form())

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

        $grid->model()->where('adminuser_id', '=', Admin::user()->id);
        $grid->disableCreateButton();

       $grid->column('id', __('Id'));
        $grid->column('name', __('项目名称'));
        $grid->column('content', __('项目简介'))->limit(30);
        $grid->column('industry', __('行业类别'));
        $grid->column('investment', __('投资金额')); 
        $grid->column('cont_name', __('资方联系人'));
        $grid->column('cont_phone', __('资方联系方式'));
        $grid->column('staff_name', __('工作人员姓名'));
        $grid->column('staff_phone', __('工作人员电话'));
        $grid->column('created_at', __('上报时间'));
        $grid->column('updated_at', __('更新时间'));
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '项目名称');
            $filter->like('cont_name', '资方联系人');
            $filter->like('content', '项目情况');
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



        $form->tools(function (Form\Tools $tools) {

    // 去掉`列表`按钮
            $tools->disableList();

        });

            $form->footer(function ($footer) {

    // 去掉`重置`按钮
            $footer->disableReset();

    // 去掉`查看`checkbox
            $footer->disableViewCheck();

    // 去掉`继续编辑`checkbox
            $footer->disableEditingCheck();

    // 去掉`继续创建`checkbox
            $footer->disableCreatingCheck();

        });

        $form->setAction('../admin/myinfo');

        return $form;
    }
}
