import {Client} from "@crazy-factory/cf-service-client";
import Json from "./Middlewares/Json";
export default class BaseApi{
    protected client: Client;
    constructor(protected base_url: string = '{{$base_url}}') {
        this.client = new Client({baseUrl: base_url});
        this.client.addMiddleware(new Json());
    }
}
