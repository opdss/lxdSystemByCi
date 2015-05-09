<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

<div id="pad-wrapper" class="form-page">
    <div class="row header">
        <div class="col-md-12">
            <h3>添加角色</h3>
        </div>
    </div>
    <div class="row form-wrapper">
    <!-- left column -->
    <div class="col-md-8 column">
        <form>
            <div class="field-box">
                <label>角色名称:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="role_name"/>
                </div>
            </div>
            <div class="field-box">
                <label>角色介绍:</label>
                <div class="col-md-7">
                    <textarea class="form-control" rows="4" name="role_desc"></textarea>
                </div>
            </div>
            <div class="field-box">
                <fieldset class="allowAccess" id="">
                    <legend> 可访问资源</legend>
                    <?php foreach($privileges as $k=>$v){ ?>
                    <div class="selectAll" >
                        <input type = "checkbox"  class="check_all" name = "privileges[]" value ="<?php echo $k;?>" /><?php echo $v['name'];?><br/>
                        <?php if(isset($v['sub']) && !empty($v['sub'])){?>
                        <div style="padding-left:30px;" class="check_one_div">
                            <?php foreach($v['sub'] as $_k=>$_v){?>
                            <input type="checkbox" name="privileges[]" class="check_one" value="<?php echo $_k;?>" /><?php echo $_v;?>
                            <?php }?>
                        </div>
                        <?php }?>
                    </div >
                    <?php }?>
                </fieldset>
            </div>
            <div class="col-md-8 actions">
                <input type="button" class="btn-glow primary" value="添加" id="add_btn">
            </div>
        </form>
    </div>

    </div>
</div>
</div>
<!-- end main container -->
<script>
    $('input.check_all').change(function(){
        if($(this).is(':checked')){
            $(this).parent('div.selectAll').find('input.check_one').attr('checked',true);
        }else{
            $(this).parent('div.selectAll').find('input.check_one').attr('checked',false);
        }
    });
    $('input.check_one').change(function(){
        if($(this).is(':checked')){
            $(this).parent('div.selectAll').find('input.check_all').attr('checked',true);
        }
    });
    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('role/add');?>',
            'data' : {'data':data},
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('role/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    });


</script>