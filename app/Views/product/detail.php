<div class="card shadow-none position-relative overflow-hidden mb-4">
    <div class="card-body d-flex align-items-center justify-content-between p-4">
        <h4 class="fw-semibold mb-0">Blog Detail</h4>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="#">Home</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Blog Detail</li>
            </ol>
        </nav>
    </div>
</div>

<div class="card rounded-2 overflow-hidden">
    <div class="position-relative">
        <a href="javascript:void(0)"><img src="<?= base_url('public/foto_product/' . $product->foto_product) ?>"
                class="card-img-top rounded-0 object-fit-cover" alt="..." height="440"></a>

    </div>
    <div class="card-body p-4">
        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Iago BSI</span>
        <h2 class="fs-8 fw-semibold mb-3"><?= esc($product->nama_product) ?></h2>
        <div class="d-flex align-items-center gap-4">

            <div class="d-flex align-items-center gap-2"><i class="ti ti-message-2 text-dark fs-5"></i><?= $product->total_komentar ?? 0 ?> Comments</div>
            <div class="d-flex align-items-center fs-2 ms-auto"><i class="ti ti-point text-dark"></i><?= date('d M Y', strtotime($product->created_at ?? 'now')) ?>
            </div>
        </div>
    </div>
    <div class="card-body border-top p-4">
        <h2 class="fs-8 fw-semibold mb-3">Detail product</h2>
        <p class="mb-3">
            <?= esc($product->keterangan) ?>
        </p>


        <div class="border-top mt-7 pt-7">
            <h3 class="fw-semibold">Quotes</h3>
            <div class="p-3 bg-light rounded border-start border-2 border-primary">
                <h6 class="mb-0 fs-4 fw-semibold"><i class="ti ti-quote fs-7"></i>Life is short, Smile while you still
                    have teeth!</h6>
            </div>
        </div>
    </div>
</div>

<?= $product->idproduct ?>
<div class="card">
    <div class="card-body">
        <h4 class="mb-4 fw-semibold">Post Comments</h4>
        <form id="formKomentar" enctype="multipart/form-data">
            <input type="hidden" name="product_id" value="<?= $product->idproduct ?>">
            <textarea name="komentar" class="form-control mb-2" rows="5"></textarea>
            <input type="file" name="foto" class="form-control mb-2" accept="image/*">
            <button type="submit" class="btn btn-primary">Post Comment</button>
        </form>

        <div class="d-flex align-items-center gap-3 mb-4 mt-7 pt-8">
            <h4 class="mb-0 fw-semibold">Comments</h4>
            <span class="badge bg-primary-subtle text-primary fs-4 fw-semibold px-6 py-8 rounded"><?= $product->total_komentar ?></span>
        </div>
        <div class="position-relative">
            <div id="listKomentar">
                <?php foreach ($komentar as $k): ?>
                    <div class="p-3 border rounded mb-3">
                        <strong><?= esc($k->nama) ?></strong>
                        <p><?= esc($k->komentar) ?></p>
                        <?php if ($k->foto): ?>
                            <img src="<?= base_url('uploads/komentar/' . $k->foto) ?>" class="img-thumbnail mb-2" style="max-width: 200px;">
                        <?php endif; ?>

                        <?php if (session('id') == $k->user_iduser): ?>
                            <button class="btn btn-sm btn-danger delete-komentar" data-id="<?= $k->id ?>">Delete</button>
                        <?php endif; ?>

                        <br>
                        <!-- reply -->
                        <div class="ms-4">
                            <?php foreach ($k->reply as $r): ?>
                                <div class="border p-2 mb-2">
                                    <strong><?= esc($r->nama) ?></strong>
                                    <p><?= esc($r->komentar) ?></p>
                                    <?php if ($r->foto): ?>
                                        <img src="<?= base_url('uploads/reply/' . $r->foto) ?>" class="img-thumbnail mb-2" style="max-width: 150px;">
                                    <?php endif; ?>

                                    <?php if (session('id') == $r->user_iduser): ?>
                                        <button class="btn btn-sm btn-danger delete-reply" data-id="<?= $r->idreply ?>">Delete</button>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                            <br>
                            <form class="formReply" data-id="<?= $k->id ?>" enctype="multipart/form-data">
                                <input type="text" name="reply" class="form-control mb-2" placeholder="Reply...">
                                <input type="file" name="foto" class="form-control mb-2" accept="image/*">
                                <button type="submit" class="btn btn-sm btn-primary">Reply</button>
                            </form>

                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    </div>
</div>


<script>
    $(document).ready(function() {


        $('#formKomentar').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: '<?= base_url("product/addKomentar") ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status === 'success') {
                        location.reload();
                    }
                }
            });
        });

        $(".delete-komentar").click(function() {
            let id = $(this).data("id");
            $.post("<?= base_url('product/deleteKomentar') ?>/" + id, function(res) {
                if (res.status == "deleted") {
                    location.reload();
                }
            }, "json");
        });


        $(document).on('submit', '.formReply', function(e) {
            e.preventDefault();
            let formData = new FormData(this);
            formData.append('komentar_id', $(this).data('id'));

            $.ajax({
                url: '<?= base_url("product/addReply") ?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(res) {
                    if (res.status === 'success') {
                        location.reload();
                    }
                }
            });
        });


        $(".delete-reply").click(function() {
            let id = $(this).data("id");
            $.post("<?= base_url('product/deleteReply') ?>/" + id, function(res) {
                if (res.status == "deleted") {
                    location.reload();
                }
            }, "json");
        });

    });
</script>