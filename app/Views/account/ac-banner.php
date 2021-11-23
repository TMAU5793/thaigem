<?php
    use App\Models\Account\AccountModel;

    $userdata = session()->get('userdata');
    $model = new AccountModel();
    $info = $model->where('account',$userdata['account'])->first();

?>
<div class="banner-item">
    <img src="<?= site_url('assets/images/account/banner.jpg') ?>" alt="">
    <div class="absolute-center">
        <h2 class="display-3 ff-dbadmanBold"><?= $info['company'] ?></h2>
    </div>
</div>