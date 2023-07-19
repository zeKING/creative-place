<div id="ajax">
    <table class="table table-striped table-bordered">
        <thead>
        <tr>
            <!-- <th width="1%">#</th>-->
            <th width="10%">Дата</th>
            <th width="40%">Имя</th>
            <!--<th width="1%">Email</th>-->
            <!--<th width="200" style="width: 15px;">Телефон</th>-->
            <!--<th width="350">Описание</th>-->
            <th width="1%"></th>
            <th width="1%"></th>
        </tr>
        </thead>
        <tbody>
        <? foreach($contacts as $contact): ?>
            <tr>

                <td><?=date('d-m-Y', strtotime($contact->created_on))?></td>
                <td><?=$contact->name?></td>

                <td>
                    <div class="btn-group">
                        <a href="<?=site_url('admin/works/view/'.$contact->id)?>" class="btn btn-small btn-info"><i class="icon-edit icon-white"></i></a>
                    </div>
                </td>
                <td>
                    <div class="btn-group">
                        <a href="<?=site_url('admin/works/delete/'.$contact->id)?>" class="btn btn-small delete-btn delete"><i class="icon-trash"></i></a>
                    </div>
                </td>
            </tr>
        <? endforeach; ?>
        </tbody>
    </table>
</div>
<?php $this->load->view('admin/components/pagination'); ?>