export default class {{$ControllerName}}Api extends BaseApi{
@foreach($methods as $method)
    @include("Sdk.TypeScript.Partial.method", ['method' => $method, 'ControllerName' => $ControllerName])
@endforeach
}
