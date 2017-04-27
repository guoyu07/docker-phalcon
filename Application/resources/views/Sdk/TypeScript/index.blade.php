@foreach($controllers as $controller)
import {{$controller}}Api from './{{$controller}}Api';
@endforeach
{{--export * from './interfaces';--}}
export { {{implode(', ', array_map(function($controller){return $controller.'Api';}, $controllers))}} }
