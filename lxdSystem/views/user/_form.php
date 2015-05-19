<form class="new_user_form" action="" method="post" id="new_user_form">

    <div class="field-box" style="width:800px;">
        <label style="width:84px;text-align: right; margin-right: 20px;">登录用户:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="username" style="width:300px;" placeholder="用户名（必填）" value="<?php echo isset($user_info['username'])?$user_info['username']:''?>"/>
        </div>
    </div>
    <?php if(!isset($user_info['pwd'])){?>
        <div class="field-box" style="width:800px;">
            <label style="width:84px;text-align: right; margin-right: 20px;">登录密码:</label>
            <div class="col-md-7">
                <input class="form-control" type="text" name="pwd" value="123456" style="width:300px;" placeholder="用户密码（必填）" maxlength="16"/>
            </div>
        </div>
    <?php }?>
    <div class="field-box" style="width:800px;">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员姓名:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="truename" style="width:300px;" placeholder="职员姓名（必填）" value="<?php echo isset($user_info['truename'])?$user_info['truename']:'';?>"/>
        </div>
    </div>
    <div class="field-box" style="width:800px;">
        <label style="width:84px;text-align: right; margin-right: 20px;">入职时间:</label>
        <div class="col-md-7">
            <input class="form-control input-datepicker1" type="text" name="begin_work_time" readonly="readonly" style="width:300px;cursor:pointer;color:black;" value="<?php echo isset($user_info['begin_work_time'])?date('d/m/Y', $user_info['begin_work_time']):'';?> <?php echo date('d/m/Y');?>"/>
        </div>
    </div>
    <div class="field-box" style="width:800px;">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员性别:</label>
        <div class="col-md-7" style="width:500px;">
            <label class="checkbox-inline">
                <div id="uniform-inlineCheckbox1" class="checker" style="width:300px;">
                    <input type="radio" name="sex" value='1' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 1?'checked':'';}?> checked="checked" style="cursor:pointer;"/>
                    男
                </div>
            </label>
            <label class="checkbox-inline">
                <div id="uniform-inlineCheckbox1" class="checker" style="width:300px;">
                    <input type="radio" name="sex" value='0' <?php if (isset($user_info['sex'])) {echo $user_info['sex'] == 0?'checked':'';}?> style="cursor:pointer;"/>
                    女
                </div>
            </label>
        </div>
    </div>
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">所属部门:</label>

        <div class="col-lg-8">
            <div class="ui-select" style="width:250px;">
                <select id="validate_select_dept" name="role_id">
                    <?php foreach ($dep_list as $k => $v):?>
                        <option value="<?php echo $v['id']?>"
                            <?php if(isset($user_info['dept_id']) && $v['id']==$user_info['dept_id']) {?>
                                selected="selected"
                            <?php }?>>
                            <?php echo str_repeat('　　',$v['level']-1).$v['dept_name'];?>
                        </option>
                    <?php endforeach;?>
                </select>
            </div>
        </div>
    </div>
    <div class="field-box">
        <div class="form-group">
            <label style="width:84px;text-align: right; margin-right: 20px;">所属角色:</label>
            <div class="col-lg-8">
                <div class="ui-select" style="width:250px;">
                    <select id="validate_select_role" name="role_id">
                        <?php foreach ($role_list as $k => $v):?>
                            <option value="<?php echo $v['id']?>"
                                <?php if (isset($user_info['role_id']) && $v['id']==$user_info['role_id']) {?>
                                    selected="selected"
                                <?php }?>>
                                <?php echo $v['role_name'];?>
                            </option>
                        <?php endforeach;?>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员年龄:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="age" style="width:300px;" placeholder="职员年龄（选填）" maxlength="3" onkeyup="value=value.replace(/[^\d]/g,'')" value="<?php echo isset($user_info['age'])?$user_info['age']:'';?>"/>
        </div>
    </div>
<!--    <div class="field-box">-->
<!--        <label>离职时间:</label>-->
<!--        <div class="col-md-7">-->
<!--            <input class="form-control input-datepicker2" type="text" name="end_work_time" value="--><?php //echo isset($user_info['end_work_time'])&&$user_info['end_work_time']!=0?date('m/d/Y', $user_info['end_work_time']):'';?><!--"/>-->
<!--            <span style="color:red" class="field_message"></span>-->
<!--        </div>-->
<!--    </div>-->
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">身份证号:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="idcard" style="width:300px;" placeholder="身份证（选填）" value="<?php echo isset($user_info['idcard'])?$user_info['idcard']:'';?>"/>
        </div>
    </div>
    <div class="field-box" style="width:800px;">
        <label style="width:84px;text-align: right; margin-right: 20px;">手机号码:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="mobile" style="width:300px;" placeholder="手机号（选填）" value="<?php echo isset($user_info['mobile'])?$user_info['mobile']:'';?>" maxlength="11" onkeyup="value=value.replace(/[^\d]/g,'')" />
        </div>
    </div>
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">详细地址:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="address" style="width:300px;" placeholder="职员住址（选填）" value="<?php echo isset($user_info['address'])?$user_info['address']:''?>"/>
        </div>
    </div>
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员QQ:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="qq" style="width:300px;" placeholder="QQ号（选填）" value="<?php echo isset($user_info['qq'])?$user_info['qq']:''?>"/>
        </div>
    </div>
    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员微信:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="weixin" style="width:300px;" placeholder="微信号（选填）" value="<?php echo isset($user_info['weixin'])?$user_info['weixin']:''?>"/>
        </div>
    </div>

    <div class="field-box">
        <label style="width:84px;text-align: right; margin-right: 20px;">职员生日:</label>
        <div class="col-md-7">
            <input class="form-control" type="text" name="bothday" style="width:300px;" placeholder="生日（选填）" value="<?php echo isset($user_info['bothday'])?$user_info['bothday']:'';?>"/>
        </div>
    </div>
    <div class="col-md-11 field-box actions" style="width:400px;">
        <input type="hidden" name="id" value="<?php if (isset($user_info['id'])) {echo $user_info['id'];}?>">
        <input type="button" class="btn-glow primary" value="提交" onclick="submitBtn('sava')" style="float:right;">
    </div>
</form>


<script src="<?php echo base_url('source/js/jquery.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('source/js/jquery.validate.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('source/js/jquery-form.js');?>"></script>
<script src="<?php echo base_url('source/js/bootstrap.datepicker.js');?>"></script>

<script type="text/javascript">
    $(function() {
       $('.form-control[name=username]').val(new Date().getTime());
    });

    $(".form-control").on('blur', function() {
        userValidate($(this));
    });

    //新增员工的校验
    function userValidate(obj) {
        var nameVal = obj.attr('name');
        var messages = {
            username : {
                required : '就用人家名称的拼音吧，怎么样？',
                imgAfterWord: '../../source/img/gif/17.gif'
            },
            truename : {
                imgBeforeWord: '../../source/img/gif/03.gif',
                required : ' 职员是一定会有名字滴...'
            },
            pwd : {
                imgBeforeWord: '../../source/img/gif/10.gif',
                required : '密码一定要帅气',
                outLength: {'length': [6,16], 'message': '密码长度要在6-16位之间'}
            }
        };
        myValidate(obj, messages);
    }

    //校验工具函数
    function myValidate(obj, msg) {
        //获取name属性的值
        var name = obj.attr('name');
        if (msg[name] == undefined) {
            return;
        }
        var value = obj.val();

        var imgBeforeWords = msg[name]['imgBeforeWord'];
        var required = msg[name]['required'];
        var imgAfterWord = msg[name]['imgAfterWord'];
        var outLength = msg[name]['outLength'];

        if (value == '') {
            //已经有了一个校验，删除之前的
            obj.siblings('span.alert-msg').remove();
            //拼一个节点
            //<span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden">
            //<img src="../../source/img/myimg_liuhan.png" style="width:20px;" /></span>
            var spanNode = '<span class="alert-msg" style="color:red;font-weight:700;width:600px;float:right;margin-top:5px;">';
            //输入文本信息之前放张图片
            if (imgBeforeWords != undefined) {
                spanNode += '<img src="'+ imgBeforeWords +'" style="width:50px;" />';
            }
            //文本信息
            if (required!=undefined ) {
                spanNode += required;
            }
            //输入文本信息之后放张图片
            if (imgAfterWord != undefined) {
                spanNode += '<img src="'+ imgAfterWord +'" style="width:50px;" />';
            }
            spanNode += '</span>';
        } else if (outLength != undefined) {
            //字符个数校验
            if (outLength['length'][0]>value.length || outLength['length'][1]<value.length) {
                //已经有了一个校验，删除之前的
                obj.siblings('span.alert-msg').remove();
                //拼一个节点
                //<span class="alert-msg validate_is_num" style="color:red;font-weight:700;" hidden="hidden">
                //<img src="../../source/img/myimg_liuhan.png" style="width:20px;" /></span>
                var spanNode = '<span class="alert-msg" style="color:red;font-weight:700;width:600px;float:right;margin-top:5px;">';
                //输入文本信息之前放张图片
                if (imgBeforeWords != undefined) {
                    spanNode += '<img src="'+ imgBeforeWords +'" style="width:50px;" />';
                }
                //文本信息
                if (required!=undefined ) {
                    spanNode += outLength['message'];
                }
                //输入文本信息之后放张图片
                if (imgAfterWord != undefined) {
                    spanNode += '<img src="'+ imgAfterWord +'" style="width:50px;" />';
                }
                spanNode += '</span>';
            } else {
                obj.siblings('span.alert-msg').remove();
            }
        } else {
            obj.siblings('span.alert-msg').remove();
        }

        obj.after(spanNode);
    }

    //根据这个来判断是否校验成功
    function isSuccess() {
        $(".form-control").each(function(index, item) {
            userValidate($(item));
        });
        if ($("span.alert-msg").size() == 0) {
            return true;
        } else {
            return false;
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
//    $('.input-datepicker2').datepicker().on('changeDate', function (ev) {
//        $(this).datepicker('hide');
//    });

</script>