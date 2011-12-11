<?php if ( ! defined('BASEPATH')) exit('Access denied'); ?>

<!-- TODO horizontal sliding Ads a la BBC? -->
<div class="hero-unit">
<h1>Hello, world!</h1>
<p>Vestibulum id ligula porta felis euismod semper. Integer posuere erat
a ante venenatis dapibus posuere velit aliquet. Duis mollis, est non
commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec
elit.</p>
<p><a class="btn primary large">Learn more &raquo;</a></p>
</div>

<!--<form>-->
<!-- Example row of columns -->
<div class="row">
  <div class="span-one-third" style="text-align:center">
    <h2>Input your info</h2>
    <!--<p>Etiam porta sem malesuada magna mollis euismod. Integer posuere erat a ante venenatis dapibus posuere velit aliquet.</p>-->
    <p>
    <form>
      <label for="xlInput">Your name</label>
      <div class="input">
        <input class="xlarge span3" id="xlInput" name="xlInput" size="30" type="text" />
      </div>
        
      <label for="xlInput2">Your e-mail</label>
      <div class="input">
        <input class="xlarge span3" id="xlInput2" name="xlInput2" size="30" type="text" />
      </div>
    </form>
    </p>
  </div>
  <div class="span-one-third" style="text-align:center">
    <h2>Upload your docs</h2>
     <!--<p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>-->
     <p>
     <form>
        <label for="language-from">Source language</label>
        <div class="input">
          <select class="medium" name="language-from" id="language-from-select">
            <option>English</option>
            <option>French</option>
            <option>Italian</option>
          </select>
        </div>

      </p>
      <p>
          <label for="documents-upload">Documents</label>
          <div class="input">
          <input class="input-file" id="documents-upload" name="documents-upload" type="file">
          <!--<input class="input-file" id="fileInput2" name="fileInput" type="file">
          <input class="input-file" id="fileInput3" name="fileInput" type="file">-->
          </div>
      </form>
     </p>
 </div>
  <div class="span-one-third" style="text-align:center">
    <h2>Set requirements</h2>
    <!--<p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper.</p>-->
    <p>
    <form>
      <label for="language-to">Language</label>
        <div class="input">
          <select class="medium" name="language-to" id="language-to-select">
            <option>English</option>
            <option>French</option>
            <option>Italian</option>
          </select>
        </div>

        <label for="currency">Currency</label>
        <div class="input">
          <select class="medium" name="currency" id="currency-select">
            <option>GBP &pound;</option>
            <option>EUR &euro;</option>
          </select>
        </div>
    </form>
    </p>
  </div>
</div>
<br />
<br />
<br />
<div class="row">
  <div class="span-one-third">&nbsp;</div>
  <div class="span-one-third" style="text-align:center">
    <p><a class="btn" href="#">Get your quote! &raquo;</a></p>
    <input type="submit" class="btn primary" value="Get your quote!">
  </div>
  <div class="span-one-third">&nbsp;</div>
  <!--<div class="span-one-third">Quote</div>-->
</div>
<!-- </form> -->

