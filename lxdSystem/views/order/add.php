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
            <div class="field-box">
                <label>订单名称:</label>
                <div class="col-md-7">
                    <input class="form-control" type="text" name="order_name"/>
                </div>
            </div>
            <div class="field-box">
                <label>订单介绍:</label>
                <div class="col-md-7">
                    <textarea class="form-control" rows="4" name="order_desc"></textarea>
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
            'url' : '<?php echo site_url('order/add');?>',
            'data' : {'data':data},
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('order/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
        });
    });


</script>