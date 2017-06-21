<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
  <div>
    <input class="searchinput" type="text" onfocus="if (this.value == 'Search') {this.value = '';}" onblur="if (this.value == '') {this.value = '';}"  value=" " name="s" id="s" />
    <input class="searchsubmit" type="submit" id="searchsubmit" value="" />
  </div>
</form>
<div class="clear"></div>
<br/>
