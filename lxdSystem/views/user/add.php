<link media="screen" type="text/css" href="<?php echo base_url('source/css/compiled/new-user.css');?>" rel="stylesheet">
<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="form-page">
        <div class="row header">
            <div class="col-md-12">
                <h3>添加员工</h3>
            </div>
        </div>
        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-8 column">
                <?php $this->load->view('user/_form');?>
            </div>

        </div>
    </div>
</div>
<!-- end main container -->

<script type="text/javascript">
    function submitBtn(type){
        if(isSuccess()){
            var options = {
                url: '<?php echo site_url('user/add');?>',
                success : apply_callback,
                dataType : 'json'
            };
            $("#new_user_form").ajaxSubmit(options);
        }
    }

</script>


