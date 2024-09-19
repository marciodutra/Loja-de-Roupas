@extends('layouts.admin')
@section('content')
<style>
    .table-transaction>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fff !important;
    }

</style>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Detalhes do pedido</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="route('admin.index')">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Detalhes do pedido</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Detalhes do pedido</h5>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Voltar</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Nº do pedido</th>
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
                        <th>Status do pedido</th>
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
</div>
@endsection