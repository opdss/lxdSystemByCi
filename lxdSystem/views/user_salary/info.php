<!-- main container -->
<div class="content">

    <div id="pad-wrapper" class="new-user">
        <div class="row header">
            <div class="col-md-12">
                <h3>工资详情单</h3>
            </div>
        </div>

        <div class="row form-wrapper">
            <!-- left column -->
            <div class="col-md-12">
                <div class="container">
                    <form class="new_user_form">
                        <div class="col-md-4 field-box">
                            <label>姓名:</label>
                            <span><?php echo $salary_info['truename'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>月份:</label>
                            <span><?php echo $salary_info['work_month'];?></span>
                        </div>
                        <div class="col-md-12 field-box">
                            <label>订单工序详情:</label>
                            <?php
                            $salary = 0;

                            foreach($salary_info as $v):
                                if(is_array($v)){
                            ?>
                            <div class="col-md-10 copy_process_div">
                                <div class="order_list_div">
                                    <span><?php echo $v[0]['order_name'];?></span>
                                    <div class="process_list_div">
                                        <?php
                                        $i = 0;
                                        foreach($v as $k=>$process) {
                                            if ($process['process_num'] > 0) {
                                                ?>
                                                <div class="clone_process_div">
                                                    <span style="font-size: 14px;margin-right: 20px;">NO.<?php echo $i + 1;?>:</span>
                                                    <span>工序名称:  <?php echo $process['process_name'];?></span>
                                                    <span>工序数量:  <?php echo $process['process_num'];?></span>
                                                    <span>工序价格:  <?php echo $process['process_price'];?></span>
                                                    <span>小计:  <?php echo $process['process_price'] * $process['process_num'];?></span>
                                                </div>
                                                <?php
                                                $salary += $process['process_price'] * $process['process_num'];
                                                $i++;
                                            }
                                        }

                                       ?>
                                    </div>
                                </div>

                            </div>
                            <?php
                                }
                            endforeach;?>

                        </div>

                        <div class="col-md-12 field-box">
                            <label>应发放薪资:</label>
                            <span><?php echo $salary;?></span>
                        </div>


                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="col-md-11 field-box actions">
        <input type="button" class="btn-glow primary" onclick="$('#pad-wrapper').jqprint();" value="打印详情单">
    </div>
</div>
<!-- end main container -->

<style type="text/css">
    .clone_process_div span{
        margin-left: 30px;
    }

</style>
