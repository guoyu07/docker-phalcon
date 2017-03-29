abstract class BaseApi{
    protected base_url;
    constructor(protected base_url: string = '{{$base_url}}') {}
}
