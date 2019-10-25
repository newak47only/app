<?php

namespace App\Admin\Controllers;

use App\User;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class UsersController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '用户';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new User);

        $grid->column('id', __('Id'));
        $grid->column('loginname', __('登录名'));
        $grid->column('name', __('姓名'));
        $grid->column('password', __('登录密码'));
        $grid->column('department', __('工作部门'));
        $grid->column('email', __('邮箱'));
        $grid->column('phone', __('电话'));
        $grid->column('telephone', __('手机'));
        $grid->column('created_at', __('创建时间'));
        $grid->column('updated_at', __('更新时间'));

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
        $show = new Show(User::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('loginname', __('登录名'));
        $show->field('name', __('姓名'));
        $show->field('password', __('登录密码'));
        $show->field('department', __('工作部门'))->required();
        $show->field('email', __('Email'));
        $show->field('phone', __('电话'));
        $show->field('telephone', __('手机'));
        $show->field('created_at', __('创建时间'));
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
        $form = new Form(new User);

        $form->text('loginname', __('登录名'))->required();
        $form->text('name', __('姓名'));
        $form->password('password', __('登录密码'))->required();
        $form->text('department', __('工作部门'))->required();
        $form->email('email', __('Email'));
        $form->text('phone', __('电话'));
        $form->text('telephone', __('手机'));


        return $form;
    }
}
