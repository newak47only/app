<?php

namespace App\Admin\Controllers;

use App\Admin\Models\Adminuser;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class AdminuserController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'App\Admin\Models\Adminuser';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Adminuser);

        $grid->column('id', __('Id'));
        $grid->column('username', __('Username'));
        $grid->column('password', __('Password'));
        $grid->column('name', __('Name'));
        $grid->column('avatar', __('Avatar'));
        $grid->column('department', __('Department'));
        $grid->column('phone', __('Phone'));
        $grid->column('telephone', __('Telephone'));
        $grid->column('email', __('Email'));
        $grid->column('remember_token', __('Remember token'));
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
        $show = new Show(Adminuser::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('username', __('Username'));
        $show->field('password', __('Password'));
        $show->field('name', __('Name'));
        $show->field('avatar', __('Avatar'));
        $show->field('department', __('Department'));
        $show->field('phone', __('Phone'));
        $show->field('telephone', __('Telephone'));
        $show->field('email', __('Email'));
        $show->field('remember_token', __('Remember token'));
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
        $form = new Form(new Adminuser);

        $form->text('username', __('Username'));
        $form->password('password', __('Password'));
        $form->text('name', __('Name'));
        $form->image('avatar', __('Avatar'));
        $form->text('department', __('Department'));
        $form->mobile('phone', __('Phone'));
        $form->text('telephone', __('Telephone'));
        $form->email('email', __('Email'));
        $form->text('remember_token', __('Remember token'));

        return $form;
    }
}
