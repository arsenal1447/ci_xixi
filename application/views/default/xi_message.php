  <div class="container top">
    <br /><br /><br /><br /><br /><br />
    <div class="alert alert-info border"><?php echo $message ?><span style="color:red;" id='timer'>3</span>&nbsp;秒后将自动跳转到<?php echo $where ?>。</div>
  </div>
  <script type='text/javascript'>
  var second = 3;
  var show = document.getElementById('timer');
  setInterval(
    function(){
      show.innerHTML = second - 1;
      second--;
      if( second <= 0 ){
        window.location.href = '<?php echo $url ?>';
      }
    },1000);
  </script>
</div>
