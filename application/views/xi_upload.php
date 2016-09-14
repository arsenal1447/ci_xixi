    <div class="container top">
        <p class="text-center"><strong>西西美图图片发布规则</strong></p>
        <ul>
            <li>图片不能带有明显的水印</li>
            <li>务必选择你认为最正确的分类</li>
            <li>尽量填写相关的标题、描述、标签</li>
            <li>上传后请等待管理员审核</li>
        </ul>
        <div id="container">
            <div id="uploader">
                <div class="queueList">
                    <div id="dndArea" class="placeholder">
                        <div id="filePicker"></div>
                        <p>或将照片拖到这里，单次最多可选300张</p>
                    </div>
                </div>
                <div class="statusBar" style="display:none;">
                    <div class="progress">
                        <span class="text">0%</span>
                        <span class="percentage"></span>
                    </div><div class="info"></div>
                    <div class="btns">
                        <div id="filePicker2"></div><div class="uploadBtn">开始上传</div>
                    </div>
                </div>
            </div>
                <?php 
                    $attr = array('role' => 'form');
                    echo form_open('upload/release',$attr);
                ?>
                <div style="margin-top:50px;">
                    <?php
                    $query = $this->catalogue_model->cat_all();
                    foreach ($query as $value) {
                    ?>
                    <input type="radio" name="pictype" checked value="<?php echo $value['cat_another_name'] ?>"><span style="padding:0 5px;"><? echo $value['cat_name'] ?></span>
                    <?php } ?>
                </div>
                <input type="text" name="picname" class="form-control" style="margin-top:10px;" placeholder="名称：为了更好的检索图片，强烈建议填写此项">
                <input type="text" name="pictext" class="form-control" style="margin-top:10px;" placeholder="描述">
                <input type="text" name="pictag" class="form-control" style="margin-top:10px;" placeholder="标签：以空格分隔每个标签，也可以直接选择下面的热门标签">
                <div style="margin-top:10px;">
                <?php
                    $query = $this->tags_model->tags();
                    foreach ($query as $value) {
                ?>
                    <input type="checkbox" onClike="CheckBoxNum()" name="tags[]" value="<?php echo $value['tag_name'] ?>"><span style="padding:0 5px;"><? echo $value['tag_name'] ?></span>
                <?php } ?>
                </div>
                <button id="release" class="btn btn-lg btn-primary btn-block border disabled" style="margin-top:10px;" type="submit">发布</button>
            </form>
        </div>
    </div>
</div>
    <script src="<?php echo base_url('dist/js/webuploader.min.js') ?>"></script>
    <!--   <script src="http://cdn.bootcss.com/webuploader/0.1.1/webuploader.min.js"></script> -->
    <script src="<?php echo base_url('dist/js/upload.js') ?>"></script>
    <script>
    $(document).ready(function(){
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
            increaseArea: '20%'
        });
    });

    function CheckBoxNum() {
        //var num = $("input[type=checkbox][name=tags[][checked]").length;
        window.alert("11");
    }
    </script>