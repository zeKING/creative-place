<script src="<?=base_url().'assets/admin/chart/js/highcharts.js'?>"></script>
<script src="<?=base_url().'assets/admin/chart/js/highcharts-3d.js'?>"></script>
<script src="<?=base_url().'assets/admin/chart/js/modules/exporting.js'?>"></script>
 <div class="content-header row">
    <div class="content-header-left col-md-9 col-12 mb-2">
        <div class="row breadcrumbs-top">
            <div class="col-12">
                <h2 class="content-header-title float-left mb-0">Регистрация</h2>
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
<div id="container_pie" class="col-md-12"></div>
<script type="text/javascript">
    $(function () {
        $('#container_pie').highcharts({
                chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45
        },
        backgroundColor: null
    },
    <?php $all_count_pie = $teacher + $student;?>
    title: {
        text: 'Общая статистика (<?=$all_count_pie;?>)'
    },
    subtitle: {
       // text: '3D donut in Highcharts'
    },
    exporting: {
         enabled: true
},    
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            innerSize: 100,
            depth: 45,
            dataLabels: {
            enabled: true,           
            style: { fontFamily: '\'OpenSans\', sans-serif', lineHeight: '18px', fontSize: '17px' }
        }
        }
    },
            /*chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Пользователи'
            },
            tooltip: {
                pointFormat: '{series.name}: <b>{point.percentage}%</b>',
                percentageDecimals: 1
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        color: '#000000',
                        connectorColor: '#000000',
                        formatter: function() {
                            return '<b>'+ this.point.name +'</b>: '+ this.percentage.toFixed(2) +' %';
                        }
                    }
                }
            },*/
            series: [{
                type: 'pie',
                name: 'Количество',
                data: [
                    ['Ученики - <?=$student;?>',   <?=$student;?>],                    
                    {
                        name: 'Преподаватели - <?=$teacher?>',
                        y: <?=$teacher?>,
                        sliced: true,
                        selected: true
                    },
                ]
            }]
        });
    });


</script>