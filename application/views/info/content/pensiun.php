<div class="info pensiun">
    <script type="text/javascript">
        $(document).ready(function() {
            $('#tbPensiun').DataTable({
                "ajax": "<?php base_url();?>getPensiun",
                "lengthMenu": [[5,10, 25, 50, 100, -1], [5,10, 25, 50, 100, "All"]]
            });
        });
    </script>
    <table id="tbPensiun" class="table table-hover table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th width="5%">No</th>
                <th width="58%">Nama / NIP</th>
                <th width="20%">Jabatan</th>
                <th width="7%">Usia</th>
                <th width="10%">TMT Pensiun</th>
            </tr>
        </thead>
    </table>
</div>