<?php if ($site_status == 'yes') { ?>
	<?php $this->load->view('admin/components/site_off/container'); ?>
<?php
} else { ?>
	<!DOCTYPE html>
	<html prefix="og: http://ogp.me/ns#" class="boxed <?= LANG ?> <?=($user_id2) ? 'login' : 'nologin'?>" lang="en">
	<?php $this->load->view('public/companents/page_header'); ?>
	<body class="<?= (@$sel == 'home') ? 'home' : 'pages-body' ?>">
		<div class="page-wrapper <?= (@$sel == 'home') ? '' : 'pages' ?>">
			<?//php $this->load->view('public/companents/header'); ?>
			<?php if ($sel == 'home') { ?>
			<?php } ?>
            <main class="main">
			<?//php $this->load->view($body) ?>
            </main>
        	<?// $this->load->view('public/companents/footer'); ?>
			<?php if ($sel == 'home') { ?>
			<?php } ?>
		</div>
		<? //$this->load->view('public/companents/footer_scripts'); ?>
	</body>
	</html>
<?php
} ?>