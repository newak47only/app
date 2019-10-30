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
    protected $title = 'App\Admin\Models\Information';

    public function index(Content $content)
    {

         return $content
            ->title('流转项目上报')
            ->row(InfocreatController::form())
            ->row(InfocreatController::Grid())
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
        $grid->column('ptime', __('项目时间'));
        $grid->column('cont_name', __('资方联系人'));
        $grid->column('cont_phone', __('资方联系方式'));
        $grid->column('created_at', __('上报时间'));
        $grid->column('updated_at', __('更新时间'));
        $grid->filter(function($filter){

            // 去掉默认的id过滤器
            $filter->disableIdFilter();

            // 在这里添加字段过滤器
            $filter->like('name', '项目名称');
            $filter->like('cont_name', '资方联系人');
            $filter->like('content', '项目简介');
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
        $show->field('ptime', __('项目时间'));
        $show->field('cont_name', __('资方联系人'));
        $show->field('cont_phone', __('资方联系方式'));
      
        $show->field('content', __('项目简介'));
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
       
       

        $form->text('name', __('项目名称'))->autofocus()->required();
        $form->date('ptime', __('项目时间'))->default(date('Y-m-d'))->required();    
        $form->text('cont_name', __('资方联系人'))->required()->placeholder('请输入资方联系人姓名');
        $form->text('cont_phone', __('资方联系方式'))->required()->placeholder('请输入资方联系人手机或者座机');
        $form->hidden('adminuser_id', __('Userid'))->value(Admin::user()->id);
        $form->textarea('content', __('项目介绍'))->required()->placeholder('请填写项目简要介绍，以及落地需求......');



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

        $form->setAction('../admin/infocreat');

        return $form;
    }
}
