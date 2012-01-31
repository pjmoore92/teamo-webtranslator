        <div class="page-header">
          <h1>Client dashboard <small>Quotes</small></h1>
          <h2>Hello, <?php echo $client_name; ?>!</h2>

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
          <?php
              if($quoted_jobs_list == NULL):
                echo ':( You have no quoted jobs.';
              else:
          ?>
          <table class="zebra-striped" id="sortTableExample">
            <thead>
              <tr>
                <th class="header headerSortDown">#</th>
                <th class="header">Date requested</th>
                <th class="header">Date due</th>
                <th class="blue header">From language</th>
                <th class="blue header">To language</th>
              </tr>
            </thead>
            <?php foreach($quoted_jobs_list as $job): ?>
            <tr>
              <td><?php echo $job->jobID; ?></td>
              <td><?php echo $job->dateRequested; ?></td>
              <td><?php echo $job->dateDue; ?></td>
              <td><?php echo $job->fromLanguage; ?></td>
              <td><?php echo $job->toLanguage; ?></td>
            </tr>
            <?php endforeach; ?>
          </table>
          <?php endif; ?>
        </div>