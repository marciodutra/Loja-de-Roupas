@extends('layouts.app')
@section('content')
<main class="pt-90">
    <div class="mb-4 pb-4"></div>
    <section class="shop-checkout container">
      <h2 class="page-title">Envio e finalização da compra</h2>
      <div class="checkout-steps">
        <a href="{{route('cart.index')}}" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">01</span>
          <span class="checkout-steps__item-title">
            <span>Carrinho de compras</span>
            <em>Gerencie sua lista de itens</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item active">
          <span class="checkout-steps__item-number">02</span>
          <span class="checkout-steps__item-title">
            <span>Envio e finalização da compra</span>
            <em>Confira sua lista de itens</em>
          </span>
        </a>
        <a href="javascript:void(0)" class="checkout-steps__item">
          <span class="checkout-steps__item-number">03</span>
          <span class="checkout-steps__item-title">
            <span>Confirmação</span>
            <em>Revise e envie seu pedido</em>
          </span>
        </a>
      </div>
      <form name="checkout-form" action="{{route('cart.place.an.order')}}" method="POST">
        @csrf
        <div class="checkout-form">
          <div class="billing-info__wrapper">
            <div class="row">
              <div class="col-6">
                <h4>DETALHES DO ENVIO</h4>
              </div>
              <div class="col-6">
              </div>
            </div>

            @if ($address)
                <div class="row">
                    <div class="col-md-12">
                        <div class="my-account__address-list">
                            <div class="my-account__address-list-item">
                                <div class="my-account__address-item__detail">
                                    <p>{{$address->name}}</p>
                                    <p>{{$address->address}}</p>
                                    <p>{{$address->landmark}}</p>
                                    <p>{{$address->city}}, {{$address->state}}, {{$address->coutry}}</p>
                                    <p>{{$address->zip}}</p>
                                    <br/>
                                    <p>{{$address->phone}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
            <div class="row mt-5">
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="name" required="" value="{{old('name')}}">
                  <label for="name">Nome completo *</label>
                  @error('name')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="phone" required="" value="{{old('phone')}}">
                  <label for="phone">Telefone *</label>
                  @error('phone')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="zip" required="" value="{{old('zip')}}">
                  <label for="zip">CEP *</label>
                  @error('zip')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating mt-3 mb-3">
                  <input type="text" class="form-control" name="state" required="" value="{{old('state')}}">
                  <label for="state">Estado *</label>
                  @error('state')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="city" required="" value="{{old('city')}}">
                  <label for="city">Cidade *</label>
                  @error('city')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="address" required="" value="{{old('address')}}">
                  <label for="address">Endereço *</label>
                  @error('address')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="locality" required="" value="{{old('locality')}}">
                  <label for="locality">Bairro *</label>
                  @error('locality')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-floating my-3">
                  <input type="text" class="form-control" name="landmark" required="" value="{{old('landmark')}}">
                  <label for="landmark">Ponto de referência *</label>
                  @error('landmark')<span class="text-danger">{{$message}}</span>@enderror
                </div>
              </div>
            </div>
            @endif
          </div>
          <div class="checkout__totals-wrapper">
            <div class="sticky-content">
              <div class="checkout__totals">
                <h3>Seu pedido</h3>
                <table class="checkout-cart-items">
                  <thead>
                    <tr>
                      <th>PRODUTO</th>
                      <th align="right">SUBTOTAL</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach (Cart::instance('cart') as $item)
                    <tr>
                      <td>
                        {{$item->name}} x {{$item->qty}}
                      </td>
                      <td align="right">
                        R$ {{$item->subtotal}}
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
                @if (Session::has('discounts'))
                    <table class="checkout-totals">
                        <tbody>
                            <tr>
                              <th>Subtotal</th>
                              <td class="text-right">R$ {{Cart::instance('cart')->subtotal()}}</td>
                            </tr>
                            <tr>
                              <th>Desconto {{Session::get('coupon')['code']}}</th>
                              <td class="text-right">R$ {{Session::get('discounts')['discount']}}</td>
                            </tr>
                            <tr>
                              <th>Subtotal após o desconto</th>
                              <td class="text-right">R$ {{Session::get('discounts')['subtotal']}}</td>
                            </tr>
                            <tr>
                              <th>Envio</th>
                              <td class="text-right">Grátis</td>
                            </tr>
                            <tr>
                              <th>IVA</th>
                              <td class="text-right">R$ {{Session::get('discounts')['tax']}}</td>
                            </tr>
                            <tr>
                              <th>Total</th>
                              <td class="text-right">R$ {{Session::get('discounts')['total']}}</td>
                            </tr>
                          </tbody>
                    </table>
                @else
                <table class="checkout-totals">
                  <tbody>
                    <tr>
                      <th>SUBTOTAL</th>
                      <td class="text-right">R$ {{Cart::instance('cart')->subtotal()}}</td>
                    </tr>
                    <tr>
                      <th>ENVIO</th>
                      <td class="text-right">Frete grátis</td>
                    </tr>
                    <tr>
                      <th>Taxa</th>
                      <td class="text-right">R$ {{Cart::instance('cart')->tax()}}</td>
                    </tr>
                    <tr>
                      <th>TOTAL</th>
                      <td class="text-right">R$ {{Cart::instance('cart')->total()}}</td>
                    </tr>
                  </tbody>
                </table>
                @endif
              </div>
              <div class="checkout__payment-methods">
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode1" value="card">
                  <label class="form-check-label" for="mode1">
                    Cartão de débito ou crédito
                  </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode2" value="paypal">
                    <label class="form-check-label" for="mode2">
                      Paypal
                    </label>
                  </div>
                <div class="form-check">
                  <input class="form-check-input form-check-input_fill" type="radio" name="mode" id="mode3" value="cod">
                  <label class="form-check-label" for="mode3">
                    Pagamento na entrega
                  </label>
                </div>

                <div class="policy-text">
                    Os seus dados pessoais serão utilizados para processar a sua encomenda, apoiar a sua experiência ao longo deste
                    site e para outros fins descritos em nossa <a href="terms.html" target="_blank">privacidade
                        política</a>.
                </div>
              </div>
              <button class="btn btn-primary btn-checkout">FAZER PEDIDO</button>
            </div>
          </div>
        </div>
      </form>
    </section>
  </main>
@endsection
