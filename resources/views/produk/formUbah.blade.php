@extends('template/layout')

@section('judul')
    Form Ubah Produk
@endsection

@section('konten')
<form id="formData">
    <input type="hidden" class="form-user-input" name="id_produk" value="{{ $data_view->id_produk }}">
	<table>
		<tr>
			<td>Kode Produk</td>
			<td>
				<input class="form-control form-user-input" type="text" name="kode_produk" required="" value="{{ $data_view->kode_produk }}">
			</td>
		</tr>
		<tr>
			<td>Nama Produk</td>
			<td>
				<input class="form-control form-user-input" type="text" name="nama_produk"  required="" value="{{ $data_view->nama_produk }}">
			</td>
		</tr>
		<tr>
			<td>Deskripsi Produk</td>
			<td>
				<textarea class="form-control form-user-input" name="deskripsi" required="">{{ $data_view->deskripsi }}</textarea>
			</td>
		</tr>
		<tr>
			<td>Stok</td>
			<td>
				<input class="form-control form-user-input" type="number" name="stok_produk" min="0"  required="" value="{{ $data_view->stok }}">
			</td>
		</tr>
		<tr>
			<td>Harga Jual</td>
			<td>
				<input class="form-control form-user-input" type="number" name="harga_jual" min="0" max="100000"  required="" value="{{ $data_view->harga }}">
			</td>
		</tr>
		<tr>
			<td>Foto Produk</td>
			<td>
				<input class="form-control form-user-input" type="file" name="foto_produk">
			</td>
		</tr>
		<tr>
			<td colspan="3">
				<input class="btn btn-primary" type="submit" name="submit" value="Simpan Data">
				<a href="{{ url('produk') }}" class="btn btn-danger">Kembali Ke Daftar Prouk</a>
			</td>
		</tr>
	</table>
</form>
@endsection

@section('script_custom')
<script>
    $(document).ready(function(){

        $('#formData').on('submit', function (e) {
            e.preventDefault();
            sendData();
        })

        function sendData() {
            var url_post = '{{ url("api/produk/input") }}';

            var dataForm = {};
            var allInput = $(".form-user-input");

            $.each (allInput, function (i, val) {
                dataForm[val['name']] = val['value'];
            });

            $.ajax(url_post, {
                type: 'PUT',
                data: dataForm,
                success: function (data, status, xhr) {
                    var data_str = JSON.parse(data);

                    alert(data_str['pesan']);
                },
                error: function (jqXHR, textStatus, errorMessage) {
                    alert('Error : ' + jqXHR.responseJSON.message);
                }
            })
        }
    })
</script>
@endsection
