<div class="col-12">
    <form id="formEdit">
        <div class="card">
            <div class="card-header">
                <div class="card-title">Data Produk</div>
                <div class="card-options">
                    <button class="btn btn-info btn-data" type="button">
                        <i class="fa fa-eye"></i> Data
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <input type="hidden" name="id" id="id" value="{{$product->id}}">
                    <label for="category">Nama Kategori</label>
                    <select name="category" id="category" class="form-control select2-show-search">
                        @foreach ($category as $key => $value)
                        <option value="{{$key}}" {{$product->category_id == $key ? 'selected' : ''}}>{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-category"></div>
                </div>
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama produk" value="{{$product->name}}">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="price">Harga Produk</label>
                    <input type="text" class="form-control price" name="price" id="price" placeholder="masukkan harga produk" value="{{convertToRupiah($product->price)}}">
                    <div class="invalid-feedback error-price"></div>
                </div>
                <div class="form-group">
                    <label for="image">Foto Produk</label>
                    <input type="file" class="form-control image" name="image" id="image">
                    <span class="text-muted text-small">*kosongkan jika tidak ingin mengganti foto</span>
                    <div class="invalid-feedback error-image"></div>
                </div>
                <div class="form-group">
                    <label for="stock">Stok Produk</label>
                    <input type="text" class="form-control stock" name="stock" id="stock" placeholder="masukkan stok produk" value="{{$product->attribute != null ? $product->attribute->stock : 0}}">
                    <div class="invalid-feedback error-stock"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-update pull-right" type="button">
                        <i class="fa fa-save"></i> Simpan
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $('.select2-show-search').select2({
        minimumResultsForSearch: '',
        // width: '100%'
    });

    $("#stock").inputFilter(function(value) {
        return /^\d*$/.test(value);
    },"Hanya mengandung angka");

</script>