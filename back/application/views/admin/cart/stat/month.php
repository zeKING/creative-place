
<?php if($cart){?>
<?$months=array(
'1'=>'Jan',
'2'=>'Feb',
'3'=>'Mar',
'4'=>'Apr',
'5'=>'May',
'6'=>'Jun',
'7'=>'Jul',
'8'=>'Aug',
'9'=>'Sep',
'10'=>'Oct',
'11'=>'Nov',
'12'=>'Dec'
)?>
<script src="<?=admin_url().'chart/js/highcharts.js'?>"></script>
<script src="<?=admin_url().'chart/js/highcharts-3d.js'?>"></script>
<script src="<?=admin_url().'chart/js/modules/exporting.js'?>"></script>
<div id="chart" style="height: 400px;"></div>
<script type="text/javascript">

      
           Highcharts.chart('chart', {  
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Заказы - <?=count($cart)?>',
                x: -20 //center
            },
            xAxis: {
                categories: ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь',
                    'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь']
            },
            yAxis: {
                title: {
                    text: 'Количество заказов'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: 'Заказы',
                data: 
				[
				<?foreach($months as $month):?>
                <?$i=0?>
                <?foreach($cart as $user):?>
				<?if ($month==date('M',strtotime($user->created_date))):?>

				<?$i++?>
				<?endif?>
				
				<?endforeach?>
				<?=$i?>,
				<?endforeach?>
				]
                
            }
            ]
        });
   
</script>
<?php }else{?>
<p style="font-size: 20px;
    color: red;
    text-align: center;
    min-height: 300px;
    align-items: center;
    display: flex;
    justify-content: center;">Нет данных</p>
<?php }?>