<div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Заказы - Статистика</h2>
                <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?=base_url('admin')?>">Главная</a>
                        </li>   
                       
                    </ol>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<style>
.loading-block{
        text-align: center;
    align-items: center;
    display: flex;
    justify-content: center;
        min-height: 300px;
}
.filter-block{
    display: flex;
}
</style>
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                 <div class="card-header">
                    <h4 class="card-title">По месяцам за <span id="year"><?=date('Y')?></span> год</h4>
                   
                    
                 </div>
                 <div class="card-content">
                    
                    <div class="card-body">
                        <div class="filter-block">
                    <input type="text" class="form-control" id="date" style="width: 20%;" placeholder="Фильтр по годам" />
                   <button type="button" class="btn btn-primary send">Применить</button>
                    </div>
                        <div style="min-height: 300px;">
                            <div class="month">
                            
                            </div>
                            <div class="loading-block">
                                <div class="spinner-border"></div>
                            </div>                            
                        </div>
                    </div>
                 </div>
            </div>           
        </div>
    </div>
</section>
<script type="text/javascript">
window.onload = function(){
   setTimeout(function(){
       get_month();
   }, 5000);
};
$('.send').on('click', function() {    
    if(!$('#date').val()) {
        alert('Выберите год');
    }else{
        $('.loading-block').show();
         $('.month').html('');
         $('#year').text($('#date').val());
         get_month();
    }
});
function get_month(){
    var year_input = $('#date').val();
     $.ajax({ 
        url: base_url + "admin/cart_admin/stat_ajax_month?year="+year_input,       
        success: function(data){
            $('.loading-block').hide();
           $('.month').html(data);
        }
    });
}
      $("#date").datepicker( {
        format: "yyyy", // Notice the Extra space at the beginning
        viewMode: "years", 
        minViewMode: "years"
    });
    </script>