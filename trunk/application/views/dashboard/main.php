        <div class="page-header">
          <h1><?php echo ucfirst($role); ?> Dashboard <small>Main Dashboard</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>

          <!--<div class="alert-message warning fade in" data-alert="alert" >
            <a class="close" href="#">&times;</a>
            <p><strong>Update:</strong> Joelle has sent you the quote for Docname3. Please review it!</p>
          </div>-->


        </div>
        <div class="row">
        <div class="span10">
          <table class="table table-bordered table-striped" id="sortTableExample">
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
                <td>£100</td>
              </tr>
              <tr>
                <td>2</td>
                <td>Docname2</td>
                <td>Quote sent, waiting for client answer</td>
                <td>French to English</td>
                <td><time>2011-09-01</time></td>
                <td><time>2011-09-17</time></td>
                <td>£70</td>
              </tr>
              <tr>
                <td>3</td>
                <td>Docname3</td>
                <td>Waiting for quote</td>
                <td>Italian to English</td>
                <td><time>2011-09-05</time></td>
                <td><time>2011-09-07</time></td>
                <td>£50</td>
              </tr>
              <tr>
                <td>4</td>
                <td>Docname4</td>
                <td>Waiting for quote</td>
                <td>French to English</td>
                <td><time>2011-09-05</time></td>
                <td><time>2011-09-07</time></td>
                <td>£50</td>
              </tr>
            </tbody>
          </table>
      
        </div>
