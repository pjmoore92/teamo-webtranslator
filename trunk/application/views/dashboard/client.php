    <div class="sidebar">
        <div class="well">
          <h5>Menu</h5>
          <ul>
            <li><a href="submit-new-job.html">Submit new job</a></li>
            <li><a href="quotes.html">Quotes</a></li>
            <li><a href="translations.html">Translations</a></li>
            <li><a href="history.html">History</a></li>
          </ul>
          <h5>Other</h5>
          <ul>
            <li><a href="../../index.html">Logout</a></li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="page-header">
          <h1>Client dashboard <small>Supporting text or tagline</small></h1>
          <h2>Hello, <?php echo $name; ?>!</h2>

          <!--<div class="alert-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p><strong>Update:</strong> Joelle has sent you the quote for Docname3. Please review it!</p>
          </div>-->

          <div class="alert-message block-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p>
              <strong>Update:</strong> Joelle has sent you a quote for <strong>Docname2</strong>:
              It will cost &pound;50 and it will be ready on the <time>2011-09-17</time>.
            </p>
            <div class="alert-actions">
              <a class="btn small success" href="#">I accept!</a>
              <a class="btn small danger" href="#">No, thanks!</a>
            </div>
          </div>

        </div>
        <div class="row">
        <div class="span16">
          <table class="zebra-striped" id="sortTableExample">
            <thead>
              <tr>
                <th class="header headerSortDown">#</th>
                <th class="header">Document Name</th>
                <th class="blue header">Status</th>
                <th class="blue header">Language (to &amp; from)</th>
                <th class="blue header">Submitted on</th>
                <th class="blue header"><abbr title="Estimated time of arrival">ETA</abbr></th>
                <th class="blue header">Quote</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td>Docname</td>
                <td>Client has accepted, waiting for translation</td>
                <td>English to French</td>
                <td><time>2011-09-01</time></td>
                <td><time>2011-09-15</time></td>
                <td>Â£100</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Docname2</td>
                <td>Quote sent, waiting for client answer</td>
                <td>French to English</td>
                <td><time>2011-09-01</time></td>
                <td><time>2011-09-17</time></td>
                <td>Â£70</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Docname3</td>
                <td>Waiting for quote</td>
                <td>Italian to English</td>
                <td><time>2011-09-05</time></td>
                <td><time>2011-09-07</time></td>
                <td>Â£50</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Docname4</td>
                <td>Waiting for quote</td>
                <td>French to English</td>
                <td><time>2011-09-05</time></td>
                <td><time>2011-09-07</time></td>
                <td>Â£50</td>
              </tr>
            </tbody>
          </table>
      
        </div>
      </div>