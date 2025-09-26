<div class="info kgb">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbKbp').DataTable({
                "ajax": "<?php base_url();?>getKgb/",
                "lengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"]]
            });
        });
    </script>
    <table id="tbKbp" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="25%">Nama / NIP</th>
                <th width="25%">Jabatan</th>
                <th width="10%">Pangkat</th>
                <th width="7%">Golongan</th>
                <th width="10%">Masa Kerja Golongan</th>
                <th width="7%">No. SK</th>
                <th width="7%">Tanggal SK</th>
                <th width="7%">KGB Terakhir</th>
                <th width="7%">KGB Selanjutnya</th>
            </tr>
        </thead>
    </table>
</div>