<div class="col-12">
    <form id="formAdd">
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
                    <label for="category">Nama Kategori</label>
                    <select name="category" id="category" class="form-control select2-show-search category">
                        @foreach ($category as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                    </select>
                    <div class="invalid-feedback error-category"></div>
                </div>
                <div class="form-group">
                    <label for="name">Nama Produk</label>
                    <input type="text" class="form-control name" name="name" id="name" placeholder="masukkan nama produk">
                    <div class="invalid-feedback error-name"></div>
                </div>
                <div class="form-group">
                    <label for="price">Harga Beli Produk</label>
                    <input type="text" class="form-control price" name="price" id="price" placeholder="masukkan harga produk">
                    <div class="invalid-feedback error-price"></div>
                </div>
                <div class="form-group">
                    <label for="sell-price">Harga Jual Produk</label>
                    <input type="text" class="form-control sell_price" name="sell_price" id="sell-price" placeholder="masukkan harga jual produk">
                    <div class="invalid-feedback error-sell_price"></div>
                </div>
                <div class="form-group">
                    <label for="image">Foto Produk</label>
                    <input type="file" class="form-control image" name="image" id="image">
                    <div class="invalid-feedback error-image"></div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-save pull-right" type="button">
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
</script>