<style>
    .f-right{
        float: right !important;
    }
     div.dataTables_paginate {
        margin: 0 !important;
        white-space: nowrap !important;
        text-align: right !important;
    }
    div.dataTables_paginate ul.pagination {
        margin: 2px 0 !important;
        white-space: nowrap !important;
        justify-content: flex-end !important;
    }
    @media screen and (max-width: 767px) {
        div.dataTables_length,div.dataTables_filter,div.dataTables_info,div.dataTables_paginate {
            text-align: center;
        }
        div.dataTables_paginate ul.pagination {
            justify-content: center !important;
        }
    }
</style> 

<div class="row">
    <div class="col-sm-12 col-md-5"><div class="dataTables_info" id="datatable_info" role="status" aria-live="polite">หน้าที่ จากทั้งหมด หน้า จำนวนข้อมูล,รายการ</div></div>
    <div class="col-sm-12 col-md-7">
        <div class="dataTables_paginate paging_simple_numbers" id="datatable_paginate">
            <ul class="pagination">
                <?php if ($pager->hasPrevious()) : ?>
                    <li class="paginate_button page-item previous disabled" id="datatable_previous">
                        <a href="<?= $pager->getFirst() ?>" aria-controls="datatable" data-dt-idx="0" tabindex="0" class="page-link"><?= lang('Pager.first') ?></a>
                    </li>
                <?php endif ?>
                <?php foreach ($pager->links() as $link) : ?>
                    <li class="paginate_button page-item <?= $link['active'] ? 'active' : '' ?>"><a href="<?= $link['uri'] ?>" aria-controls="datatable" data-dt-idx="2" tabindex="0" class="page-link"><?= $link['title'] ?></a></li>
                <?php endforeach ?>
                <?php if ($pager->hasNext()) : ?>
                    <li>
                        <a href="<?= $pager->getNext() ?>" aria-label="<?= lang('Pager.next') ?>">
                            <span aria-hidden="true"><?= lang('Pager.next') ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= $pager->getLast() ?>" aria-label="<?= lang('Pager.last') ?>">
                            <span aria-hidden="true"><?= lang('Pager.last') ?></span>
                        </a>
                    </li>
                    <li class="paginate_button page-item next" id="datatable_next">
                            <a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">»</a></li>
                <?php endif ?>
                <li class="paginate_button page-item next" id="datatable_next"><a href="#" aria-controls="datatable" data-dt-idx="3" tabindex="0" class="page-link">»</a></li>
            </ul>
        </div>
    </div>
</div>

