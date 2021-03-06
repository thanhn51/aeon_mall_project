@extends('core.master')
@section('content')


    <div class="product-big-title-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="product-bit-title text-center">
                        <h2>Shop</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="single-product-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Search Products</h2>
                        <form action="">
                            @csrf
                            <input type="text" placeholder="Search products...">
                            <input type="submit" value="Search">
                        </form>
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Products</h2>
                        @foreach($products as $key => $product)
                            @if($key>4)
                                @break
                            @endif
                            <div class="thubmnail-recent">
                                @foreach($product->images as $image)
                                    <img src="{{asset("storage/uploads/$product->id/$image->image")}}"
                                         class="recent-thumb" alt="">
                                    @break
                                @endforeach
                                <h2><a href="{{route('product.detail',$product->id)}}">{{$product->product_name}}</a></h2>
                                <div class="product-sidebar-price">
                                    <ins>{{$product->unit_price." VNĐ"}}</ins>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="single-sidebar">
                        <h2 class="sidebar-title">Recent Posts</h2>
                        <ul>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                            <li><a href="">Sony Smart TV - 2015</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="product-content-right">
                        <div class="product-breadcroumb">
                            <a href="{{route('product.index')}}">Home</a>
                            <a href="">{{$product1->brand->name}}</a>
                            <a href="">{{$product1->product_name}}</a>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="product-images">


                                    <div class="product-main-img">
                                        @foreach($product1->images as $image)
                                            <img src="{{asset("storage/uploads/$image->product_id/$image->image")}}"
                                                 alt="">
                                            @break
                                        @endforeach

                                    </div>

                                    <div class="product-gallery">
                                        @foreach($product1->images as $key => $image)
                                            @if($key > 0)
                                                <img src="{{asset("storage/uploads/$image->product_id/$image->image")}}"
                                                     alt="">
                                            @endif
                                        @endforeach
                                        {{--                                        <img src="img/product-thumb-3.jpg" alt="">--}}
                                    </div>


                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="product-inner">
                                    <h2 class="product-name">{{$product1->product_name}}</h2>
                                    <div class="product-inner-price">
                                        <ins>{{number_format($product1->unit_price)." VNĐ"}}</ins>
                                    </div>

                                    <form action="{{ route('product.addToCart', $product->id) }}" class="cart">
                                        @csrf
                                        <div class="quantity">
                                            <input type="number" size="4" class="input-text qty text" title="Qty"
                                                   value="1" name="quantity" min="1" step="1">
                                        </div>
                                        <button class="add_to_cart_button" type="submit">Add to cart</button>
                                    </form>

                                    <div class="product-inner-category">
                                        <p>
                                            Category:@foreach($categories as $category) <a
                                                href="">{{$category->name}}</a>,@endforeach.
                                            <br>
                                            Brand:@foreach($brands as $brand) <a href="">{{$brand->name}}</a>
                                            ,@endforeach.
                                        </p>
                                    </div>

                                    <div role="tabpanel">
                                        <ul class="product-tab" role="tablist">
                                            <li role="presentation" class="active"><a href="#home" aria-controls="home"
                                                                                      role="tab" data-toggle="tab">Description</a>
                                            </li>
                                            <li role="presentation"><a href="#profile" aria-controls="profile"
                                                                       role="tab" data-toggle="tab">Reviews</a></li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane fade in active" id="home">
                                                <h2>Product Description</h2>
                                                <p>{{$product->description}}</p>
                                            </div>
                                            <div role="tabpanel" class="tab-pane fade" id="profile">
                                                <h2>Reviews</h2>
                                                <div class="submit-review">
                                                    <p><label for="name">Name</label> <input name="name" type="text">
                                                    </p>
                                                    <p><label for="email">Email</label> <input name="email"
                                                                                               type="email"></p>
                                                    <div class="rating-chooser">
                                                        <p>Your rating</p>

                                                        <div class="rating-wrap-post">
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                            <i class="fa fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p><label for="review">Your review</label> <textarea name="review"
                                                                                                         id="" cols="30"
                                                                                                         rows="10"></textarea>
                                                    </p>
                                                    <p><input type="submit" value="Submit"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div class="related-products-wrapper">
                            <h2 class="related-products-title">Related Products</h2>
                            <div class="related-products-carousel">
                                @foreach($relate_brand_products as $product)
                                    <div class="single-product">
                                        <div class="product-f-image">
                                            @foreach($product->images as $image)
                                                <img src="{{asset("storage/uploads/$product->id/$image->image")}}"
                                                     alt="">
                                                @break
                                            @endforeach
                                            <div class="product-hover">
                                                <a href="" class="add-to-cart-link"><i class="fa fa-shopping-cart"></i>
                                                    Add
                                                    to cart</a>
                                                <a href="{{route('product.detail',$product->id)}}"
                                                   class="view-details-link"><i class="fa fa-link"></i> See
                                                    details</a>
                                            </div>
                                        </div>

                                        <h2>
                                            <a href="{{route('product.detail',$product->id)}}">{{$product->product_name}}</a>
                                        </h2>

                                        <div class="product-carousel-price">
                                            <ins>{{$product->unit_price." VNĐ"}}</ins>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="footer-top-area">
        <div class="zigzag-bottom"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="footer-about-us">
                        <h2>u<span>Stora</span></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis sunt id doloribus vero
                            quam laborum quas alias dolores blanditiis iusto consequatur, modi aliquid eveniet eligendi
                            iure eaque ipsam iste, pariatur omnis sint! Suscipit, debitis, quisquam. Laborum commodi
                            veritatis magni at?</p>
                        <div class="footer-social">
                            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-youtube"></i></a>
                            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">User Navigation </h2>
                        <ul>
                            <li><a href="">My account</a></li>
                            <li><a href="">Order history</a></li>
                            <li><a href="">Wishlist</a></li>
                            <li><a href="">Vendor contact</a></li>
                            <li><a href="">Front page</a></li>
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-menu">
                        <h2 class="footer-wid-title">Categories</h2>
                        <ul>
                            @foreach($products as $product)
                                <li><a href="{{route('product.detail',$product->id)}}">{{$product->product_name}}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="col-md-3 col-sm-6">
                    <div class="footer-newsletter">
                        <h2 class="footer-wid-title">Newsletter</h2>
                        <p>Sign up to our newsletter and get exclusive deals you wont find anywhere else straight to
                            your inbox!</p>
                        <div class="newsletter-form">
                            <input type="email" placeholder="Type your email">
                            <input type="submit" value="Subscribe">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="copyright">
                        <p>&copy; 2015 uCommerce. All Rights Reserved. <a href="http://www.freshdesignweb.com"
                                                                          target="_blank">freshDesignweb.com</a></p>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="footer-card-icon">
                        <i class="fa fa-cc-discover"></i>
                        <i class="fa fa-cc-mastercard"></i>
                        <i class="fa fa-cc-paypal"></i>
                        <i class="fa fa-cc-visa"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

