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

    $.notify.defaults({ autoHideDelay: 5000 });

    /* ============================ */
    /* Periode Laporan              
    /* ============================ */

    $('#submitPeriode').click(function() {
      var year = $('#doc_year').val();
      var periode = $('#doc_periode').val();

      window.location.href = "<?= base_url('sendReport') ?>?year=" + year + "&periode=" + periode;
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

    /* ============================ */
    /* Tentang Aplikasi           
    /* ============================ */

    function aboutApp()
    {
      Swal.fire({
        title: 'SIPP DOKLING v1.0',
        html: 'Dinas Lingkungan Hidup Kab. Bojonegoro &copy; 2022',
        icon: 'info'
      });
    }
  </script>
</body>
</html>