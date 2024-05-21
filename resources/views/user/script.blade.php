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
              url: "{{ route('user.detail') }}",
              data: {id:id, "_token": $('#token').val()},
              success: function (data) {
                console.log(data);
                $('#id_user').val(data.data.id);
                $('#name').val(data.data.name);
                $('#email').val(data.data.email);
                $('#alamat').val(data.data.alamat);
                $('#no_telp').val(data.data.no_telp);
                $('#role').val(data.data.role);
                $('#editData').modal('toggle');
              }         
          });
      })


  });
</script>