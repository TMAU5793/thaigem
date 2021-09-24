<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <fb:login-button scope="public_profile,email" onlogin="checkLoginState();"></fb:login-button>
    <div id="status"></div>

    <div class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false"></div>
<?= $this->endSection() ?>