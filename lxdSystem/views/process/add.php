<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

<div id="pad-wrapper" class="form-page">
    <div class="row header">
        <div class="col-md-12">
            <h3>添加订单</h3>
        </div>
    </div>
    <div class="row form-wrapper">
    <!-- left column -->
    <div class="col-md-8 column">
        <form>

            <div class="col-md-12 field-box">
                <label>所属订单:</label>
                <select name="order_id">
                    <option value="">--请选择--</option>
<?php foreach ($list as $k => $v):?>
                    <option value="<?php echo $v['id']?>"><?php echo $v['order_name'];?></option>
<?php endforeach;?>
                </select>
                <span style="color:red" class="field_message"></span>
            </div>
            <div class="field-box">
                <label>工序名称:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="process_name"/>
                </div>
            </div>
            <div class="field-box">
                <label>工序价格:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="process_price"/>
                </div>
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

    $('#add_btn').click(function(){
        var data = $(this).parents('form').serialize();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('process/add');?>',
            'data' : {'data':data},
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('process/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    });


</script>