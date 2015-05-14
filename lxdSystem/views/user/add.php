<!-- main container -->
    <div class="content">

        <!-- settings changer -->
        <div class="skins-nav">
            <a href="#" class="skin first_nav selected">
                <span class="icon"></span><span class="text">Default</span>
            </a>
            <a href="#" class="skin second_nav" data-file="css/compiled/skins/dark.css">
                <span class="icon"></span><span class="text">Dark skin</span>
            </a>
        </div>

        <div id="pad-wrapper" class="new-user">
            <div class="row header">
                <div class="col-md-12">
                    <h3>Create a new user</h3>
                </div>
            </div>

            <div class="row form-wrapper">
                <!-- left column -->
                <div class="col-md-9 with-sidebar">
                    <div class="container">
                        <form class="new_user_form" action="" method="post" id="new_user_form">
                            <div class="col-md-12 field-box">
                                <label>userName:</label>
                                <input class="form-control" type="text" name="username" value="<?php echo isset($user_info['username'])?$user_info['username']:''?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>realName:</label>
                                <input class="form-control" type="text" name="truename" value="<?php echo isset($user_info['truename'])?$user_info['truename']:'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>password:</label>
                                <input class="form-control" type="password" name="pwd" value="<?php echo isset($user_info['pwd'])?$user_info['pwd']:'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>sex:</label>
                                <input type="radio" name="sex" value='1' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 1?'checked':'';
}
?>/>男
                                <input type="radio" name="sex" value='0' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 0?'checked':'';
}
?>/>女
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>age:</label>
                                <input class="form-control" type="text" name="age" value="<?php echo isset($user_info['age'])?$user_info['age']:'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>department:</label>
                                <select name="dept_id">
                                    <option value="">--请选择--</option>
<?php foreach ($dep_list as $k => $v):?>
                                    <option value="<?php echo $v['id']?>" <?php if (isset($user_info['dept_id'])) {echo $v['id'] == $user_info['dept_id']?'checked':'';}?>><?php echo $v['dept_name'];
?></option>
<?php endforeach;?>
</select>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>begin_work_time:</label>
                                <input class="form-control input-datepicker1" type="text" name="begin_work_time" value="<?php echo isset($user_info['begin_work_time'])?date('d/m/Y', $user_info['begin_work_time']):'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>end_work_time:</label>
                                <input class="form-control input-datepicker2" type="text" name="end_work_time" value="<?php echo isset($user_info['end_work_time'])?date('d/m/Y', $user_info['end_work_time']):'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>idcard:</label>
                                <input class="form-control" type="text" name="idcard" value="<?php echo isset($user_info['idcard'])?$user_info['idcard']:'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>mobile:</label>
                                <input class="form-control" type="text" name="mobile" value="<?php echo isset($user_info['mobile'])?$user_info['mobile']:'';?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>address:</label>
                                <input class="form-control" type="text" name="address" value="<?php echo isset($user_info['address'])?$user_info['address']:''?>"/>
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>qq:</label>
                                <input class="form-control" type="text" name="qq" value="<?php echo isset($user_info['qq'])?$user_info['qq']:''?>"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>weixin:</label>
                                <input class="form-control" type="text" name="weixin" value="<?php echo isset($user_info['weixin'])?$user_info['weixin']:''?>"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>isdel:</label>
                                <input type="radio" name="isdel" value='1' <?php if (isset($user_info['isdel'])) {echo $user_info['isdel'] == 1?'checked':'';
}
?>/>在职
                                <input type="radio" name="isdel" value='0' <?php if (isset($user_info['isdel'])) {echo $user_info['isdel'] == 1?'checked':'';
}
?>/>离职
                                <span style="color:red" class="field_message"></span>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>bothday:</label>
                                <input class="form-control" type="text" name="bothday" value="<?php echo isset($user_info['bothday'])?$user_info['bothday']:'';?>"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>所属角色:</label>

<?php foreach ($role_list as $k => $v):?>
                                        <input type="checkbox" name="role_id[]" value="<?php echo $v['id']?>" <?php if (isset($user_info['role_id'])) {echo in_array($v['id'], $user_info['role_id'])?'checked':'';}?>><?php echo $v['role_name'];
?>
<?php endforeach;?>
                                    <span style="color:red" class="field_message"></span>
                            </div>

                            <div class="col-md-11 field-box actions">
                            <input type="hidden" name="id" value="<?php if (isset($user_info['id'])) {echo $user_info['id'];}?>">
	                                <input type="button" class="btn-glow primary" value="Create user" onclick="submitBtn('sava')">
	                                <span>OR</span>
	                                <input type="reset" value="Cancel" class="reset">
	                            </div>
	                        </form>
	                    </div>
	                </div>


	            </div>
	        </div>
	    </div>
	    <!-- end main container -->
	<script type="text/javascript" src="<?php echo base_url('source/js/jquery.validate.js');
?>"></script>
<script type="text/javascript" src="<?php echo base_url('source/js/jquery-form.js');?>"></script>
<script src="<?php echo base_url('source/js/bootstrap.datepicker.js');?>"></script>
<script type="text/javascript">

function JqValidate(){
    return $('#new_user_form').validate({
            errorPlacement: function(error, element){
                var _message_box = $(element).parent().find('.field_message');
                _message_box.append(error);
                //document.getElementById(element.context.id).scrollIntoView()
            },
            showErrors: function (errorMap, errorArr) {
                this.defaultShowErrors();
                if(errorArr!=""){
                    $(errorArr[0].element).focus();

                }
            },
            rules : {
                    username : {
                            required : true
                    },
                    truename : {
                            required :true
                    },
                    pwd : {
                            required : true,
                            rangelength:[6,18]
                    },
                    sex : {
                            required : true,
                            number : true
                    },
                    age : {
                            required : true,
                            number : true
                    },
                    dept_id:{
                            required : true,
                            number : true
                    },
                    begin_work_time : {
                            required : true,
                            date : true
                    },
                    mobile:{
                            required : true
                    },
                    isdel:{
                            required:true
                    },
                    role_id:{
                            required:true
                    }
            },
            messages : {
                    username : {
                            required : '请填写用户名'
                    },
                    truename : {
                            required : '请填写真实姓名'
                    },
                    pwd : {
                            required : '请填写密码',
                            rangelength : '长度为6-18字符'
                    },
                    sex : {
                            required : '请选择性别',
                            number : '数字类型'
                    },
                    age : {
                            required : '请输入年龄',
                            number : '数字类型'
                    },
                    dept_id : {
                            required  : '请选择部门',
                            number : '数字类型'
                    },
                    begin_work_time:{
                            required : '请填写入职时间',
                            date : '日期格式不正确'
                    },
                    mobile:{
                            required : '请填写手机号'
                    },
                    isdel:{
                            required : '请选择是否在职'
                    },
                    role_id:{
                            required : '请选择所属角色'
                    }
            }
    }).form();
}

function submitBtn(type){

    if(JqValidate()){
        var options = {
            url: '<?php echo site_url('user/add');?>',
            success : apply_callback,
            dataType : 'json'
        };
        $("#new_user_form").ajaxSubmit(options);
    }
}

function apply_callback(msg){
    if(msg.code==1){
        location.href = '<?php echo site_url('user/index');?>';
    }else{
        alert(msg.msg);
    }
}

// datepicker plugin
$('.input-datepicker1').datepicker().on('changeDate', function (ev) {
    $(this).datepicker('hide');
});
$('.input-datepicker2').datepicker().on('changeDate', function (ev) {
    $(this).datepicker('hide');
});

</script>
