<form action="{{route('payment')}}" method="post">
    @csrf
    <input type="text" name="name" value="aser" />
    <input type="number" name="price" value="100" />
    <input type="number" name="qty" value="2" />

    <button>send</button>
</form>