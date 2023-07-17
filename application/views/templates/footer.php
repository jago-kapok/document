        </div>
      </main>

      <footer class="footer shadow mt-1">
        <div class="container-fluid">
          <div class="row text-muted">
            <div class="col-12 text-start">
              <p class="mb-0">
                <a class="text-muted" href="https://dlh.bojonegorokab.go.id/" target="_blank"><strong>Dinas Lingkungan Hidup Kab. Bojonegoro</strong></a> &copy; 2022
              </p>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>

  <!-- <script src="<?= base_url('assets/'); ?>dist/js/bootstrap.bundle.min.js"></script> -->
  <script src="<?= base_url('assets/'); ?>dist/js/app.js"></script>
  <!-- DataTables -->
  <script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.js"></script>
  <script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
  <script src="<?= base_url('assets/'); ?>dist/js/fnPagingInfo.js"></script>

  <!-- AOS -->
  <script src="<?= base_url('assets/'); ?>dist/js/aos.js"></script>
  <script>
    AOS.init({
      delay: 100,
      duration: 1000,
    });
  </script>

  <script>
    $(".form-control").attr("autocomplete", "off");

    /* ============================ */
    /* Periode Laporan              
    /* ============================ */

    $('#submitPeriode').click(function() {
      var year = $('#doc_year').val();
      var periode = $('#doc_periode').val();

      window.location.href = "<?= base_url() ?>sendreport?year=" + year + "&periode=" + periode;
    });

    /* ============================ */
    /* Number Only              
    /* ============================ */

    $('.number').keypress(function(event){
      var charCode = event.keyCode
      if (charCode > 31 && (charCode != 46 &&(charCode < 48 || charCode > 57)))
        return false;
      return true;
    });

    $.notify.defaults({
      autoHideDelay: 5000
    });

    /* About App */
    function aboutApp() {
      Swal.fire({
        title: 'SIPP DOKLING v1.0',
        html: "Dinas Lingkungan Hidup Kab. Bojonegoro &copy; 2022",
        icon: 'warning',
        showConfirmButton: true
      });
    }

    /* Lihat Catatan Penolakan */
    function lihatCatatan(note) {
      Swal.fire({
        title: 'NOTE !',
        text: note,
        icon: 'info',
        showConfirmButton: true
      });
    }

    // Penggantian Password
    $("#form_change_password").submit(function (event) {
      event.preventDefault();
      var data = new FormData($("#form_change_password")[0]);

      $.ajax({
        type: "POST",
        url: "<?= base_url() ?>admin/changePassword",
        data: data,
        dataType: "json",
        cache       : false,
        contentType : false,
        processData : false,
      })
      .done(function (data) {
        $("#ubahPassword").modal('hide');

        if(data.success == true) {
          Swal.fire({
            icon: 'success',
            title: 'Password Berhasil Diubah !',
            showConfirmButton: false,
            timer: 1200
          });
        } else {
          $.each(data.errors, function(index, value) {
            $.notify(value, "error");
          })
        }
      })
      .fail(function () {
        Swal.fire({
          icon: 'warning',
          title: 'Koneksi Bermasalah !',
          text: 'Tidak dapat terhubung dengan server.',
          showConfirmButton: true
        })
      });
    });
  </script>
</body>
</html>