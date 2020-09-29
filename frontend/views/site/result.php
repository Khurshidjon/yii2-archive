<?php
$this->title = 'Поиск'
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
                <div class="shop-toolbar with-sidebar mb--30">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-2 col-sm-6">
                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a href="#" class="sorting-btn" data-target="grid">
                                    <i class="fas fa-th"></i>
                                </a>
                                <a href="#" class="sorting-btn active" data-target="grid-four">
                                    <span class="grid-four-icon">
                                        <i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="col-xl-4 col-md-4 col-sm-6  mt--10 mt-sm--0">
                            <span class="toolbar-status">
                                Showing 1 to 9 of 14 (2 Pages)
                            </span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6  mt--10 mt-md--0">
                            <div class="sorting-selection">
                                <span>Show:</span>
                                <select class="form-control nice-select sort-select">
                                    <option value="" selected="selected">3</option>
                                    <option value="">9</option>
                                    <option value="">5</option>
                                    <option value="">10</option>
                                    <option value="">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                            <div class="sorting-selection">
                                <span>Sort By:</span>
                                <select class="form-control nice-select sort-select mr-0">
                                    <option value="" selected="selected">Default Sorting</option>
                                    <option value="">Sort
                                        By:Name (A - Z)</option>
                                    <option value="">Sort
                                        By:Name (Z - A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="shop-toolbar d-none">
                    <div class="row align-items-center">
                        <div class="col-lg-2 col-md-2 col-sm-6">
                            <!-- Product View Mode -->
                            <div class="product-view-mode">
                                <a href="#" class="sorting-btn active" data-target="grid"><i
                                            class="fas fa-th"></i></a>
                                <a href="#" class="sorting-btn" data-target="grid-four">
                                            <span class="grid-four-icon">
                                                <i class="fas fa-grip-vertical"></i><i class="fas fa-grip-vertical"></i>
                                            </span>
                                </a>
                                <a href="#" class="sorting-btn" data-target="list "><i
                                            class="fas fa-list"></i></a>
                            </div>
                        </div>
                        <div class="col-xl-5 col-md-4 col-sm-6  mt--10 mt-sm--0">
                                    <span class="toolbar-status">
                                        Showing 1 to 9 of 14 (2 Pages)
                                    </span>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6  mt--10 mt-md--0">
                            <div class="sorting-selection">
                                <span>Show:</span>
                                <select class="form-control nice-select sort-select">
                                    <option value="" selected="selected">3</option>
                                    <option value="">9</option>
                                    <option value="">5</option>
                                    <option value="">10</option>
                                    <option value="">12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-4 col-sm-6 mt--10 mt-md--0 ">
                            <div class="sorting-selection">
                                <span>Sort By:</span>
                                <select class="form-control nice-select sort-select mr-0">
                                    <option value="" selected="selected">Default Sorting</option>
                                    <option value="">Sort
                                        By:Name (A - Z)</option>
                                    <option value="">Sort
                                        By:Name (Z - A)</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="">
                    <?= \yii\widgets\ListView::widget([
                        'dataProvider' => $dataProvider,
                        'pager' => [
                            'class' => 'yii\bootstrap4\LinkPager',
                            'options' => ['class' => ''],
                        ],
                        'layout' => '{items}<div class="shop-product-wrap grid-four with-pagination row space-db--30 shop-border"><div class="col-lg-3 col-sm-6"><div class="product-card"><div class="product-grid-content"></div></div>',
                        'options' => [
//                                'tag' => null, //{summary}
                        ],
                        'itemView' => function ($model, $key, $index, $widget) {
                            return $this->render('_form',['model' => $model]);
                        },
                    ])?>
                </div>
                <!-- Pagination Block -->
<!--                <div class="row pt--30">-->
<!--                    <div class="col-md-12">-->
<!--                        <div class="pagination-block">-->
<!--                            <ul class="pagination-btns flex-center">-->
<!--                                <li><a href="" class="single-btn prev-btn ">|<i-->
<!--                                                class="zmdi zmdi-chevron-left"></i> </a></li>-->
<!--                                <li><a href="" class="single-btn prev-btn "><i-->
<!--                                                class="zmdi zmdi-chevron-left"></i> </a></li>-->
<!--                                <li class="active"><a href="" class="single-btn">1</a></li>-->
<!--                                <li><a href="" class="single-btn">2</a></li>-->
<!--                                <li><a href="" class="single-btn">3</a></li>-->
<!--                                <li><a href="" class="single-btn">4</a></li>-->
<!--                                <li><a href="" class="single-btn next-btn"><i-->
<!--                                                class="zmdi zmdi-chevron-right"></i></a></li>-->
<!--                                <li><a href="" class="single-btn next-btn"><i-->
<!--                                                class="zmdi zmdi-chevron-right"></i>|</a></li>-->
<!--                            </ul>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <!-- Modal -->
                <div class="modal fade modal-quick-view" id="quickModal" tabindex="-1" role="dialog"
                     aria-labelledby="quickModal" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close modal-close-btn ml-auto" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="product-details-modal">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <div class="product-details-slider sb-slick-slider arrow-type-two"
                                             data-slick-setting='{
                                                  "slidesToShow": 1,
                                                  "arrows": false,
                                                  "fade": true,
                                                  "draggable": false,
                                                  "swipe": false,
                                                  "asNavFor": ".product-slider-nav"
                                                }'>
                                            <div class="single-slide">
                                                <img src="/template/image/products/product-1.png" alt="">
                                            </div>
                                            <div class="single-slide">
                                                <img src="/template/image/products/product-1.png" alt="">
                                            </div>
                                            <div class="single-slide">
                                                <img src="/template/image/products/product-1.png" alt="">
                                            </div>
                                            <div class="single-slide">
                                                <img src="/template/image/products/product-1.png" alt="">
                                            </div>
                                            <div class="single-slide">
                                                <img src="/template/image/products/product-1.png" alt="">
                                            </div>
                                        </div>
                                        <!-- Product Details Slider Nav -->
                                    </div>
                                    <div class="col-lg-7 mt--30 mt-lg--30">
                                        <div class="product-details-info pl-lg--30 ">
                                            <p class="tag-block">Tags: <a href="#">Movado</a>, <a
                                                        href="#">Omega</a></p>
                                            <h3 class="product-title">Beats EP Wired On-Ear Headphone-Black</h3>
                                            <ul class="list-unstyled">
                                                <li>Ex Tax: <span class="list-value"> £60.24</span></li>
                                                <li>Brands: <a href="#" class="list-value font-weight-bold">
                                                        Canon</a></li>
                                                <li>Product Code: <span class="list-value"> model1</span></li>
                                                <li>Reward Points: <span class="list-value"> 200</span></li>
                                                <li>Availability: <span class="list-value"> In Stock</span></li>
                                            </ul>
                                            <div class="price-block">
                                                <span class="price-new">£73.79</span>
                                                <del class="price-old">£91.86</del>
                                            </div>
                                            <div class="rating-widget">
                                                <div class="rating-block">
                                                    <span class="fas fa-star star_on"></span>
                                                    <span class="fas fa-star star_on"></span>
                                                    <span class="fas fa-star star_on"></span>
                                                    <span class="fas fa-star star_on"></span>
                                                    <span class="fas fa-star "></span>
                                                </div>
                                                <div class="review-widget">
                                                    <a href="">(1 Reviews)</a> <span>|</span>
                                                    <a href="">Write a review</a>
                                                </div>
                                            </div>
                                            <article class="product-details-article">
                                                <h4 class="sr-only">Product Summery</h4>
                                                <p>Long printed dress with thin adjustable straps. V-neckline
                                                    and wiring under the Dust with ruffles at the bottom
                                                    of the
                                                    dress.</p>
                                            </article>
                                            <div class="add-to-cart-row">
                                                <div class="count-input-block">
                                                    <span class="widget-label">Qty</span>
                                                    <input type="number" class="form-control text-center"
                                                           value="1">
                                                </div>
                                                <div class="add-cart-btn">
                                                    <a href="" class="btn btn-outlined--primary"><span
                                                                class="plus-icon">+</span>Add to Cart</a>
                                                </div>
                                            </div>
                                            <div class="compare-wishlist-row">
                                                <a href="" class="add-link"><i class="fas fa-heart"></i>Add to
                                                    Wish List</a>
                                                <a href="" class="add-link"><i class="fas fa-random"></i>Add to
                                                    Compare</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <div class="widget-social-share">
                                    <span class="widget-label">Share:</span>
                                    <div class="modal-social-share">
                                        <a href="#" class="single-icon"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#" class="single-icon"><i class="fab fa-telegram-plane"></i></a>
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
