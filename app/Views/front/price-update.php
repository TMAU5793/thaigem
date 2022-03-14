<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="price-update">
        <div class="container mt-5">
            <h3 class="ff-semibold mb-3">Gold price</h3>
            <div class="table-price mb-5">
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
            
            <h3 class="ff-semibold mb-3">Silver price</h3>
            <div class="silver-chart">
                <!-- TradingView Widget BEGIN -->
                    <div class="tradingview-widget-container">
                    <div id="tradingview_93573"></div>
                    <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com/symbols/TVC-SILVER/" rel="noopener" target="_blank"><span class="blue-text">SILVER Chart</span></a> by TradingView</div>
                    <script type="text/javascript" src="https://s3.tradingview.com/tv.js"></script>
                    <script type="text/javascript">
                    new TradingView.widget(
                        {
                            "autosize": true,
                            "symbol": "TVC:SILVER",
                            "interval": "D",
                            "timezone": "Etc/UTC",
                            "theme": "dark",
                            "style": "3",
                            "locale": "en",
                            "toolbar_bg": "#f1f3f6",
                            "enable_publishing": false,
                            "allow_symbol_change": true,
                            "container_id": "tradingview_93573"
                        }
                    );
                    </script>
                    </div>
                    <!-- TradingView Widget END -->
            </div>
        </div>
    </section>

    <section id="diamond-price" class="dimon-price mt-5 mb-5">
        <div class="container">
            <h3 class="ff-semibold mb-3">Diamond price</h3>
            <h4>Rounds Shapes</h4>
            <div class="row mb-4">
                <?php 
                    if($price){
                        foreach ($price as $row) {
                            if($row['type']=='rounds'){
                ?>
                    <div class="col-md-4 col-6 mb-3">
                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= (is_file($row['file'])?site_url($row['file']):'') ?>" title="">
                            <div class="zoom-in"><img src="<?= (is_file($row['file'])?site_url($row['file']):'') ?>" alt="dimon price"></div>
                        </a>
                    </div>
                <?php } } } ?>
            </div>

            <h4>Fancy Shapes</h4>
            <div class="row">
                <?php 
                    if($price){
                        foreach ($price as $row) {
                            if($row['type']=='fancy'){
                ?>
                    <div class="col-md-4 col-6 mb-3">
                        <a class="fancybox" data-fancybox="plans" data-width="1400" data-caption="" href="<?= (is_file($row['file'])?site_url($row['file']):'') ?>" title="">
                            <div class="zoom-in"><img src="<?= (is_file($row['file'])?site_url($row['file']):'') ?>" alt="dimon price"></div>
                        </a>
                    </div>
                <?php } } } ?>
            </div>
        </div>
    </section>

<?= $this->endSection() ?>