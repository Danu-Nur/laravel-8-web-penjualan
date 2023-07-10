@extends('layouts.main')
@section('container')
    <header class="bg-dark text-white text-center py-5 mb-2">
        <h1>Welcome to Fashion Strore</h1>
        <p>Discover the latest collection of trendy fashion</p>
        <div class="row justify-content-center mb-3">
            <div class="col-md-6">
                <form action="/posts">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                    @endif
                    @if (request('author'))
                        <input type="hidden" name="author" value="{{ request('author') }}">
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." name="search"
                            value="{{ request('search') }}">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </header>

    <section class="container">
        <div class="row" id="listproduk">
        </div>
    </section>

    <footer class="bg-dark text-white text-center py-3">
        &copy; 2023 Fashion Store. All rights reserved.
    </footer>

    <script>
        $(document).ready(function() {
            $.ajax({
                url: 'api/produk',
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    // Mengonversi respons JSON ke dalam format yang sesuai
                    if (response.code === 200) {
                        var data = response.data;
                        var html = '';

                        $.each(data, function(index, item) {
                            html += '<div class="col-md-4 mt-2 mb-2">'
                            html += '<div class="card">'
                            html += '<img src="/uploads/fotoproduk/' + item.foto +
                                '" class="card-img-top" alt="Boots 3">'
                            html += '<div class="card-body">'
                            html += '<h5 class="card-title">' + item.produk + '</h5>'
                            html += '<p class="card-text">Price: Rp. ' + item.harga + '</p>'
                            html += '<a href="/" class="btn btn-primary">Buy Now</a>'
                            html += '</div>'
                            html += '</div>'
                            html += '</div>'
                        });

                        $('#listproduk').html(html);
                    } else {
                        console.log('Error: ' + response.message);
                    }
                }
            });
        });
    </script>
@endsection
