<form class="new_user_form" action="" method="post" id="new_user_form">

    <div class="field-box">
        <label>用户名:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="username" value="<?php echo isset($user_info['username'])?$user_info['username']:''?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>真实名:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="truename" value="<?php echo isset($user_info['truename'])?$user_info['truename']:'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <?php if(!isset($user_info['pwd'])){?>
    <div class="field-box">
        <label>密码:</label>
        <div class="col-md-7">
            <input class="form-control" type="password" name="pwd"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <?php }?>
    <div class="field-box">
        <label>性别:</label>
        <div class="col-md-7">
            <label class="checkbox-inline">
                <div id="uniform-inlineCheckbox1" class="checker">
                    <span>
                    <input type="radio" name="sex" value='1' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 1?'checked':'';}?>/>
                    </span>
                    男
                </div>
            </label>
            <label class="checkbox-inline">
                <div id="uniform-inlineCheckbox1" class="checker">
                    <span>
                    <input type="radio" name="sex" value='0' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 0?'checked':'';}?>/>
                    </span>
                    女
                </div>
            </label>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>年龄:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="age" value="<?php echo isset($user_info['age'])?$user_info['age']:'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>所属部门:</label>
        <div class="col-md-7">
            <select name="dept_id">
                <option value="">--请选择--</option>
                <?php foreach ($dep_list as $k => $v):?>
                    <option value="<?php echo $v['id']?>"
                        <?php if(isset($user_info['dept_id']) && $v['id']==$user_info['dept_id']) {?>
                            selected="selected"
                        <?php }?>>
                        <?php echo str_repeat('　　',$v['level']-1).$v['dept_name'];?>
                    </option>
                <?php endforeach;?>
            </select>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>入职时间:</label>
        <div class="col-md-7">
            <input class="form-control input-datepicker1" type="text" name="begin_work_time" value="<?php echo isset($user_info['begin_work_time'])?date('m/d/Y', $user_info['begin_work_time']):'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>离职时间:</label>
        <div class="col-md-7">
            <input class="form-control input-datepicker2" type="text" name="end_work_time" value="<?php echo isset($user_info['end_work_time'])&&$user_info['end_work_time']!=0?date('m/d/Y', $user_info['end_work_time']):'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>身份证:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="idcard" value="<?php echo isset($user_info['idcard'])?$user_info['idcard']:'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>手机号:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="mobile" value="<?php echo isset($user_info['mobile'])?$user_info['mobile']:'';?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>地址:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="address" value="<?php echo isset($user_info['address'])?$user_info['address']:''?>"/>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>
    <div class="field-box">
        <label>qq:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="qq" value="<?php echo isset($user_info['qq'])?$user_info['qq']:''?>"/>
        </div>
    </div>
    <div class="field-box">
        <label>微信:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="weixin" value="<?php echo isset($user_info['weixin'])?$user_info['weixin']:''?>"/>
        </div>
    </div>

    <div class="field-box">
        <label>生日:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="bothday" value="<?php echo isset($user_info['bothday'])?$user_info['bothday']:'';?>"/>
        </div>
    </div>
    <div class="field-box">
        <label>所属角色:</label>
        <div class="col-md-7">
            <select name="role_id">
                <option value="">--请选择--</option>
                <?php foreach ($role_list as $k => $v):?>
                <option value="<?php echo $v['id']?>"
                    <?php if (isset($user_info['role_id']) && $v['id']==$user_info['role_id']) {?>
                        selected="selected"
                    <?php }?>>
                    <?php echo $v['role_name'];?>
                </option>
                <?php endforeach;?>
            </select>
            <span style="color:red" class="field_message"></span>
        </div>
    </div>

    <div class="col-md-11 field-box actions">
        <input type="hidden" name="id" value="<?php if (isset($user_info['id'])) {echo $user_info['id'];}?>">
        <input type="button" class="btn-glow primary" value="Create user" onclick="submitBtn('sava')">
        <span>OR</span>
        <input type="reset" value="Cancel" class="reset">
    </div>
</form>


<script src="<?php echo base_url('source/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('source/js/jquery.validate.js');?>"></script>
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
                    required : true,
                    ismobile : true
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