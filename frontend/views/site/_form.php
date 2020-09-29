<div class="col-lg-3 col-sm-6 mb-5">
    <div class="product-card">
        <div class="product-grid-content">
            <div class="product-header">
<!--                <h3><a style="margin-bottom: 5px; font-size: 13px" href="--><?//= \yii\helpers\Url::toRoute(['site/show', 'id' => $model->id])?><!--">--><?//= $model->category->title?><!--</a></h3>-->
            </div>
            <div class="product-card--body">
                <div class="card-image">
                    <div class="image-index-category-box">
                        <p class="image-index-category-title"><?= $model->title ?></p>
                    </div>
                    <img src="/template/image/products/product-1.png" alt="">
                    <div class="hover-contents">
                        <a href="<?= \yii\helpers\Url::toRoute(['site/show', 'id' => $model->id])?>" class="hover-image">
                            <img src="/template/image/products/product-1.png" alt="">
                        </a>
                        <div class="hover-btns">
                            <a href="https://telegram.me/share/url?url=<?=\yii\helpers\Url::to(["site/show", 'id' => $model->id], 'http')?>" class="single-btn">
                                <i class="fab fa-telegram-plane"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?=\yii\helpers\Url::to(["site/show", 'id' => $model->id], 'http')?>" class="single-btn">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="<?= \yii\helpers\Url::toRoute(['/site/download-file', 'id' => $model->id])?>" class="single-btn">
                                <i class="fas fa-download"></i>
                            </a>
<!--                            <a href="#" data-toggle="modal" data-target="#quickModal"-->
<!--                               class="single-btn">-->
<!--                                <i class="fas fa-eye"></i>-->
<!--                            </a>-->
                        </div>
                    </div>
                </div>
                <div class="price-block" style="margin-top: 10px">
                    <span class="price" style="font-size: 12px"><span class="text-danger">Юклашлар сони:</span> <?= $model->download_count?></span>
<!--                    <span class="price-discount" style="font-size: 9px">--><?//= $model->document_date?><!--</span>-->
                </div>
            </div>
        </div>
    </div>
</div>