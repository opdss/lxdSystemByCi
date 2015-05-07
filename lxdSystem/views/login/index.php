<div class="login-wrapper">
    <a href="index.html">
        <img class="logo" src="source/img/logo-white.png">
    </a>

    <div class="box">
        <div class="content-wrap">
            <h6>Log in</h6>
            <form id="login_form">
                <input class="form-control" type="text" placeholder="E-mail address" name="username">
                <input class="form-control" type="password" placeholder="Your password" name="password">
            </form>
            <div class="remember">
                <input id="remember-me" type="checkbox">
                <label for="remember-me">Remember me</label>
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
                    location.href = '<?php echo site_url('index/index');?>';
                }else{
                    alert(msg.msg);
                }
            },
            'dataType' : 'json'
            //''
        });
    });
</script>