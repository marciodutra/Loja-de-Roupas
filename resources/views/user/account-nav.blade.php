<ul class="account-nav">
    <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Dashboard</a></li>
    <li><a href="account-orders.html" class="menu-link menu-link_us-s">Pedidos</a></li>
    <li><a href="account-address.html" class="menu-link menu-link_us-s">Endereço</a></li>
    <li><a href="account-details.html" class="menu-link menu-link_us-s">Detalhes da conta</a></li>
    <li><a href="account-wishlist.html" class="menu-link menu-link_us-s">Lista de desejos</a></li>

    <li>
        <form method="POST" action="{{route('logout')}}" id="logout-form">
            @csrf
            <a href="{{route('logout')}}" class="menu-link menu-link_us-s " onclick="event.preventDefault();document.getElementById('logout-form').submit();">Sair</a>
        </form>
    </li>
  </ul>
