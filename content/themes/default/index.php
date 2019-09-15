
<?=$this->theme->header()?>
<!-- Main Content -->

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php foreach($posts as $post): ?>

            <div class="post-preview">
                <a href="post.html">
                    <h2 class="post-title">
                       <?=$post->title?>
                    </h2>
                    <h3 class="post-subtitle">
	                    <?=$post->content?>
                    </h3>
                </a>
                <p class="post-meta">Posted on <?=$post->date?></p>
            </div>
            <hr>
            <?php endforeach;?>
            <ul class="pager">
                <li class="next">
                    <a href="#">Older Posts &rarr;</a>
                </li>
            </ul>
        </div>
    </div>
</div>

<hr>
<?=$this->theme->footer()?>
