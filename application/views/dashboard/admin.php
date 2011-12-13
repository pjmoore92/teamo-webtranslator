      <div class="sidebar">
        <div class="well">
          <h5>Menu</h5>
          <ul>
            <li><a href="index.html">Home</a></li>
            <li><a href="pending-quotes.html">Pending quotes</a></li>
            <li><a href="pending-jobs.html">Pending jobs</a></li>
            <li><a href="accepted-jobs.html">Accepted jobs</a></li>
            <li><a href="translations.html">Translations</a></li>
            <li><a href="completed.html">Completed</a></li>
          </ul>
          <h5>Other</h5>
          <ul>
            <li><a href="send-newsletter.html">Send newsletter</a></li>
            <li><a href="../../index.html">Logout</a></li>
          </ul>
        </div>
      </div>

      <div class="content">
        <div class="page-header">
          <h1>Admin dashboard <small>Supporting text or tagline</small></h1>

          <!--<div class="alert-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p><strong>Update:</strong> Joelle has sent you the quote for Docname3. Please review it!</p>
          </div>-->

          <div class="alert-message block-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <h4>New job waiting</h4>
            <p>
              John Doe is waiting for a quote for <strong>Docname2</strong>.
              The title is <em>Insert title here</em> and it is
              <strong>1000</strong> words long.
            </p>
            <br />
            <div class="alert-actions">
              <a class="btn small" href="#">Review the document</a>
            </div>
          </div>
          
          <div class="alert-message block-message success fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <h4>Job accepted!</h4>
            <p>
              John Doe has accepted the quote for <strong>Docname2</strong>.
              It should be ready on <strong><time>2011-09-15</time></strong>.
            </p>
          </div>
        </div><!-- end .page-header -->

        <div class="row">
          <div class="span16">
          <h2>Requiring a quote</h2>
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
                  <td>Paid for, waiting for translation</td>
                  <td>English to French</td>
                  <td><time>2011-09-01</time></td>
                  <td><time>2011-09-15</time></td>
                  <td>Â£100</td>
                </tr><tr>
                  <td>2</td>
                  <td>Docname2</td>
                  <td>Quote sent, waiting for client answer</td>
                  <td>French to English</td>
                  <td><time>2011-09-01</time></td>
                  <td><time>2011-09-17</time></td>
                  <td>Â£70</td>
                </tr><tr>
                  <td>3</td>
                  <td>Docname3</td>
                  <td>Waiting for quote</td>
                  <td>Italian to English</td>
                  <td><time>2011-09-05</time></td>
                  <td><time>2011-09-07</time></td>
                  <td>Â£50</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div><!-- end .row -->

        <div class="row">
          <h2>Pending a translation</h2>
          <table class="zebra-striped" id="sortTableExample2">
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
                <td>Paid for, waiting for translation</td>
                <td>English to French</td>
                <td><time>2011-09-01</time></td>
                <td><time>2011-09-15</time></td>
                <td>Â£100</td>
              </tr><tr>
                <td>2</td>
                <td>Docname2</td>
                <td>Quote sent, waiting for client answer</td>
                <td>French to English</td>
                <td><time>2011-09-01</time></td>
                <td><time>2011-09-17</time></td>
                <td>Â£70</td>
              </tr><tr>
                <td>3</td>
                <td>Docname3</td>
                <td>Waiting for quote</td>
                <td>Italian to English</td>
                <td><time>2011-09-05</time></td>
                <td><time>2011-09-07</time></td>
                <td>Â£50</td>
              </tr>
            </tbody>
          </table>

        </div><!-- end .row -->
      </div><!-- end .content -->