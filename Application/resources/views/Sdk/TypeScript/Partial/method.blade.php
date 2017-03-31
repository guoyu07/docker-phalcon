    public {{$method['action']}}(@include('Sdk.TypeScript.Partial.parameters', ['method', $method])): Promise<{{$method['response']}}>{
        return this.client.process({url: '{{$method['url']}}', method: '{{$method['method']}}'@if(in_array($method['method'], ['POST', 'PATCH', 'PUT'])), body:JSON.stringify({{$ControllerName}}) @endif} as FetchRequest);
    }
