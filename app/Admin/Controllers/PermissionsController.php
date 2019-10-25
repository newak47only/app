<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Permission;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PermissionsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '权限';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Permission);

        $grid->column('id', __('Id'));
        $grid->column('name', __('Name'));
        $grid->column('slug', __('Slug'));
        $grid->column('http_method', __('Http method'));
        $grid->column('http_path', __('Http path'));
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
        $show = new Show(Permission::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('slug', __('Slug'));
        $show->field('http_method', __('Http method'));
        $show->field('http_path', __('Http path'));
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
        $form = new Form(new Permission);

        $form->text('name', __('Name'));
        $form->text('slug', __('Slug'));
        $form->text('http_method', __('Http method'));
        $form->textarea('http_path', __('Http path'));

        return $form;
    }
}
