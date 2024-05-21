<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.dataTables.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<script>
        @if(Session::has('success'))
        Swal.fire(
            'Success!',
            '{{ session('success') }}',
            'success'
        )
      @endif

      @if(Session::has('error'))
          Swal.fire(
              'Error!',
              '{{ session('error') }}',
              'Error'
          )
      @endif
      $(document).ready(function () {
      let title = $('#periode').text();
      new DataTable('#table', {
          buttons: [ 'pdf'],
          layout: {
          topStart: {
              buttons: [
                  {
                      extend: 'pdf',
                      text: 'Print Pdf',
                      exportOptions: {
                          modifier: {
                              page: 'current'
                          }
                      },
                      title: function () { return title },
                      customize: function(doc) {
                        doc.styles.table.body = {
                          widths: "100%",
                          alignment: 'center'
                        }   
                      }  
                  }
              ]
          }
        }
      });
      $('.hapus').on('click', function (e) {
 
        e.preventDefault();
        const href = $(this).attr('href');


        Swal.fire({
          title: 'Apakah anda yakin ?',
          text: "Data akan dihapus!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Hapus data !'
        }).then((result) => {
            if (result.isConfirmed) {
            document.location.href = href;
          }
        });

      });

      $('.edit').on('click',function(e){
           let id = $(this).data('id');
           $.ajax({
              type: "POST",
              url: "{{ route('barang.detail') }}",
              data: {id:id, "_token": $('#token').val()},
              success: function (data) {
                console.log(data);
                $('#id_barang').val(data.data.id);
                $('#nama_barang').val(data.data.nama_barang);
                $('#nama_konversi').val(data.data.nama_konversi);
                $('#id_satuan').val(data.data.id_satuan);
                $('#stock').val(data.data.stock);
                $('#editData').modal('toggle');
              }         
          });
      })


  });
</script>