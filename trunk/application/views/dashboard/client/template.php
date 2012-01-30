    <div class="sidebar">
        <div class="well">
          <h5>Menu</h5>
          <ul>
            <li><?php echo anchor('dashboard/client/submit', 'Submit new job'); ?></li>
            <li><?php echo anchor('dashboard/client/pending', 'Pending'); ?></li>
            <li><?php echo anchor('dashboard/client/quotes', 'Quotes'); ?></li>
            <li><?php echo anchor('dashboard/client/translations', 'Translations'); ?></li>
            <li><?php echo anchor('dashboard/client/history', 'History'); ?></li>
          </ul>
          <h5>Other</h5>
          <ul>
            <li><?php echo anchor('auth/logout', 'Logout'); ?></li>
          </ul>
        </div>
      </div>

      <div class="content">
        <?php $this->load->view($content); ?>
      </div>