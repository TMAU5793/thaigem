<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner">
        <img src="<?= site_url('assets/images/home/banner.jpg') ?>" alt="">
    </section>

    <section class="category-home">
        <div class="bg-title ptb-2rem">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ip the dummy text industry. Lorem Ip dummy text and typesetting industry.</p>
                        <div class="tg-title">
                            <h3>Members</h3>
                            <h3 class="ff-bold">Category</h3>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <?= $this->include('template/gold-price') ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="category-list ptb-2rem">
            <div class="container">
                <div class="slick-5-item">
                    <?php
                        for($i=1;$i<8;$i++){
                    ?>
                        <div class="cateory-item">
                            <div class="box-shadow">
                                <div class="item-img">
                                    <img src="<?= site_url('assets/images/home/cate-'.$i.'.jpg') ?>" alt="thaigem category">
                                </div>
                                <div class="item-text text-center position-relative">
                                    <h3 class="ff-semibold fs-6 absolute-center">Diamonds</h3>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>

    <section class="price-update ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tg-title">
                        <h3><strong class="ff-bold">Price</strong> Update</h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end price-subject">
                        <strong class="ff-bold"><i class="fas fa-square c-darkgold"></i> Diamonds</strong>
                        <strong class="ff-bold"><i class="fas fa-square c-gray"></i> Ruby</strong>
                        <strong class="ff-bold"><i class="fas fa-square c-lightgray"></i> Sapphire</strong>
                    </div>
                </div>
            </div>
            <div class="table-price">
                <?= $this->include('template/price-table') ?>
            </div>
        </div>
    </section>

    <section class="event-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tg-title">
                        <h3><strong class="ff-bold">Events</strong></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end view-all">
                        <a href="" class="c-black ff-semibold">View All</a>
                    </div>
                </div>
            </div>
            <div class="slick-1-item mt-4">
                <div class="event-item">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="<?= site_url('assets/images/home/event-1.jpg') ?>" alt="thaigem event">
                        </div>
                        <div class="col-md-5 position-relative">
                            <div class="event-date text-end pt-3 pe-4"><span>05/06/2564</span></div>
                            <div class="absolute-center text-center w-75">
                                <h2 class="ff-semibold fs-4">Events 01</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                                <div class="btn-tg-group">
                                    <a href="" class="btn btn-redmore btn-black-border">Read More</a>
                                    <a href="" class="btn btn-booking btn-black-border">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event-item">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="<?= site_url('assets/images/home/event-1.jpg') ?>" alt="thaigem event">
                        </div>
                        <div class="col-md-5 position-relative">
                            <div class="event-date text-end pt-3 pe-4"><span>05/07/2564</span></div>
                            <div class="absolute-center text-center w-75">
                                <h2 class="ff-semibold fs-4">Events 01</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                                <div class="btn-tg-group">
                                    <a href="" class="btn btn-redmore btn-black-border">Read More</a>
                                    <a href="" class="btn btn-booking btn-black-border">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="event-item">
                    <div class="row">
                        <div class="col-md-7">
                            <img src="<?= site_url('assets/images/home/event-1.jpg') ?>" alt="thaigem event">
                        </div>
                        <div class="col-md-5 position-relative">
                            <div class="event-date text-end pt-3 pe-4"><span>05/08/2564</span></div>
                            <div class="absolute-center text-center w-75">
                                <h2 class="ff-semibold fs-4">Events 01</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                                <div class="btn-tg-group">
                                    <a href="" class="btn btn-redmore btn-black-border">Read More</a>
                                    <a href="" class="btn btn-booking btn-black-border">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="news-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="tg-title">
                        <h3><strong class="ff-bold">Knowledge & News</strong></h3>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="text-end view-all">
                        <a href="" class="c-black ff-semibold">View All</a>
                    </div>
                </div>
            </div>
            <div class="row news-list mt-4">
                <div class="col-md-5">
                    <div class="news-slide slick-1-item">
                        <div class="news-item">
                            <img src="<?= site_url('assets/images/news/news-slide.jpg') ?>" alt="">
                            <div class="news-desc c-white position-absolute">
                                <h2 class="ff-semibold">Knowledge & New 1</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                <div class="btn-news-group">
                                    <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                    <a href="" class="c-white ff-semibold ms-4">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <img src="<?= site_url('assets/images/news/news-slide.jpg') ?>" alt="">
                            <div class="news-desc c-white position-absolute">
                                <h2 class="ff-semibold">Knowledge & New 2</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                <div class="btn-news-group">
                                    <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                    <a href="" class="c-white ff-semibold ms-4">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="news-item">
                            <img src="<?= site_url('assets/images/news/news-slide.jpg') ?>" alt="">
                            <div class="news-desc c-white position-absolute">
                                <h2 class="ff-semibold">Knowledge & New 3</h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                <div class="btn-news-group">
                                    <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                    <a href="" class="c-white ff-semibold ms-4">View All</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="news-item">
                                <img src="<?= site_url('assets/images/news/news-1.jpg') ?>" alt="">
                                <div class="news-desc c-white position-absolute">
                                    <h2 class="ff-semibold fs-5">Knowledge & New</h2>
                                    <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                    <div class="btn-news-group">
                                        <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                        <a href="" class="c-white ff-semibold ms-4">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="news-item">
                                <img src="<?= site_url('assets/images/news/news-2.jpg') ?>" alt="">
                                <div class="news-desc c-white position-absolute">
                                    <h2 class="ff-semibold fs-5">Knowledge & New</h2>
                                    <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                    <div class="btn-news-group">
                                        <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                        <a href="" class="c-white ff-semibold ms-4">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="news-item">
                                <img src="<?= site_url('assets/images/news/news-3.jpg') ?>" alt="">
                                <div class="news-desc c-white position-absolute">
                                    <h2 class="ff-semibold fs-5">Knowledge & New</h2>
                                    <p>Lorem Ipsum is simply dummy text and typesetting industry</p>
                                    <div class="btn-news-group">
                                        <a href="" class="btn btn-redmore btn-white-border c-white ff-semibold">Read More</a>
                                        <a href="" class="c-white ff-semibold ms-4">View All</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="member-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="tg-title">
                        <h3><strong class="ff-bold">Member</strong></h3>
                    </div>
                </div>
            </div>
            <div class="member-list slick-2-item slick-dots-2 mb-5 mt-3">
                <?php 
                    for($i=1;$i<5;$i++){
                ?>
                <div class="member-item">                    
                    <div class="box-shadow w-100 d-inline-flex">
                        <div class="w-50">
                            <div class="mian-img">
                                <img src="<?= site_url('assets/images/member/member-1.jpg') ?>" alt="">
                            </div>
                            <div class="sub-img">
                                <ul>
                                    <li><img src="<?= site_url('assets/images/member/member-1-1.jpg') ?>" alt=""></li>
                                    <li><img src="<?= site_url('assets/images/member/member-1-2.jpg') ?>" alt=""></li>
                                    <li><img src="<?= site_url('assets/images/member/member-1-3.jpg') ?>" alt=""></li>
                                </ul>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="w-50 position-relative">
                            <div class="absolute-center text-center w-100 p-3">
                                <h2 class="ff-semibold c-darkgold fs-5">kanyaluk Wathananon <?= $i ?></h2>
                                <p>Lorem Ipsum is simply dummy text and typesetting industry. Lorem Ipthe industry's standard dummy text</p>
                                <div class="btn-tg-group mt-5">
                                    <a href="" class="btn btn-redmore btn-black-border ff-semibold">View Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <section class="singup-home ptb-2rem">
        <div class="container">
            <div class="row">
                <div class="col-md-6 position-relative">
                    <div class="absolute-center w-100 singup-form text-center">
                        <strong class="ff-semibold c-darkgold fs-1 d-block">SIGN UP FOR</strong>
                        <span class="c-darkgold fs-3 d-block">OUR NEWSLETTER</span>
                        <p class="mt-4">Lorem Ipsum is simply dummy textof the printing and typesetting in</p>
                        <form id="frm-singup" action="" method="">
                            <div class="input-group">
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="btn-singup-group mt-3">
                                <button class="btn btn-darkgold ff-semibold c-white w-100">Subscribe</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="box-img">
                        <img src="<?= site_url('assets/images/home/singup-img.jpg') ?>" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="map-home">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3875.9353333358026!2d100.51798321488828!3d13.722364901671902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30e298cfb8058255%3A0xbaeba354c2284a26!2sThai%20Gem%20and%20Jewelry%20Traders%20Association!5e0!3m2!1sen!2sth!4v1630665357250!5m2!1sen!2sth"  height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </section>

<?= $this->endSection() ?>

<?= $this->section("scripts") ?>
    <?= $this->include('template/slick-slide') ?>
<?= $this->endSection() ?>