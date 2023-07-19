<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0"><?=lang('manage_contacts')?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="#!" onclick="history.go(-1)"><?=lang('manage_contacts')?></a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>    
</div>
<div class="card">
    <div class="card-header">
        <h4>Информация</h4>
    </div>
    <div class="card-body">
        <div class="mt-0">
            <h6 class="mb-1">Дата:</h6>
            <p><?=date('d-m-Y', strtotime($contact->date))?></p>
        </div>
         <?php if($contact->name){?>
        <div class="mt-1">
            <h6 class="mb-1">Имя:</h6>
            <p><?=$contact->name?></p>
        </div>
        <?php }?>
        <?php if($contact->email){?>
        <div class="mt-1">
            <h6 class="mb-1">Email:</h6>
            <p><?=$contact->email?> </p>
        </div>
        <?php }?>
        <?php if($contact->phone){?>
        <div class="mt-1">
            <h6 class="mb-1">Телефон:</h6>
            <p><?=$contact->phone?></p>
        </div>
        <?php }?>
        
    </div>
</div>
