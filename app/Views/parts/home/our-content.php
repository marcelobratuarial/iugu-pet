
<!--? Blog Area Start -->
<div class="home-blog-area section-padding30 zin">
    <div class="container">
        <!-- Section Tittle -->
        <div class="row">
            <div class="col-lg-12">
                <div class="section-tittle text-center mb-50">
                    <span>Acompanhe nossas novidades</span>
                    <h2>Nosso conteúdo</h2>
                </div>
            </div>
        </div>
        <?php //print_r($lastPosts); ?>
        <div class="row">
            <?php foreach($lastPosts as $p ) : ?>
            <div class="col-xl-6 col-lg-6 col-md-6">
                <div class="home-blog-single mb-20">
                    <div class="blog-img-cap">
                        <div class="blog-img">
                            <img src="<?= base_url($p['imagem']) ?>" alt="">
                            <!-- Blog date -->
                            <div class="blog-date text-center">
                                <span><?= $p['dia']; ?></span>
                                <p><?= monthBR($p['mes']) ?></p>
                            </div>
                        </div>
                        <div class="blog-cap">
                            <p>
                            <?php 
                            $c = 1;
                            foreach($p["categorias"] as $id => $categoria) : ?>
                                <a href="<?= base_url("blog/cat/".slugify($categoria)) ?> "> <?= $categoria ?></a>
                                <?php if($c < count($p["categorias"])) :?> | 
                                <?php endif; ?>
                            <?php $c++;
                                endforeach; ?>
                            </p>
                            
                            <h3><a href="<?= base_url("blog/".slugify($p['post_title'])) ?>"><?= $p["post_title"] ?></a></h3>
                            <a href="<?= base_url("blog/".slugify($p['post_title'])) ?>" class="more-btn">Leia mais »</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
            
        </div>
    </div>
</div>
<!-- Blog Area End -->