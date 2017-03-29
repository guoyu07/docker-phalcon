    public {{$method['action']}}(@include('Sdk.TypeScript.Partial.parameters', ['method', $method])): Promise<{{$method['response']}}>{
        return fetch(`${this.base_url}{{$method['url']}}`, {method: '{{$method['method']}}' @if(in_array($method['method'], ['POST', 'PATCH', 'PUT']))), body: {{$ControllerName}} @endif}).then(res => res.json())
    }
