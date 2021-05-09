    <div class="container">
        <div class="input-mine">
            <h1>Affiliate Program</h1>
            <p>Invite your friends and get <?php echo settings('aff_comission'); ?>% each time they upgrade <?php echo settings('sitename'); ?>. </p>
            <div class="text-center" style="margin-bottom: 10px">
				<?php include_once __DIR__ . '/includes/social.php'; ?>
            </div>
        </div>
    </div>
</div>

<div class="wrapper white-box">
    <div class="container">
        <div class="faq-box">
            <div class="faq-item">
                <h2>Upgrade to Premium</h2>
                <p>
                    You can also <a href="<?php echo base_url('dashboard'); ?>">Upgrade Mining</a> to increase affiliate rate <?php echo settings('aff_comission'); ?>%.
                </p>
                <p>
                    <?php echo settings('sitename'); ?> is an industry leading <?php echo settings('currency_name');?> mining pool. All of the mining power is backed up by physical miners. Mining with the latest algorithms allows to make as much <?php echo settings('currency_name');?> as possible. We aim to provide you with the easiest possible way to make money without having to do any of the hard stuff.
                </p>
                <p>
                    With data centers around the globe, we aim to keep bills down and mining power high, meaning you can make more in a shorter amount of time than what it would take to mine from your home for instance. Our data centers are located in Europe, USA and China with dedicated Up-Links and 99% uptime!
                </p>
            </div>
        </div>
    </div>
</div>
