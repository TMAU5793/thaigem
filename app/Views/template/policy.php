<?= $this->extend("front/app") ?>
<?= $this->section("content") ?>

    <section class="banner-home">
        <img src="<?= (is_file($banner['banner'])?site_url($banner['banner']):site_url('assets/images/img-default.jpg')) ?>" class="hide-575" alt="thai gem">
        <img src="<?= (is_file($banner['banner_mobile'])?site_url($banner['banner_mobile']):site_url('assets/images/img-default.jpg')) ?>" class="show-575" alt="thai gem">
    </section>
    
    <section class="information-center pb-5">
        <div class="container">
            <!-- <div class="title text-center pt-5"><h1 class="fs-3 ff-semibold"><?= $meta_title ?></h1></div> -->
            <div class="content-body apply-member mt-3">
                <div class="p-4">
                    <?php if($lang=='th'){ ?>
                        <h3>นโยบายการใช้คุกกี้ (Cookies Policy)</h3>
                        <p>เว็บไซต์นี้ให้บริการโดยสมาคมผู้ค้าอัญมณีไทยและเครื่องประดับ เว็บไซต์นี้ใช้คุกกี้และเครื่องมืออื่นเพื่อช่วยแยกแยะรูปแบบการใช้งานเว็บไซต์ของท่านจากผู้ใช้งานอื่นๆซึ่งจะช่วยให้ท่านได้รับประสบการณ์ที่ดีจากการใช้งานเว็บไซต์ และช่วยให้เราสามารถพัฒนาคุณภาพของเว็บไซต์ให้ดียิ่งขึ้น กรณีที่ท่านใช้งานเว็บไซต์นี้ต่อไป ถือว่าท่านได้ยินยอมให้เราติดตั้งคุกกี้ไว้ในเครื่องคอมพิวเตอร์ของท่าน</p>
                        1. คุกกี้คืออะไร?
                        <p>คุกกี้คือข้อความขนาดเล็กที่ประกอบด้วยส่วนของข้อมูลที่มาจากการดาวน์โหลดที่อาจถูกเก็บบันทึกไว้ในเว็บเบราว์เซอร์ที่ท่านใช้งานหรืออุปกรณ์อื่น ๆ ที่ต่อเชื่อมอินเตอร์เน็ต (อาทิ เครื่องคอมพิวเตอร์ สมาร์ทโฟน หรือแท็บเล็ตของท่าน) โดยที่เครื่องเซิร์ฟเวอร์สามารถเรียกดูได้ในภายหลัง คล้ายกับหน่วยความจำของหน้าเว็บ</p>
                        <p>การทำงานของคุกกี้ ช่วยให้เรารวบรวมและจัดเก็บข้อมูลการเยี่ยมชมเว็บไซต์ของท่านดังต่อไปนี้โดยอัตโนมัติ</p>
                        <ul>
                            <li>อินเตอร์เน็ตโดเมนและ IP Address จากจุดที่ท่านเข้าสู่เว็บไซต์</li>
                            <li>ประเภทของเบราว์เซอร์ซอฟต์แวร์ ตลอดจนโครงสร้างและระบบการปฏิบัติงานที่ใช้ในการเข้าสู่เว็บไซต์</li>
                            <li>วันที่และเวลาที่ท่านเข้าสู่เว็บไซต์</li>
                            <li>ที่อยู่ของเว็บไซต์อื่นที่เชื่อมโยงท่านเข้าสู่เว็บไซต์ของเรา และ</li>
                            <li>หน้าเว็บที่ท่านเข้า เยี่ยมชม และนำท่านออกจากเว็บไซต์ของเรา รวมถึงเนื้อหาบนหน้าเว็บที่ท่านเยี่ยมชมและระยะเวลาที่ท่านใช้ในการเยี่ยมชม</li>
                        </ul>

                        2. การใช้งานคุกกี้
                        <p>ประเภทของคุกกี้ที่เราใช้และในการใช้คุกกี้ดังกล่าว ประกอบด้วย แต่ไม่จำกัดเพียง รายการต่อไปนี้</p>
                        <ul>
                            <li>คุกกี้ประเภทที่มีความจำเป็นอย่างยิ่ง (Strictly Necessary Cookies): คุกกี้ประเภทนี้มีความสำคัญต่อการทำงานของเว็บไซต์ ซึ่งรวมถึงคุกกี้ที่ทำให้ท่านสามารถเข้าถึงข้อมูลและใช้งานในเว็บไซต์ของเราได้อย่างปลอดภัย</li>
                            <li>คุกกี้เพื่อการวิเคราะห์/วัดผลการทำงานของเว็บไซต์(Analytical/Performance Cookies): คุกกี้ประเภทนี้จะช่วยให้เราสามารถจดจำและนับจำนวนผู้เข้าเยี่ยมชมเว็บไซต์ตลอดจนช่วยให้เราทราบถึงพฤติกรรมในการเยี่ยมชมเว็บไซต์ เพื่อปรับปรุงการทำงานของเว็บไซต์ให้มีคุณภาพดีขึ้นและมีความเหมาะสมมากขึ้น อีกทั้งเพื่อรวบรวมข้อมูลทางสถิติเกี่ยวกับวิธีการเข้าและพฤติกรรมการเยี่ยมชมเว็บไซต์ ซึ่งจะช่วยปรับปรุงการทำงานของเว็บไซต์โดยให้ผู้ใช้งานสามารถค้นหาสิ่งที่ต้องการได้อย่างง่ายดาย และช่วยให้เราเข้าใจถึงความสนใจของผู้ใช้ และวัดความมีประสิทธิผลของโฆษณาของเรา</li>
                            <li>คุกกี้เพื่อการทำงานของเว็บไซต์ (Functionality Cookies): คุกกี้ประเภทนี้ใช้ในการจดจำตัวท่านเมื่อท่านกลับมาใช้งานเว็บไซต์อีกครั้ง ซึ่งจะช่วยให้เราสามารถปรับแต่งเนื้อหาสำหรับท่าน ปรับให้เว็บไซต์ของเราตอบสนองความต้องการใช้งานของท่าน รวมถึงจดจำการตั้งค่าของท่าน อาทิ ภาษา หรือภูมิภาค หรือขนาดของตัวอักษรที่ท่านเลือกใช้ในการใช้งานในเว็บไซต์</li>
                            <li>คุกกี้เพื่อปรับเนื้อหาเข้ากับกลุ่มเป้าหมาย (Targeting Cookies): คุกกี้ประเภทนี้จะบันทึกการเข้าชมเว็บไซต์ของท่าน หน้าเว็บที่ท่านได้เยี่ยมชม และลิงค์ที่ท่านเยี่ยมชม เราจะใช้ข้อมูลนี้เพื่อปรับให้เว็บไซต์และเนื้อหาใด ๆ ที่ปรากฏอยู่บนหน้าเว็บตรงกับความสนใจของคุณมากขึ้น นอกจากนี้ เรายังอาจแชร์ข้อมูลนี้กับบุคคลที่สามเพื่อวัตถุประสงค์ดังกล่าว และ</li>
                            <li>คุกกี้เพื่อการโฆษณา (Advertising Cookies): คุกกี้ประเภทนี้จะจดจำการตั้งค่าของท่านในการเข้าใช้งานหน้าเว็บไซต์ และนำไปใช้เป็นข้อมูลประกอบการปรับเปลี่ยนหน้าเว็บไซต์เพื่อนำเสนอโฆษณาที่เหมาะสมกับท่านมากที่สุดเท่าที่จะเป็นไปได้ ตัวอย่างเช่น การเลือกแสดงโฆษณาสินค้าที่ท่านสนใจ การป้องกันหรือการจำกัดจำนวนครั้งที่ท่านจะเห็นหน้าเว็บไซต์ของโฆษณาซ้ำๆ  เพื่อช่วยวัดความมีประสิทธิผลของโฆษณา</li>
                        </ul>
                        <p>โปรดทราบว่าคุกกี้บางประเภทในเว็บไซต์นี้จัดการโดยบุคคลที่สาม เช่น เครือข่ายการโฆษณา ลักษณะการทำงานต่าง ๆ อาทิ วิดีโอ แผนที่ และโซเชียลมีเดีย และผู้ให้บริการเว็บไซต์ภายนอกอื่น ๆ เช่น บริการวิเคราะห์การเข้าเยี่ยมชมเว็บไซต์ เป็นต้น คุกกี้เหล่านี้มักจะเป็นคุกกี้เพื่อการวิเคราะห์/วัดผลการทำงาน หรือคุกกี้เพื่อปรับเนื้อหาเข้ากับกลุ่มเป้าหมาย ท่านควรต้องศึกษานโยบายการใช้คุกกี้และนโยบายส่วนบุคคลในเว็บไซต์ของบุคคลที่สาม เพื่อให้เข้าใจถึงวิธีการที่บุคคลที่สามอาจนำข้อมูลของท่านไปใช้</p>

                        3. การตั้งค่าคุกกี้
                        <p>ท่านสามารถบล็อกการทำงานของคุกกี้ได้โดยการกำหนดค่าในเบราวเซอร์ของท่าน ซึ่งท่านอาจปฏิเสธการติดตั้งค่าคุกกี้ทั้งหมดหรือบางประเภทก็ได้ แต่พึงตระหนักว่าหากท่านตั้งค่าเบราวเซอร์ของท่านด้วยการบล็อกคุกกี้ทั้งหมด (รวมถึงคุกกี้ที่จำเป็นต่อการใช้งาน) ท่านอาจจะไม่สามารถเข้าสู่เว็บไซต์ทั้งหมดหรือบางส่วนของเราได้</p>
                        <p>เมื่อใดก็ตามที่ท่านต้องการยกเลิกความยินยอมการใช้งานคุกกี้ ท่านจะต้องตั้งค่าเบราวเซอร์ของท่านเพื่อให้ลบคุกกี้ออกจากแต่ละเบราวเซอร์ที่ท่านใช้งาน</p>
                        <p>หากท่านต้องการข้อมูลเพิ่มเติมเกี่ยวกับวิธีการดังกล่าว โปรดเลือกหัวข้อ “ความช่วยเหลือ” ในอินเตอร์เน็ตเบราวเซอร์ของท่านเพื่อศึกษาในรายละเอียดมากขึ้น</p>                                            
                    <?php }else{ ?>
                        <h3>Cookies Policy</h3>
                        <p>TGJTA operate this website. This website uses cookies and other tools to help distinguish you from other users of the website. This helps us to provide you with a good experience when you use the website and also allows us to improve the website. By continuing to use the website, you are agreeing to us placing cookies on your computer.</p>
                        1. WHAT ARE COOKIES?
                        <p>Cookies are small text containing small amounts of information which are downloaded and may be stored on any of your web browsers or internet enabled devices (e.g. your computer, smartphone or tablet) that can later be read by the server - like a memory for a web page.</p>
                        <p>This means we automatically collect and store the following information about your visit:</p>
                        <ul>
                            <li>the internet domain and IP address from where you access the website.</li>
                            <li>the type of browser software and configuration and operating system used to access the website.</li>
                            <li>the date and time you access the website.</li>
                            <li>if you linked to the website from another website, the address of that website. and</li>
                            <li>the pages you enter, visit and exit the website from, content viewed and duration of visits.</li>
                        </ul>

                        2. USE OF COOKIES
                        <p>The types of cookies we use and why we use them, includes but is not limited to the following:</p>
                        <ul>
                            <li>Strictly necessary cookies.  These are cookies that are required for the operation of the website, and include, for example, cookies that enable you to log into secure areas of the website.</li>
                            <li>Analytical/performance cookies.  These cookies allow us to recognise and count the number of visitors and to see how visitors move around and use our website. These cookies are used for web enhancement and optimisation purposes and to aggregate statistics on how our visitors reach and browse our websites. This helps us to improve the way our website works, for example, by ensuring that users are finding what they are looking for easily and to help us understand what interests our users, and measure how effective our advertising is.</li>
                            <li>Functionality cookies.  These are used to recognise you when you return to the website. This enables us to personalise our content for you, tailor the website for your needs and remember your preferences, for example, your choice of language or region, browsing font size.</li>
                            <li>Targeting cookies. These cookies record your visit to the website, the pages you have visited and the links you have followed. We will use this information to make our website and any material displayed on it more relevant to your interests. We may also share this information with third parties for this purpose. and</li>
                            <li>Advertising cookies. These cookies will remember your preferences, and in general, that your used the website, to tailor advertising to you that are as relevant to you as possible, e.g. by selecting interest-based advertisements for you, or preventing or limiting the number of times you see the same advertisement to help measure the effectiveness of advertisements.</li>
                        </ul>
                        <p>Please note that some cookies on the website are managed by third parties, including, for example, advertising networks, features such as videos, maps and social media, and providers of external websites like web traffic analysis services. These cookies are likely to be analytical/performance cookies or targeting cookies. You should refer to such third parties’ own cookie and privacy policies for information about how they may use your information.</p>

                        3. MANAGING COOKIE SETTINGS
                        <p>You can block cookies by activating the setting within your browser that allows you to refuse the setting of all or some cookies.  Please be aware if you use your browser settings to block all cookies (including essential cookies) you may not be able to access all or parts of our website.</p>
                        <p>If you wish to withdraw your agreement at any time, you will need to delete your cookies using your browser settings for each browser you use.</p>
                        <p>For more information about how to do this, please follow the 'Help' option in your internet browser for more details.</p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- echo lang('GlobalLang.notfound'); -->
<?= $this->endSection() ?>