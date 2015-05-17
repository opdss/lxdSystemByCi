<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="form-page">
        <div class="row header">
            <div class="col-md-12">
                <h3>修改角色</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-8 column">
                <form>
                    <div class="field-box">
                        <label>角色名称:</label>
                        <div class="col-md-7">
                            <input class="form-control" type="text" name="role_name" value="<?php echo $role_info['role_name'];?>"/>
                        </div>
                    </div>
                    <div class="field-box">
                        <label>是否禁用:</label>
                        <div class="col-md-7">
                            <label class="checkbox-inline">
                                <div id="uniform-inlineCheckbox1" class="checker">
                                    <span>
                                    <input name="enabled" id="inlineCheckbox1" type="radio" value="0" <?php echo $role_info['enabled']?'':'checked=checked';?>>
                                    </span>
                                    有效
                                </div>
                            </label>
                            <label class="checkbox-inline">
                                <div id="uniform-inlineCheckbox1" class="checker">
                                    <span>
                                    <input name="enabled" id="inlineCheckbox2" type="radio" value="1" <?php echo !$role_info['enabled']?'':'checked=checked';?>>
                                    </span>
                                    禁用
                                </div>
                            </label>
                        </div>
                    </div>
                    <div class="field-box">
                        <label>角色介绍:</label>
                        <div class="col-md-7">
                            <textarea class="form-control" rows="4" name="role_desc"><?php echo $role_info['role_desc'];?></textarea>
                        </div>
                    </div>
                    <div class="field-box">
                        <fieldset class="allowAccess" id="">
                            <legend> 可访问资源</legend>
                            <?php foreach($privileges as $k=>$v){ ?>
                                <div class="selectAll" >
                                    <input type = "checkbox"  class="check_all" name = "role_privileges[]" value ="<?php echo $k;?>" <?php echo in_array($k,$role_info['role_privileges'])?'checked=checked':'';?>/><?php echo $v['name'];?><br/>
                                    <?php if(isset($v['sub']) && !empty($v['sub'])){?>
                                        <div style="padding-left:30px;" class="check_one_div">
                                            <?php foreach($v['sub'] as $_k=>$_v){?>
                                                <input type="checkbox" name="role_privileges[]" class="check_one" value="<?php echo $_k;?>"  <?php echo in_array($_k,$role_info['role_privileges'])?'checked=checked':'';?>/><?php echo $_v;?>
                                            <?php }?>
                                        </div>
                                    <?php }?>
                                </div >
                            <?php }?>
                        </fieldset>
                    </div>
                    <div class="col-md-8 actions" >
                        <input type="button" class="btn-glow primary" value="修改" id="add_btn">
                    </div>
                    <input type="hidden" name="id" value="<?php echo $role_info['id'];?>"/>
                </form>
            </div>

        </div>
    </div>
</div>
<!-- end main container -->
<script>
    $('input.check_all').change(function(){
        $(this).parent('div.selectAll').find('input.check_one:checkbox').attr('checked',$(this).is(':checked'));

    });
    $('input.check_one').change(function(){
        if($(this).is(':checked')){
            $(this).parent('div.selectAll').find('input.check_all:checkbox').attr('checked',true);
        }
    });
    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        W.ajax({'data':data},'<?php echo site_url('role/edit');?>');
    });


</script>