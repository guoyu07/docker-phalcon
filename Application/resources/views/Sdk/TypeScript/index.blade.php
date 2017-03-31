@foreach($controllers as $controller)
export * from './{{$controller}}Api';
@endforeach
