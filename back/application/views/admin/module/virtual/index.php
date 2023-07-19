<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Виртуальная приемная</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#">Виртуальная приемная</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="ajax">
<?php $this->load->view('admin/'.$sel.'/index_ajax'); ?>
</div>