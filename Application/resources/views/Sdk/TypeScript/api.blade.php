import BaseApi from "./BaseApi";
import {FetchRequest} from "cyberhck-test";
export default class {{$ControllerName}}Api extends BaseApi{
@foreach($methods as $method)
    @include("Sdk.TypeScript.Partial.method", ['method' => $method, 'ControllerName' => $ControllerName])
@endforeach
}
