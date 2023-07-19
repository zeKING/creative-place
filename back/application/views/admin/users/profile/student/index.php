<style>
.show{
    display: block;
    visibility: visible;
}
</style>
            <div class="content-header row">
                <div class="content-header-left col-md-9 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                 <!--           <h2 class="content-header-title float-left mb-0">Профиль </h2>-->
                            <div class="breadcrumb-wrapper col-12" style="padding-left: 0;">
                                <ol class="breadcrumb" style="border: 0;padding-left: 0 !important;">
                                    <li class="breadcrumb-item"><a href="<?=base_url('admin')?>l">Главная</a>
                                    </li>
                                    
                                    <li class="breadcrumb-item active"> <a href="<?=site_url('admin/users/index/'.$user_type1)?>">Назад</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>              
            </div>
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <!-- left menu section -->
                        <div class="col-md-3 mb-2 mb-md-0">
                            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 <?=($sub_sel == 'about') ? 'active' : ''?>"  href="<?=site_url('admin/profile/user/'.$id.'/about')?>" aria-expanded="true">
                                    <i class="fa fa-user mr-50 font-medium-3" aria-hidden="true"></i>
                                       Профиль
                                    </a>
                                </li>
                                                           
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 <?=($sub_sel == 'teacher') ? 'active' : ''?>"  href="<?=site_url('admin/profile/user/'.$id.'/teacher')?>" aria-expanded="true">
                                    <i class="fa fa-user mr-50 font-medium-3" aria-hidden="true"></i>
                                       Учитель (Избранное)
                                    </a>
                                </li>
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 <?=($sub_sel == 'message') ? 'active' : ''?>"  href="<?=site_url('admin/profile/user/'.$id.'/message')?>" aria-expanded="true">
                                    <i class="fa fa-comments mr-50 font-medium-3" aria-hidden="true"></i>
                                       Cообщения
                                    </a>
                                </li>
                                
                                                               
                                
                                <li class="nav-item">
                                    <a class="nav-link d-flex py-75 <?=($sub_sel == 'password') ? 'active' : ''?>"  href="<?=site_url('admin/profile/user/'.$id.'/password')?>" aria-expanded="false">
                                        <i class="fa fa-key mr-50 font-medium-3"></i> Сменить пароль
                                    </a>
                                </li>
                                
                             
                            </ul>
                        </div>
                        <!-- right content section -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body">
                                    <style>
                                    .alert.alert-error {
                                    color: red;
                                    padding: 0;
                                    }
                                    </style>
                                       <h5><?=$user->fio?></h5> 
                                       <br />
                                      <?php @$this->load->view(@$page); ?>  
                                    </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page end -->

            </div>
