<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    </section>    

    <section class="account-body">
        <div class="container">
            <div class="row">
                <div class="col-md-3">

                </div>
                <div class="col-md-7">
                    <?php
                        if (session()->get('logged_member')) {
                            echo $this->include('account/account-menu');
                        }
                    ?>
                    <div class="content-body">
                        <div class="content-title"><strong class="ff-semibold fs-3">My Account</strong></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    
<?= $this->endSection() ?>