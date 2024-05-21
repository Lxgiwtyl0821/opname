<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
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
      $('#table_1').DataTable();
      $('#table').DataTable();
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