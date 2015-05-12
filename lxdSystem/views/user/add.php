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
                        <form class="new_user_form" action="" method="post">
                            <div class="col-md-12 field-box">
                                <label>userName:</label>
                                <input class="form-control" type="text" name="username"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>realName:</label>
                                <input class="form-control" type="text" name="truename"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>password:</label>
                                <input class="form-control" type="password" name="pwd"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>sex:</label>
                                <input type="radio" name="sex" value='1'/>男
                                <input type="radio" name="sex" value='0'/>女
                            </div>
                            <div class="col-md-12 field-box">
                                <label>department:</label>
                                <select name="dept_id">
                                    <option value="-1">--请选择--</option>
<?php foreach ($dep_list as $k => $v):?>
                                    <option value="<?php echo $v['id']?>"><?php echo $v['dept_name'];?></option>
<?php endforeach;?>
</select>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>begin_work_time:</label>
                                <input class="form-control" type="text" name="begin_work_time"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>end_work_time:</label>
                                <input class="form-control" type="text" name="end_work_time"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>idcard:</label>
                                <input class="form-control" type="text" name="idcard"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>mobile:</label>
                                <input class="form-control" type="text" name="mobile"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>address:</label>
                                <input class="form-control" type="text" name="address"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>qq:</label>
                                <input class="form-control" type="text" name="qq"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>weixin:</label>
                                <input class="form-control" type="text" name="weixin"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>isdel:</label>
                                <input type="radio" name="isdel" value='1'/>在职
                                <input type="radio" name="isdel" value='0'/>离职
                            </div>
                            <div class="col-md-12 field-box">
                                <label>bothday:</label>
                                <input class="form-control" type="text" name="bothday"/>
                            </div>
                            <div class="col-md-12 field-box">
                                <label>所属角色:</label>

                                    <select name="role_id">
                                        <option value="-1">--请选择--</option>
<?php foreach ($role_list as $k => $v):?>
                                        <option value="<?php echo $v['id']?>"><?php echo $v['role_name'];?></option>
<?php endforeach;?>
</select>

                            </div>

                            <div class="col-md-11 field-box actions">
                                <input type="button" class="btn-glow primary" value="Create user">
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
