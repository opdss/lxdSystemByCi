<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="form-page">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改部门</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-8 column">
                <form>
                    <div class="field-box">
                        <label>部门名称:</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="dept_name" value="<?php echo $dept_info['dept_name'];?>"/>
                        </div>
                    </div>

                    <div class="field-box">
                        <label>所属部门:</label>
                        <div class="col-md-7">
                            <select name="pid">
                                <option value="0">--请选择--</option>
                                <?php foreach($dept_list as $v):?>
                                    <option value="<?php echo $v['id'];?>" <?php echo $dept_info['pid']==$v['id'] ? "checked='checked'" : '';?>><?php echo str_repeat('　　',$v['level']-1).$v['dept_name'];?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>

                    <div class="field-box">
                        <label>部门介绍:</label>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="4" name="dept_desc"><?php echo $dept_info['dept_desc'];?></textarea>
                        </div>
                    </div>

                    <div class="col-md-8 actions" >
                        <input type="button" class="btn-glow primary" value="修改" id="add_btn">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $dept_info['id'];?>"/>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end main container -->
<script>

    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        W.ajax({'data':data},'<?php echo site_url('department/edit');?>',function(){
            window.location.href = '<?php echo site_url('department/index');?>';
        });
    });


</script>