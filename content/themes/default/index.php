
<?=$this->theme->header()?>
<!-- Main Content -->

<div class="container">
    <div class="row">
        <div class="col-lg-8 col-lg-offset-2 col-md-10 col-md-offset-1">
            <?php Paginator::paginate($di,'Post', 2, $paginator_offset);?>

        </div>
    </div>
</div>

<hr>
<?=$this->theme->footer()?>
