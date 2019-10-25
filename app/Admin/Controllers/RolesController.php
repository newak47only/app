<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Role;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RolesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '角色';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Role);

        $grid->column('id', __('ID'));
        $grid->column('name', __('名称'));
        $grid->column('slug', __('标识'));
        $grid->column('permissions', __('权限'))->pluck('name')->label();
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
        $show = new Show(Role::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
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
        $form = new Form(new Role);

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));

        return $form;
    }
}
