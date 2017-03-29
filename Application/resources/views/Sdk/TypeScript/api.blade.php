export default class {{$ControllerName}}Api extends BaseApi{
@foreach($methods as $method)
    public {{$method['action']}}(): Promise<{{$method['response']}}>
    {
        return fetch(`${this.base_url}{{$method['url']}}`).then(res => res.json());
    }
@endforeach
}
