<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
?>
<main class="inner-page-sec-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-lg-3  mt--40 mt-lg--0">
                <div class="inner-page-sidebar">
                    <!-- Accordion -->
                    <div class="single-block">
                        <h3 class="sidebar-title">Категория</h3>
                        <ul class="sidebar-menu--shop">
                            <?php foreach (\common\models\Folders::find()->where(['parent_id' => null])->all() as $item):?>
                                <li><a href="<?= \yii\helpers\Url::toRoute(['/site/category', 'category_id' => $item->id])?>"><?= $item->title ?> (<?= $item->fileCountChild?>)</a></li>
                                <?php if ($item->fileCountChild): ?>
                                    <ul class="inner-cat-items">
                                        <?php foreach ($item->children as $child):?>
                                            <li><a href="<?= \yii\helpers\Url::toRoute(['/site/category', 'category_id' => $child->id])?>"><?= $child->title; ?> (<?= $child->fileCount?>)</a></li>
                                        <?php endforeach;?>
                                    </ul>
                                <?php endif?>
                            <?php endforeach;?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 order-lg-2">
                <div class="container">
                    <div class="row  mb--60">
                        <div class="col-lg-5 mb--30">
                            <!-- Product Details Slider Big Image-->
                            <div class="product-details-slider sb-slick-slider arrow-type-two" data-slick-setting='{
                          "slidesToShow": 1,
                          "arrows": false,
                          "fade": true,
                          "draggable": false,
                          "swipe": false,
                          "asNavFor": ".product-slider-nav"
                          }'>
                                <div class="single-slide">
                                    <div class="image-index-category-box">
                                        <p class="image-show-category-title"><?= $model->title ?></p>
                                    </div>
                                    <img src="/template/image/products/product-1.png" alt="">
                                </div>
                            </div>
                            <!-- Product Details Slider Nav -->
                            <div class="mt--30 product-slider-nav sb-slick-slider arrow-type-two" data-slick-setting='{
                        "infinite":true,
                          "autoplay": true,
                          "autoplaySpeed": 8000,
                          "slidesToShow": 4,
                          "arrows": true,
                          "prevArrow":{"buttonClass": "slick-prev","iconClass":"fa fa-chevron-left"},
                          "nextArrow":{"buttonClass": "slick-next","iconClass":"fa fa-chevron-right"},
                          "asNavFor": ".product-details-slider",
                          "focusOnSelect": true
                          }'>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <div class="product-details-info pl-lg--30 ">
                                <p class="tag-block"><a href="#"><?= $model->category->title?></a></p>
                                <h3 class="product-title"><?= $model->title?></h3>
                                <ul class="list-unstyled">
                                    <li>Муаллиф: <span class="list-value"> <?= $model->document_author?></span></li>
                                    <li>Нашр этилган сана: <a href="#" class="list-value font-weight-bold"> <?= $model->document_date?></a></li>
                                </ul>
                                <div class="rating-widget">
                                    <div class="rating-block">
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star star_on"></span>
                                        <span class="fas fa-star "></span>
                                    </div>
                                    <div class="review-widget">
                                        <a href="">(1 баҳолаганлар)</a> <span>|</span>
                                        <a href="">Изоҳ қолдиринг</a>
                                    </div>
                                </div>
                                <div class="add-to-cart-row">
                                    <div class="add-cart-btn">
                                        <a href="<?= \yii\helpers\Url::toRoute(['/site/download-file', 'id' => $model->id])?>" class="btn btn-outlined--primary">
                                            <span class="fas fa-download"></span>Юклаб олиш</a>
                                    </div>
                                </div>
                                <div class="compare-wishlist-row">
                                    <a href="" class="add-link"><i class="fas fa-heart"></i>Танланганлар рўйхати</a>
                                </div>
                                <div class="compare-wishlist-row">
                                    <a href="javascript::void(0)" class="add-link">Улашиш:</a>
                                    <a target="_blank" href="https://telegram.me/share/url?url=<?=\yii\helpers\Url::to(["site/show", 'id' => $model->id], 'http')?>" class="add-link"><i class="fab fa-telegram-plane fa-2x"></i></a>
                                    <a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?=\yii\helpers\Url::to(["site/show", 'id' => $model->id], 'http')?>" class="add-link"><i class="fab fa-facebook fa-2x"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sb-custom-tab review-tab section-padding">
                        <ul class="nav nav-tabs nav-style-2" id="myTab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="tab1" data-toggle="tab" href="#tab-1" role="tab"
                                   aria-controls="tab-1" aria-selected="true">
                                    Қисқача мазмуни
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="tab2" data-toggle="tab" href="#tab-2" role="tab"
                                   aria-controls="tab-2" aria-selected="true">
                                    Изоҳлар (1)
                                </a>
                            </li>
                        </ul>
                        <div class="tab-content space-db--20" id="myTabContent">
                            <div class="tab-pane fade show active" id="tab-1" role="tabpanel" aria-labelledby="tab1">
                                <article class="review-article">
<!--                                    <h1 class="sr-only">Tab Article</h1>-->
                                    <p><?= $model->document_description?></p>
                                </article>
                            </div>
                            <div class="tab-pane fade" id="tab-2" role="tabpanel" aria-labelledby="tab2">
                                <div class="review-wrapper">
                                    <h2 class="title-lg mb--20">1 REVIEW FOR AUCTOR GRAVIDA ENIM</h2>
                                    <div class="review-comment mb--20">
                                        <div class="avatar">
                                            <img src="/template/image/icon/author-logo.png" alt="">
                                        </div>
                                        <div class="text">
                                            <div class="rating-block mb--15">
                                                <span class="ion-android-star-outline star_on"></span>
                                                <span class="ion-android-star-outline star_on"></span>
                                                <span class="ion-android-star-outline star_on"></span>
                                                <span class="ion-android-star-outline"></span>
                                                <span class="ion-android-star-outline"></span>
                                            </div>
                                            <h6 class="author">ADMIN – <span class="font-weight-400">March 23, 2015</span>
                                            </h6>
                                            <p>Lorem et placerat vestibulum, metus nisi posuere nisl, in accumsan elit odio
                                                quis mi.</p>
                                        </div>
                                    </div>
                                    <h2 class="title-lg mb--20 pt--15">ADD A REVIEW</h2>
                                    <div class="rating-row pt-2">
                                        <p class="d-block">Your Rating</p>
                                        <span class="rating-widget-block">
                                                    <input type="radio" name="star" id="star1">
                                                    <label for="star1"></label>
                                                    <input type="radio" name="star" id="star2">
                                                    <label for="star2"></label>
                                                    <input type="radio" name="star" id="star3">
                                                    <label for="star3"></label>
                                                    <input type="radio" name="star" id="star4">
                                                    <label for="star4"></label>
                                                    <input type="radio" name="star" id="star5">
                                                    <label for="star5"></label>
                                                </span>
                                        <form action="./" class="mt--15 site-form ">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group">
                                                        <label for="message">Comment</label>
                                                        <textarea name="message" id="message" cols="30" rows="10"
                                                                  class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="name">Name *</label>
                                                        <input type="text" id="name" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="email">Email *</label>
                                                        <input type="text" id="email" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label for="website">Website</label>
                                                        <input type="text" id="website" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="submit-btn">
                                                        <a href="#" class="btn btn-black">Post Comment</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>