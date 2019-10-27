<?php

namespace App\Admin\Controllers;

use App\Admin\Models\project;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ProjectController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '外资项目';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new project);

        $grid->column('id', __('ID'))->sortable();
        $grid->column('pname', __('项目名称'));
        $grid->column('ptime', __('编制时间'));
        $grid->column('pdate', __('项目有效期'));
        $grid->column('pdistrict', __('编制地区'));
        $grid->column('punit', __('编制单位'));
        $grid->column('pleader', __('项目负责人'));
        $grid->column('plink', __('项目联系人'));
        $grid->column('pphone', __('联络方式'));
        $grid->column('ptype', __('项目类型'));
        $grid->column('pcode', __('所属行业代码'));
        $grid->column('pindustry', __('所属行业描述'));
        $grid->column('ptext', __('项目内容'));
        $grid->column('pmode', __('投资方式'));
        $grid->column('pamount', __('预计投资金额'));
        $grid->column('ppolicy', __('国家政策方向'));
        $grid->column('pyes', __('是否有政策支持'));
        $grid->column('pptext', __('支持政策具体内容'));

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
        $show = new Show(project::findOrFail($id));

      
        $show->field('pname', __('项目名称'));
        $show->field('ptime', __('编制时间'));
        $show->field('pdate', __('项目有效期'));
        $show->field('pdistrict', __('编制地区'));
        $show->field('punit', __('编制单位'));
        $show->field('pleader', __('项目负责人'));
        $show->field('plink', __('项目联系人'));
        $show->field('pphone', __('联系方式'));
        $show->field('ptype', __('项目类型'));
        $show->field('pcode', __('所属行业代码'));
        $show->field('pindustry', __('所属行业描述'));
        $show->field('ptext', __('项目内容'));
        $show->field('pmode', __('投资方式'));
        $show->field('pamount', __('预计投资金额'));
        $show->field('ppolicy', __('国家政策方向'));
        $show->field('pyes', __('是否有政策支持'));
        $show->field('pptext', __('支持政策具体内容'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new project);
        $form->column(1/2, function ($form) {

        $form->text('pname', __('项目名称'));
        });
        $form->column(1/2, function ($form) {
        $form->date('update', __('编制时间'));
        });
        $form->column(1/2, function ($form) {
        $form->text('pdate', __('项目有效期'));
        });
        $form->column(1/2, function ($form) {
        $form->select('pdistrict', __('编制地区'))->options([1 => '余姚市', 2 => '慈溪市', '3' => '宁海县','4' => '象山县','5' => '海曙区','6' => '鄞州区','7' => '江北区','8' => '镇海区','9' => '奉化区','10' => '北仑区','11' => '奉化区','12' =>'高新区']);
        });

        $form->column(1/2, function ($form) {
        $form->text('punit', __('编制单位'));
        });
        $form->column(1/2, function ($form) {
        $form->text('pleader', __('项目负责人'));
        });
        $form->column(1/2, function ($form) {
        $form->text('plink', __('项目联系人'));
        });
        $form->column(1/2, function ($form) {
        $form->text('pphone', __('联系方式'));
        });
        $form->column(1/2, function ($form) {
        $form->select('ptype', __('项目类型'))->options([1 => '新建项目', 2 => '增资项目', '3' => '并购项目']);
        });
        $form->column(1/2, function ($form) {
        $form->text('pcode', __('所属行业代码'));
        });
        $form->column(1/2, function ($form) {
        $form->text('pindustry', __('所属行业描述'));
        });
        $form->column(1/2, function ($form) {
        $form->select('pmode', __('投资方式'))->options([1 => '外商独资', 2 => '中外合资']);
        });
        $form->column(1/2, function ($form) {
        $form->currency('pamount', __('预计投资金额'))->symbol('$');
        });
       
        $form->textarea('ptext', __('项目内容'));
       
        $form->column(1/2, function ($form) {
        $form->text('ppolicy', __('国家政策方向'));
        });
        $form->column(1/2, function ($form) {
        $form->radio('pyes', __('是否有政策支持'))->options(['m' => '是', 'f'=> '否'])->default('m');
        });


        $form->textarea('pptext', __('支持政策具体内容'));

        return $form;
    }
}
