<?php
function limit_words($string, $word_limit)
{
    $words = explode(" ", $string);
    return implode(" ", array_splice($words, 0, $word_limit));
}
?>


<div class="row">
    <?php foreach ($product as $row): ?>
        <div class="col-lg-4">
            <div class="card">
                <img class="card-img-top img-responsive"
                    src="<?= base_url('public/foto_product/' . $row->foto_product) ?>"
                    alt="Foto <?= esc($row->nama_product) ?>">
                <div class="card-body">
                    <div class="d-flex no-block align-items-center mb-3">
                        <span class="d-flex align-items-center">
                            <i class="ti ti-calendar me-1 fs-5"></i>
                            <?= date('d M Y', strtotime($row->created_at ?? 'now')) ?>
                        </span>
                        <div class="ms-auto">
                            <a href="javascript:void(0)" class="link text-muted">
                                <i class="ti ti-message-circle me-1 fs-5"></i>
                                <?= $row->total_komentar ?? 0 ?> Comments
                            </a>
                        </div>
                    </div>
                    <p style="font-size: medium; font-weight: bold;">
                        <?= esc($row->nama_product) ?>
                    </p>
                    <p class="mb-0 mt-2 text-muted">
                        <?= esc(limit_words($row->keterangan, 30)) ?><?= str_word_count($row->keterangan) > 30 ? '...' : '' ?>
                    </p>

                    <div class="text-end">
                        <a href="<?php echo base_url('product/detail/' . $row->idproduct) ?>">
                            <button class="btn btn-primary rounded-pill mt-3">
                                Read more
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>