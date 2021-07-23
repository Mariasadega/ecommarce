<div class="row card_item_block" style="padding-left:30px;padding-right: 30px">
    <div class="col-xs-12">
        <div class="card mrg_bottom">
            <div class="page_title_block">
                <div class="col-md-5 col-xs-12">
                    <div class="page_title"><?= $page_title ?> Raja Ongkir</div>
                </div>
            </div>
            <div class="col-md-12 mrg-top">
                <form method="POST">
                    <?php
                    var_dump($ongkir);
                    ?>
                    <h4>Alamat Pengirim :</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Provinsi Pengirim</label>
                                <select id="provinsi" name="provinsi" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $pv) {
                                            echo "<option value='$pv[province_id]' " . ($pv['province_id'] == $this->input->post('provinsi') ? "selected" : " ") .
                                                "> $pv[province] </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kota Pengirim</label>
                                <select id="kota" name="kota" class="form-control">
                                    <option value="">Pilih Provinsi Dulu</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h4>Alamat Penerima :</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Provinsi Penerima</label>
                                <select id="provinsi_penerima" name="provinsi_penerima" class="form-control">
                                    <option value="">Pilih Provinsi</option>
                                    <?php
                                    if ($provinsi['rajaongkir']['status']['code'] == '200') {
                                        foreach ($provinsi['rajaongkir']['results'] as $province) {
                                            echo "<option value='$province[province_id]'" . ($pv['province_id'] == $this->input->post('provinsi_tujuan') ? "selected" : " ") .
                                                "> $province[province] </option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Kota Penerima</label>
                                <select id="kota_penerima" name="kota_penerima" class="form-control">
                                    <option value="">Pilih Provinsi Dulu</option>

                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleFormControlSelect1">Provinsi Expedisi</label>
                                <select id="expedisi" name="expedisi" class="form-control">
                                    <option value="">Pilih Expedisi</option>
                                    <?php
                                    $exp = [
                                        'jne' => 'Jalur Nugraha Ekakurir',
                                        'pos' => 'POS Indonesia',
                                        'tiki' => 'Citra Van Titipan Kilat',
                                        'rpx' => 'RPX Holding',
                                        'pandu' => 'Pandu Logistics',
                                        'wahana' => 'Wahana Prestasi Logistik',
                                        'sicepat' => 'SiCepat Express',
                                        'jnt' => 'J&T Express',
                                        'pahala' => 'Pahala Kencana Express',
                                        'sap' => 'SAP Express',
                                        'jet' => 'JET Express',
                                        'indah' => 'Indah Logistik',
                                        'dse' => '21 Express',
                                        'slis' => 'Solusi Ekspres',
                                        'first' => 'First Logistics',
                                        'ncs' => 'Nusantara Card Semesta',
                                        'star' => 'Star Cargo',
                                        'ninja' => 'Ninja Xpress',
                                        'lion' => 'Lion Parcel',
                                        'idl' => 'IDL Cargo',
                                        'rex' => 'Royal Express Indonesia',
                                        'ide' => 'ID Express',
                                        'sentral' => 'Sentral Cargo',
                                        'anteraja' => 'AnterAja'
                                    ];
                                    foreach ($exp as $ex => $value) {
                                        echo "<option value='$x'  " . ($pv['province_id'] == $this->input->post('expedisi') ? "selected" : " ") .
                                                "> $value </option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Berat (gram)</label>
                                <input class="form-control form-control-sm" type="text" placeholder="gram" name="berat"
                                    id="berat" value="<?= $this->input->post('berat') ?>">
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary pt-2">Proses</button>

                </form>
            </div>

        </div>
    </div>
</div>


<script>
document.getElementById('provinsi').addEventListener('change', function() {

    fetch("<?= base_url('admin/rajaongkir/getKota/') ?>" + this.value, {
            method: 'Get',
        }).then((response) =>
            response.text())
        .then((data) => {
            document.getElementById('kota').innerHTML = data
        })
});
document.getElementById('provinsi_penerima').addEventListener('change', function() {

    fetch("<?= base_url('admin/rajaongkir/getKota/') ?>" + this.value, {
            method: 'Get',
        })
        .then((response) => response.text())
        .then((data) => {
            document.getElementById('kota_penerima').innerHTML = data
        })
});
</script>