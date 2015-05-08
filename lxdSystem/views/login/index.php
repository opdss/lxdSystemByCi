<div class="login-wrapper">
    <a href="#">
        <img class="logo" src="<?php echo base_url('source/img/logo-white.png');?>">
    </a>

    <div class="box">
        <div class="content-wrap">
            <h6>登录</h6>
            <form id="login_form">
                <input class="form-control" type="text" placeholder="请输入你的用户名" name="username">
                <input class="form-control" type="password" placeholder="请输入你的密码" name="password">
            </form>
            <div class="remember">
            </div>
            <a class="btn-glow primary login" href="javascript:void(0)">登录</a>
        </div>
    </div>
</div>
<script>
    $('a.login').click(function(){
        var data = $('#login_form').serialize();
        $.ajax({
            'type':'post',
            'url' : '<?php echo site_url('login/checkAuth');?>',
            'data' : data,
            'success' : function(msg){
                if(msg.code==1){
                    location.href = '<?php echo site_url('Welcome/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
            //''
        });
    });
</script>