<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="price-update">
        <div class="container mt-5">
            <h3 class="ff-semibold mb-3">Gold price</h3>
            <div class="table-price">
                <!-- TradingView Widget BEGIN -->
                <div class="tradingview-widget-container">
                    <div id="tradingview_5625e"></div>    
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget(
                        {
                            "autosize": true,
                            "symbol": "TVC:GOLD",
                            "interval": "D",
                            "timezone": "Etc/UTC",
                            "theme": "light",
                            "style": "1",
                            "locale": "<?= ($lang=='en' ? 'en_EN' : 'th_TH') ?>",
                            "toolbar_bg": "#f1f3f6",
                            "enable_publishing": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_5625e"
                        }
                    );
                    </script>
                </div>
                <!-- TradingView Widget END -->
            </div>
        </div>
    </section>

    <section class="dimon-price mt-5 mb-5">
        <div class="container">
            <h3 class="ff-semibold mb-3">Diamon price</h3>
            <h4>Rounds Shapes</h4>
            <div class="row mb-4">
                <?php for($i=3;$i<6;$i++){ ?>
                    <div class="col-md-4 col-6 mb-3">
                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= site_url('assets/images/dimon-price/dimon-'.$i.'.jpg') ?>" title="">
                            <div class="zoom-in"><img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/dimon-price/thimb-'.$i.'.jpg')) ?>" alt="dimon price"></div>
                        </a>
                    </div>
                <?php } ?>
            </div>

            <h4>Fancy Shapes</h4>
            <div class="row">
                <?php for($i=1;$i<3;$i++){ ?>
                    <div class="col-md-4 col-6 mb-3">
                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= site_url('assets/images/dimon-price/dimon-'.$i.'.jpg') ?>" title="">
                            <div class="zoom-in"><img src="<?= (is_file($img['images'])?site_url($img['images']):site_url('assets/images/dimon-price/thimb-'.$i.'.jpg')) ?>" alt="dimon price"></div>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>