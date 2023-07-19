<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Просмотр № <?=$cart_u_info->id?></h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>
                        <li class="breadcrumb-item"><a href="<?= site_url('admin/cart_admin') ?>"> Назад</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="tabbable">
	<ul class="nav nav-tabs" role="tablist">
            
                <li class="nav-item"><a class="nav-link active" href="#tab1" data-toggle="tab">Информация</a></li>
                 <li class="nav-item"><a class="nav-link" href="#tab2" data-toggle="tab">Товары</a></li>
           
        </ul>
	<div class="tab-content">
	
			<div class="tab-pane fade show active" id="tab1">

                
<div class="card">
     <div class="card-body">
        <div class="row">
            <div class="col-md-4">
                <div class="mt-0">
                    <h6 class="mb-1">Дата:</h6>
                    <p><?=date('d-m-Y', strtotime($cart_u_info->created_date))?></p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">Покупатель:</h6>
                    <p> <?=@$cart_u_info->last_name?> <?=@$cart_u_info->first_name?> <?//=@$cart_u_info->middle_name?></p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">Адрес:</h6>
                    <p><?=@$cart_u_info->address;?></p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">Телефон:</h6>
                    <p>  <?=@$cart_u_info->phone;?> </p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">E-mail:</h6>
                   <p><?=(@$post->email) ? @$post->email : 'Не указан'?></p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="mt-1">
                <h6 class="mb-1">Общая сумма:</h6>
                 <p>  <?=@number_format($cart_u_info->price, 0);?> </p>
                 </div>
                 <div class="mt-1">
                <h6 class="mb-1">Количество товаров:</h6>
                 <p>  <?=$cart_u_info->count?> </p>
                 </div>
                 <div class="mt-1">
                    <h6 class="mb-1">Способ оплаты:</h6>
                   <p><?php 
                        $pay = getPayM(@$cart_u_info->payment);
                   ?>
                   <?=($pay) ? _t($pay->p_title) : 'Нет'?>
                  <!-- <?php if($cart_u_info->payment == '1'){?>
						 Система Click	
            <?php } elseif($cart_u_info->payment == '2'){?>
              Платежная система Payme
            <?php } elseif($cart_u_info->payment == '3') {?>
            Оплата наличными
            <?php }elseif($cart_u_info->payment == '4') {?>
            Оплата банковской картой при получении
           
             <?php } elseif($cart_u_info->payment == '5'){?> 
      Платежная система Payme
      <?php } elseif($cart_u_info->payment == '7') {?>         
      Система Click 
 
      <?php } elseif($cart_u_info->payment == '6') {?> 
       MBank       
       <?php } elseif($cart_u_info->payment == '8') {?> 
       Visa       
       <?php } elseif($cart_u_info->payment == '9') {?> 
       PayPal  
      <?php }?> --></p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">Дата доставки:</h6>
                    
                   <p><?=to_date('d.m.Y',$cart_u_info->dates)?></p>
                </div>
                <div class="mt-1">
                    <h6 class="mb-1">Время доставки:</h6>
                    
                   <p><?=$cart_u_info->delivery_time?></p>
                </div>
                <div class="mt-1" style="display: none;">
                    <h6 class="mb-1">Тип доставки:</h6>
                    <?php 
                    $del = getDelM($cart_u_info->type_delivery);
                    ?>
                   <p><?=($del) ? _t($del->d_title) : 'Нет'?></p>
                </div>
        </div>
      
        
    </div>
</div>

			</div>
            
<?=form_open_multipart('admin/cart_admin/save', array('class'=>'form-horizontal my_form'))?>
<style>
.form-horizontal .control-label {padding-top: 0px;}
</style>
	
  
    <?php if($cart_u_info->payment == '2'){?>
        	<div class="form-group">
		 <label class="control-label" for="focusedInput"><?=lang('status')?></label>
		 <div class="controls">
       <select name="state" class="form-control input-xlarge focused">		
               <option value="3" <?=$cart_u_info->state == 3?'selected="selected"':'';?>>Отменено</option>
               
                <option value="2" <?=$cart_u_info->state == 2?'selected="selected"':'';?>>Оплачено</option>
                <option value="1" <?=$cart_u_info->state == 1?'selected="selected"':'';?>>В ожидании</option>
			</select>
		</div>
	</div>
    <?php }else{?>
	<div class="form-group">
		 <label class="control-label" for="focusedInput"><?=lang('status')?></label>
		 <div class="controls">
       <select name="status" class="form-control input-xlarge focused">		
               <option value="canceled" <?=$cart_u_info->status == 'canceled'?'selected="selected"':'';?>>Отменено</option>
               <!--<option value="denied" <?=$cart_u_info->status == 'denied'?'selected="selected"':'';?>>Отказано</option>
                <option value="processed" <?=$cart_u_info->status == 'processed'?'selected="selected"':'';?>>Обработанные</option>
               <option value="processing" <?=$cart_u_info->status == 'processing'?'selected="selected"':''; ?>>В обработке</option>
               <option value="reversed"  <?=$cart_u_info->status == 'reversed'?'selected="selected"':'';?>>Возвращено</option>
                <option value="voided" <?=$cart_u_info->status == 'voided'?'selected="selected"':'';?>>Аннулировано</option>
                <option value="shipped"  <?=$cart_u_info->status == 'shipped'?'selected="selected"':'';?>>Поставляется</option>-->
                <option value="complete" <?=$cart_u_info->status == 'complete'?'selected="selected"':'';?>>Оплачено</option>
                <option value="pending" <?=$cart_u_info->status == 'pending'?'selected="selected"':'';?>>В ожидании</option>
			</select>
		</div>
	</div>
    <?php }?>
    
     <?php 
     /*
      <!--<?php if($cart_u_info->payment == '1' || $cart_u_info->payment == '2'){?>
     	<div class="control-group">
		 <label class="control-label" for="focusedInput">Кнопка оплаты</label>
		 <div class="controls">
       <select name="pay_status" class="input-xlarge focused">		
               <option value="active" <?=$cart_u_info->pay_status == 'active'?'selected="selected"':'';?>>Активный</option>
               
                <option value="inactive" <?=$cart_u_info->pay_status == 'inactive'?'selected="selected"':'';?>>Неактивный</option>
			</select>
		</div>
	</div>
     <?php }?>-->
     */
     ?>
    
    
    
    <div class="form-group">
		 <label class="control-label" for="focusedInput"><?=lang('status')?> доставки</label>
		 <div class="controls">
       <select name="status_delivery" class="form-control input-xlarge focused">		
               <option value="pending" <?=$cart_u_info->status_delivery == 'pending'?'selected="selected"':'';?>>В ожидании</option>
               <option value="delivered" <?=$cart_u_info->status_delivery == 'delivered'?'selected="selected"':'';?>>Доставлен</option>
               
			</select>
		</div>
	</div>
    	<input type="hidden" id="id" name="id" value="<?=@$cart_u_info->id?>"/>
    <div class="form-actions">
<a href="<?=site_url('admin/cart_admin')?>" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">Назад</a>
        <button type="submit" class="btn btn-primary mr-1 mb-1 waves-effect waves-light"><?=lang('save')?></button>
</div>

    
	<?//=msg()?>
</form>
            </div>
            <div class="tab-pane fade ecommerce-application" id="tab2">
                <section id="ecommerce-products" class="list-view">
                 <? foreach($cart as $post): 
                 $p = getPostsAll($post->product_id,'active');
                 
 ?>        
<div class="card ecommerce-card">
<?php if($p){?>
<div class="card-content" style="padding: 10px 0;min-height: 250px;">

<div class="item-img text-center">
    <?php if($p->url){?>
    <a href="<?=base_url("uploads/{$p->group}/{$p->url}")?>" class="fancybox">
        <img class="img-fluid" src="<?=base_url("uploads/{$p->group}/{$p->url}")?>" alt="img-placeholder" width="200">
        </a>
    <?php }else{?>
    <p style="font-size: 18px;font-weight: bold;">Нет фото</p>
    <?php }?>
</div>
<div class="card-body">
   
    <div class="item-name">
        <p>Артикул: <?=($p->vendor_code) ? $p->vendor_code : 'Не указан'?></p>
        <p>Количество: <?=$post->count?></p>
        <a href="<?//=$link?>"><?=char_lim(_t($p->title), 200)?></a>
        <!--<p class="item-company">By <span class="company-name">Google</span></p>-->
    </div>
    <div>
        <p class="item-description">
            <?//=char_lim(removeTags(_t($p->content)), 200)?>
        </p>
      
    </div>
</div>
<div class="item-options text-center" style="align-items: center;
    display: flex;
    justify-content: center;">
 
        
        <div class="item-cost">
            <h6 class="item-price">
              <p> Цена:</p> <p><?=number_format($post->price, 0, ',', ' ');?></p>
            </h6>
            <h6 class="item-price">
               <p>Общая сумма:</p> <p><?=number_format($post->price * $post->count, 0, ',', ' ');?></p>
            </h6>
            
        </div>
 
 
</div>
</div>

</div>
<?php }else{?>
<p style="text-align: center;
    font-size: 18px;
    color: red;
    padding: 15px 0;
    margin: 0;">В базе данных товара нет</p>
<?php }?>
<? endforeach; ?>
                </section>

			</div>
	
</div>

</div>
<?php 
/*

		
                    <!--<div class="control-group">
						<label class="control-label" for="focusedInput">Ориентир </label>
						<div class="controls">
						<p>	<?=@$cart_u_info->orientir;?></p>
						</div>
					</div>
                    <div class="control-group">
						<label class="control-label" for="focusedInput">Время заказа </label>
						<div class="controls">
						<p>	<?=@$cart_u_info->created_date;?></p>
						</div>
					</div>
                    	<div class="control-group">
						<label class="control-label" for="focusedInput">Дата доставки </label>
						<div class="controls">
						<p>	<?=@$cart_u_info->dates;?></p>
						</div>
					</div>
                    	<div class="control-group">
						<label class="control-label" for="focusedInput">Время доставки </label>
						<div class="controls">
						<p>	<?=@$cart_u_info->delivery_time;?></p>
						</div>
					</div>-->
              
                  
                  <!--<?php if(@$cart_u_info->delivery_price){?>
                    <div class="control-group">
						<label class="control-label" for="focusedInput">Стоимость доставки </label>
						<div class="controls">
						<p>	<?=@number_format($cart_u_info->delivery_price, 0);?> </p>
						</div>
					</div> 
					<?php }?>-->
                    
                   <!-- <?php if(@$cart_u_info->price_order){?>
                    <div class="control-group">
						<label class="control-label" for="focusedInput">Стоимость заказа </label>
						<div class="controls">
						<p>	<?=@number_format($cart_u_info->price_order, 0);?> </p>
						</div>
					</div> 
					<?php }?>-->
*/
?>