@extends('layouts.app')
@section('content')
<style>
    .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0rem rem 0rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0rem 0rem 0rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Detalhes dos pedidos</h2>
        <div class="row">
            <div class="col-lg-2">
                @include('user.account-nav')
            </div>
            <div class="col-lg-10">
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">                        
                        <div class="row">
                            <div class="col-6">
                                <h5>Detalhes do pedido</h5>
                            </div>
                                <div class="col-6 text-right">
                                    <a class="btn btn-sm btn-danger" href="{{route('user.orders')}}">Voltar</a>
                                </div>                           
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table  table-bordered table-striped table-transaction">
                            <tr>
                                <th>Nº pedido</th>
                                <td>{{$order->id}}</td>
                                <th>Telefone</th>
                                <td>{{$order->phone}}</td>
                                <th>CEP</th>
                                <td>{{$order->zip}}</td>
                            </tr>
                            <tr>
                                <th>Data do pedido</th>
                                <td>{{$order->created_at}}</td>
                                <th>Data da entrega</th>
                                <td>{{$order->delivered_date}}</td>
                                <th>Data do cancelamento</th>
                                <td>{{$order->canceled_date}}</td>
                            </tr>
                            <tr>
                                <th>Status pedido</th>
                                <td colspan="5">
                                    @if($order->status == 'delivered')
                                        <span class="badge bg-success">Entregue</span>
                                    @elseif($order->status == 'canceled')
                                        <span class="badge bg-danger">Cancelado</span>
                                    @else
                                        <span class="badge bg-warning">Encomendado</span>
                                    @endif            
                                </td>
                            </tr>                    
                        </table>
                    </div>            
                </div>
        
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <h5>Itens do pedido</h5>
                        </div>                
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">Nome</th>
                                    <th class="text-center">Preço</th>
                                    <th class="text-center">Quantidade</th>
                                    <th class="text-center">SKU</th>
                                    <th class="text-center">Categoria</th>
                                    <th class="text-center">Marca</th>
                                    {{-- <th class="text-center">Opções</th> --}}
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)                        
                                <tr>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{asset('uploads/products/thumbnails')}}/{{$item->product->image}}" alt="{{$item->product->name}}" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="{{route('shop.product.details',['product_slug'=>$item->product->slug])}}" target="_blank"
                                                class="body-title-2">{{$item->product->name}}</a>
                                        </div>
                                    </td>
                                    <td class="text-center">R$ {{$item->price}}</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">{{$item->product->SKU}}</td>
                                    <td class="text-center">{{$item->product->category->name}}</td>
                                    <td class="text-center">{{$item->product->brand->name}}</td>
                                    {{-- <td class="text-center">{{$item->options}}</td> --}}
                                    <td class="text-center">{{$item->rstatus == 0 ? "Não" : "Sim"}}</td>
                                    <td class="text-center">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>        
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{$orderItems->links('pagination::bootstrap-5')}}
                    </div>
                </div>
        
                <div class="wg-box mt-5">
                    <h5>Endereço de entrega</h5>
                    <div class="my-account__address-item col-md-6">
                        <div class="my-account__address-item__detail">
                            <p>{{$order->name}}</p>
                            <p>{{$order->address}}</p>
                            <p>{{$order->locality}}</p>
                            <p>{{$order->city}}, {{$order->coutry}} </p>
                            <p>{{$order->landmark}}</p>
                            <p>{{$order->zip}}</p>
                            <br>
                            <p>Telefone : {{$order->phone}}</p>
                        </div>
                    </div>
                </div>
        
                <div class="wg-box mt-5">
                    <h5>Transações</h5>
                    <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th>Subtotal</th>
                                <td>R$ {{$order->subtotal}}</td>
                                <th>Tax</th>
                                <td>R$ {{$order->tax}}</td>
                                <th>Desconto</th>
                                <td>R$ {{$order->discount}}</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>R$ {{$order->total}}</td>
                                <th>Método de pagamento</th>
                                <td>{{$transaction->mode}}</td>
                                <th>Status</th>
                                <td>
                                    @if ($transaction->status == 'aproved')
                                        <span class="badge bg-success">Aprovado</span>
                                    @elseif($transaction->status == 'declined')
                                        <span class="badge bg-danger">Recusado</span>
                                    @elseif($transaction->status == 'refunded')
                                    <span class="badge bg-secondary">Reenbolsado</span>
                                    @else
                                        <span class="badge bg-warning">Pendente</span>                                
                                    @endif
                                </td>
                            </tr>                    
                        </tbody>
                    </table>
                </div>
            </div>
    </section>
</main> 
@endsection