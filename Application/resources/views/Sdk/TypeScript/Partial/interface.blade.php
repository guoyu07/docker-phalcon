declare interface {{ $interface }} {
@foreach($properties as $property)
    {{preg_replace("/^\\$(\\w+$)/","$1",$property['name'])}}@if($property['optional'])?@endif: {{$property['type']}},
@endforeach
}