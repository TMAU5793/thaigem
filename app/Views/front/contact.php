<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="contact-content">
        <section class="map-location mb-5">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9353333358026!2d100.51798321488828!3d13.722364901671902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298cfb8058255%3A0xbaeba354c2284a26!2sThai%20Gem%20and%20Jewelry%20Traders%20Association!5e0!3m2!1sen!2sth!4v1630665357250!5m2!1sen!2sth"  height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </section>
        <div class="container contact-home mb-5">
            <div class="row">
                <div class="col-md-6">
                    <div class="contact-info">
                        <strong class="ff-semibold d-block fs-2">TGJTA</strong>
                        <strong class="ff-semibold d-block">Thai Gem and Jewelry Traders Association</strong>
                        <p class="mt-4"><?= lang('GlobalLang.addressInfo'); ?></p>
                        <div class="social-contact">
                            <a href="tel:02-630-1390"><i class="fas fa-mobile-alt"></i> 02-630-1390</a>
                            <a href="http://www.thaigemjewelry.or.th/"><i class="fas fa-globe"></i> http://www.thaigemjewelry.or.th/</a>
                            <a href="mailto:info@thaigemjewelry.org"><i class="far fa-envelope"></i> info@thaigemjewelry.org</a>
                        </div>
                        <div class="follow-us">
                            <strong class="ff-semibold"><?= lang('GlobalLang.followUs'); ?></strong>
                            <a href=""><i class="fab fa-facebook-f"></i></a>
                            <a href=""><i class="fab fa-instagram"></i></a>
                            <a href=""><i class="fab fa-line"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-form">
                        <strong class="ff-semibold d-block fs-4 mb-3"><?= lang('GlobalLang.contactForm'); ?></strong>
                        <form action="">                            
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_name" placeholder="<?= lang('GlobalLang.name'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="txt_email" aria-describedby="emailHelp" placeholder="<?= lang('GlobalLang.email'); ?>">
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="txt_phone" placeholder="<?= lang('GlobalLang.phoneNumber'); ?>">
                            </div>
                            <button type="submit" class="btn bg-darkgold c-white ff-semibold w-100"><?= lang('GlobalLang.submit'); ?></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>