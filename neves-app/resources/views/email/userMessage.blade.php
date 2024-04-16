<div style="margin:1em">
  {{-- Nome : {{$nome}}
  Apelido : {{$apelido}}
  Email : {{$email}}
  Mensagem : {{$nome}} --}}
  <div style="text-align: center">
    <img src="{{$message->embed('../storage/app/public/images/logos/LogoVetorizado(alt).png')}}" width="100" alt="">
  </div>
  <div style="font-family:Arial, Helvetica, sans-serif">
    <h5>Nome: {{$nome}}</h5>
    <h5>Apelido: {{$apelido}}</h5>
    <h5>Email: {{$email}}</h5>
    <h5>Mensagem: {{$mensagem}}</h5>
  </div>
</div>