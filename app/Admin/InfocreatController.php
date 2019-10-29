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

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('ptime', __('Ptime'));
        $grid->column('cont_name', __('Cont name'));
        $grid->column('cont_phone', __('Cont phone'));
        $grid->column('userid', __('Userid'));
        $grid->column('content', __('Content'));
        $grid->column('created_at', __('Created at'));
        $grid->column('updated_at', __('Updated at'));

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
        $show->field('name', __('Name'));
        $show->field('ptime', __('Ptime'));
        $show->field('cont_name', __('Cont name'));
        $show->field('cont_phone', __('Cont phone'));
        $show->field('userid', __('Userid'));
        $show->field('content', __('Content'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

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

       
        $form->text('cont_name', __('资方联系人'))->required();
        $form->text('cont_phone', __('资方联系方式'))->required();
    
        $form->hidden('userid', __('Userid'))->value(Admin::user()->id);
        $form->textarea('content', __('项目介绍'))->required();


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

        $form->setAction('infocreat');



        return $form;
    }
}
